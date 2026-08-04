<?php

namespace App\Livewire\Formations;

use Livewire\Component;


use App\Http\Traits\ListGouvernorats as TraitsListGouvernorats;

use App\Models\produits;

use Livewire\WithPagination;
use App\Mail\{OrderChangeStatut, ChangeStatut};
use App\Models\Inscription as ModelsInscription;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\Mail;

class Inscription extends Component
{

    use WithPagination;
    use TraitsListGouvernorats;

    public $selectedCommandes = [];
    public $date, $statut, $key, $gouvernoratsTunisie, $gouvernorat, $statut2;


    public function updatedKey($value)
    {
        $this->key = $value;
        $this->resetPage();
    }
    public function render()
    {

          
        $inscriptionsQuery = ModelsInscription::query();
        if (strlen($this->date) > 0) {
            $inscriptionsQuery->whereDate('created_at', $this->date);
        }
     
        if (strlen($this->statut) > 0) {
            $inscriptionsQuery->where('statut', $this->statut);
        }
        if (strlen($this->statut2) > 0) {
            if ($this->statut2 == "confirmer") {
                $inscriptionsQuery->where('etat', "confirmé");
            } else {
                $inscriptionsQuery->where('etat', "annulé");
            }
        }
        if (strlen($this->key) > 0) {
            $inscriptionsQuery->where('nom', 'like', '%' . $this->key . '%')
                ->orWhere('adresse', 'like', '%' . $this->key . '%')
                ->orWhere('telephone', 'like', '%' . $this->key . '%')
             
                ->orWhere('prenom', 'like', '%' . $this->key . '%');
        }
         $inscriptions = $inscriptionsQuery->with(['country', 'state', 'city', 'formation'])
                    ->where('type', 'Formation')
        ->Orderby('id', "Desc")->paginate(80); 

        $total = ModelsInscription::where('type', 'Formation')->count();
        $this->gouvernoratsTunisie = $this->getListGouvernorat();
        return view('livewire.formations.inscription' , compact('inscriptions', 'total'));
    }



    

    
    public function updateStatus($inscriptionId, $newStatus)
    {
        // Mettre à jour le statut de la inc$inscriptiondans la base de données
        $inscription= ModelsInscription::findOrFail($inscriptionId);
        if ($inscription) {
            $inscription->statut = $newStatus;

            //retourner le stock si l'etat de dla command epasser a retourner
            if ($newStatus == "retournée") {
                foreach ($inscription->contenus as $contenus) {
                    $article = produits::find($contenus->id_produit);
                    if ($article) {
                        $article->retourner_stock($contenus->quantite);
                    }
                }
                $this->sendOrderConfirmationMail($inscription);
            }
            if ($newStatus == "traitement") {
                foreach ($inscription->contenus as $contenus) {
                    $article = produits::find($contenus->id_produit);
                    if ($article) {
                        $article->retourner_stock($contenus->quantite);
                    }
                }
                $this->sendOrderConfirmationMail($inscription);
            }
            if ($newStatus == "planification") {
                foreach ($inscription->contenus as $contenus) {
                    $article = produits::find($contenus->id_produit);
                    if ($article) {
                        $article->retourner_stock($contenus->quantite);
                    }
                }
                $this->sendOrderConfirmationMail($inscription);
            }

            //enregistrer le chagement de l'etat de la inscription
            $inscription->save();
        }
    }


    public function sendOrderConfirmationMail($inscription){
      //  Mail::to ($inscription->email)->send(new OrderChangeStatut($inscription));
      }

    public function delete($id)
    {
        $inscription= ModelsInscription::find($id);
        if ($inscription) {
            $inscription->delete();

            //flash message
            session()->flash('success', 'Inscription supprimée avec succès');
        }
        return view('livewire.formations.inscription');
    }

    public function filtrer()
    {
        //reset page
        $this->resetPage();
    }


    public function confirmer($id)
    {
        $inscription= ModelsInscription::find($id);
        if ($inscription) {
            $inscription->etat = "confirmé";
            $inscription->save();
            $this->sendOrderConfirmationMail($inscription);
        }
    }

    public function annuler($id)
    {
        $inscription= ModelsInscription::find($id);
        if ($inscription) {
           
          
            $inscription->etat = "annulé";

            $inscription->save();
          //  $this->sendOrderConfirmationMail($inscription);
            
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
        //check if $this->selectedCommandes is not empty
        if (count($this->selectedCommandes) > 0) {
            $ids = json_encode($this->selectedCommandes);
            return redirect()->route('print_bordereau', ["ids" => $ids]);
        } else {
            return false;
        }
    }
}
