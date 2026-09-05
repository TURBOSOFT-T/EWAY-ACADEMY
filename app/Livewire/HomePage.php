<?php

namespace App\Livewire;

use App\Models\ContenuInscription;
use Livewire\Component;
use App\Models\Formation;
use App\Models\Inscription;
use App\Models\PackFormation;
use Illuminate\Support\Facades\Auth;

class HomePage extends Component
{
    // Identifiants de la sélection
    public $selectedType = null; // 'Pack' ou 'Formation'
    public $selectedId = null;

    // Champs du formulaire d'inscription
    public $nom;
    public $prenom;
    public $email;
    public $telephone;
    public $whatsapp;
    public $ville;
    public $mode = 'espèce';
    public $message;

    protected function rules()
    {
        return [
            'nom' => 'required|string|max:255',
            'prenom' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'telephone' => 'required|string|max:20',
            'mode' => 'required|in:espèce,paypal,carte de credit',
        ];
    }

    /**
     * Méthode accessible depuis la vue Blade ($this->estDejaInscrit)
     */
    public function estDejaInscrit($id, $type): bool
    {
        return $this->dejaInscrit($id, $type, Auth::user()?->email);
    }

    /**
     * Vérifie si l'utilisateur (par ID ou Email) est déjà inscrit à un pack ou une formation.
     * Interroge désormais la table `contenu_inscriptions`.
     */
    private function dejaInscrit($id, $type, $email = null): bool
    {
        $userId = Auth::id();

        if (!$userId && !$email) {
            return false;
        }

        // Requête de base sur les inscriptions valides (exclut annulées/rejetées)
        $inscriptionsQuery = Inscription::query()
            ->where(function ($q) use ($userId, $email) {
                if ($userId) {
                    $q->where('user_id', $userId);
                }
                if ($email) {
                    $q->orWhere('email', $email);
                }
            })
            ->whereNotIn('statut', ['annule', 'rejete', 'annulée', 'rejetée']);

        if ($type === 'Pack') {
            // Vérifie dans la table contenu_inscriptions via la relation `contenus`
            return $inscriptionsQuery->whereHas('contenus', function ($q) use ($id) {
                $q->where('pack_formation_id', $id);
            })->exists();
        }

        if ($type === 'Formation') {
            // 1. Vérifie si l'utilisateur est directement inscrit à la formation
            $directInscription = (clone $inscriptionsQuery)->whereHas('contenus', function ($q) use ($id) {
                $q->where('formation_id', $id);
            })->exists();

            if ($directInscription) {
                return true;
            }

            // 2. Vérifie si l'utilisateur est inscrit à un Pack contenant cette formation
            $packIdsContenantFormation = PackFormation::whereHas('formations', function ($q) use ($id) {
                $q->where('formations.id', $id);
            })->pluck('id');

            if ($packIdsContenantFormation->isNotEmpty()) {
                return (clone $inscriptionsQuery)->whereHas('contenus', function ($q) use ($packIdsContenantFormation) {
                    $q->whereIn('pack_formation_id', $packIdsContenantFormation);
                })->exists();
            }
        }

        return false;
    }

    public function selectItem($id, $type)
    {
        // 🔒 1. VÉRIFICATION DE LA CONNEXION
        if (!Auth::check()) {
            session()->flash('warning', 'Veuillez vous connecter ou créer un compte pour vous inscrire.');
            $this->dispatch('show-auth-warning');
            return;
        }

        // Normaliser le type ('Pack' ou 'Formation')
        $this->selectedType = match (strtolower($type)) {
            'pack' => 'Pack',
            'formation' => 'Formation',
            default => 'Event',
        };

        $this->selectedId = $id;

        // Pré-remplissage des champs
        $user = Auth::user();
        $this->nom = $this->nom ?: ($user->nom ?? $user->name ?? '');
        $this->prenom = $this->prenom ?: ($user->prenom ?? '');
        $this->email = $this->email ?: $user->email;
        $this->telephone = $this->telephone ?: ($user->telephone ?? $user->phone ?? '');

        // 🛑 2. VÉRIFICATION DES DOUBLONS D'INSCRIPTION
        if ($this->dejaInscrit($this->selectedId, $this->selectedType, $this->email)) {
            $nomElement = $this->selectedType === 'Pack' ? 'ce pack' : 'cette formation (ou au pack la contenant)';
            session()->flash('InscriptionWarning', "Vous êtes déjà inscrit(e) à {$nomElement}.");
            $this->dispatch('show-InscriptionWarning');
            return;
        }

        // Ouvrir la modal si tout est valide
        $this->dispatch('open-subscribe-modal');
    }

    public function SInscrire()
    {
        if (!Auth::check()) {
            session()->flash('warning', 'Votre session a expiré. Veuillez vous reconnecter.');
            return;
        }

        $this->validate();

        if (!$this->selectedId || !$this->selectedType) {
            return;
        }

        $typeEnum = match (strtolower($this->selectedType)) {
            'pack' => 'Pack',
            'formation' => 'Formation',
            default => 'Event',
        };

        // 🛑 Sécurité anti-doublon lors de la soumission du formulaire (par ID + Email)
        if ($this->dejaInscrit($this->selectedId, $typeEnum, $this->email)) {
            session()->flash('InscriptionWarning', 'Vous avez déjà une inscription active pour cet élément.');
            $this->dispatch('close-subscribe-modal');
            $this->dispatch('show-InscriptionWarning');
            return;
        }

        // 1. Créer l'entête d'inscription
        $inscription = Inscription::create([
            'user_id'   => Auth::id(),
            'statut'    => 'attente',
            'etat'      => 'attente',
            'mode'      => $this->mode,
            'type'      => $typeEnum,
            'nom'       => $this->nom,
            'prenom'    => $this->prenom,
            'email'     => $this->email,
            'telephone' => $this->telephone,
            'whatsapp'  => $this->whatsapp,
            'ville'     => $this->ville,
            'message'   => $this->message,
        ]);

        // 2. Récupérer le prix (selon l'élément)
        $prix = $typeEnum === 'Pack'
            ? PackFormation::find($this->selectedId)->prix ?? 0
            : Formation::find($this->selectedId)->prix ?? 0;

        // 3. Créer le détail dans la table `contenu_inscriptions` via la relation `contenus()`
        $inscription->contenus()->create([
            'type'              => $typeEnum,
            'pack_formation_id' => $typeEnum === 'Pack' ? $this->selectedId : null,
            'formation_id'      => $typeEnum === 'Formation' ? $this->selectedId : null,
            'prix'              => $prix,
        ]);

        $this->reset(['selectedId', 'selectedType', 'message']);

        session()->flash('success', 'Votre demande d\'inscription a été enregistrée avec succès !');
        $this->dispatch('close-subscribe-modal');
    }

    public function getSelectedItemProperty()
    {
        if (!$this->selectedId || !$this->selectedType) {
            return null;
        }

        return $this->selectedType === 'Pack'
            ? PackFormation::with('formations')->find($this->selectedId)
            : Formation::find($this->selectedId);
    }

    public function render()
    {
        return view('livewire.home-page', [
            'packs' => PackFormation::where('active', true)->with('formations')->get(),
            'formations' => Formation::all(),
            'selectedItem' => $this->selectedItem,
        ]);
    }
}