<?php

namespace App\Livewire\Formations;

use Livewire\Component;
use Livewire\WithPagination;
use App\Http\Traits\ListGouvernorats as TraitsListGouvernorats;
use App\Models\Inscription as ModelsInscription;
use App\Models\produits;

class Inscription extends Component
{
    use WithPagination;
    use TraitsListGouvernorats;

    protected $paginationTheme = 'bootstrap';

    public $selectedCommandes = [];
    public $date, $statut, $key, $type, $gouvernoratsTunisie, $gouvernorat, $statut2;

    public function updatedKey()
    {
        $this->resetPage();
    }

    public function updatedType()
    {
        $this->resetPage();
    }

    public function render()
    {
        $inscriptionsQuery = ModelsInscription::query();

        // Filtre par date
        if (strlen($this->date) > 0) {
            $inscriptionsQuery->whereDate('created_at', $this->date);
        }

        // Filtre par statut
        if (strlen($this->statut) > 0) {
            $inscriptionsQuery->where('statut', $this->statut);
        }

        // Filtre par état (confirmé / annulé)
        if (strlen($this->statut2) > 0) {
            if ($this->statut2 === "confirmer") {
                $inscriptionsQuery->where('etat', "confirmé");
            } else {
                $inscriptionsQuery->where('etat', "annulé");
            }
        }

        // Filtre par type (Formation, Pack ou tous)
        if (strlen($this->type) > 0) {
            $inscriptionsQuery->where('type', $this->type);
        }

        // Recherche textuelle
        if (strlen($this->key) > 0) {
            $key = '%' . $this->key . '%';
            $inscriptionsQuery->where(function($query) use ($key) {
                $query->where('nom', 'like', $key)
                      ->orWhere('prenom', 'like', $key)
                      ->orWhere('email', 'like', $key)
                      ->orWhere('adresse', 'like', $key)
                      ->orWhere('telephone', 'like', $key);
            });
        }

        // Eager loading de 'pack' et 'formation' pour éviter les requêtes N+1
        $inscriptions = $inscriptionsQuery
            ->with(['country', 'state', 'city', 'formation', 'pack'])
            ->orderBy('id', 'Desc')
            ->paginate(80);

        $total = ModelsInscription::count();
        $this->gouvernoratsTunisie = $this->getListGouvernorat();

        return view('livewire.formations.inscription', compact('inscriptions', 'total'));
    }

    public function updateStatus($inscriptionId, $newStatus)
    {
        $inscription = ModelsInscription::find($inscriptionId);
        if ($inscription) {
            $inscription->statut = $newStatus;

            if (in_array($newStatus, ['retournée', 'traitement', 'planification'])) {
                if ($inscription->contenus) {
                    foreach ($inscription->contenus as $contenus) {
                        $article = produits::find($contenus->id_produit);
                        if ($article) {
                            $article->retourner_stock($contenus->quantite);
                        }
                    }
                }
                $this->sendOrderConfirmationMail($inscription);
            }

            $inscription->save();
        }
    }

    public function sendOrderConfirmationMail($inscription)
    {
        // Mail::to($inscription->email)->send(new OrderChangeStatut($inscription));
    }

    public function delete($id)
    {
        $inscription = ModelsInscription::find($id);
        if ($inscription) {
            $inscription->delete();
            session()->flash('success', 'Inscription supprimée avec succès');
        }
    }

    public function filtrer()
    {
        $this->resetPage();
    }

    public function confirmer($id)
    {
        $inscription = ModelsInscription::find($id);
        if ($inscription) {
            $inscription->etat = "confirmé";
            $inscription->save();
            $this->sendOrderConfirmationMail($inscription);
        }
    }

    public function annuler($id)
    {
        $inscription = ModelsInscription::find($id);
        if ($inscription) {
            $inscription->etat = "annulé";
            $inscription->save();
        }
    }

    public function toggleCommandeSelection($inscriptionId)
    {
        if (in_array($inscriptionId, $this->selectedCommandes)) {
            $this->selectedCommandes = array_diff($this->selectedCommandes, [$inscriptionId]);
        } else {
            $this->selectedCommandes[] = $inscriptionId;
        }
    }

    public function getSelectedInscriptions()
    {
        if (count($this->selectedCommandes) > 0) {
            $ids = json_encode(array_values($this->selectedCommandes));
            return redirect()->route('print_bordereau', ["ids" => $ids]);
        }
        return false;
    }
}