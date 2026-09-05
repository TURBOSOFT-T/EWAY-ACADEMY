<?php

namespace App\Livewire\Admin;

use App\Models\Category;
use App\Models\PackFormation;
use App\Models\produits;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\WithPagination;

class ListPack extends Component
{

   
    use WithPagination;
    public $key;


protected $paginationTheme = 'bootstrap';

    // Filtres et recherche
    public $search = '';
    public $statusFilter = '';

    // Réinitialise la pagination lors d'une recherche
    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function updatingStatusFilter()
    {
        $this->resetPage();
    }

    // Basculer le statut d'un pack (Actif / Inactif)
    public function toggleStatus($packId)
    {
        $pack = PackFormation::findOrFail($packId);
        $pack->active = !$pack->active;
        $pack->save();

        session()->flash('message', 'Le statut du pack "' . $pack->titre . '" a été mis à jour.');
    }

   public function render()
{
   $packs = PackFormation::with(['formations' => function ($query) {
                $query->select('formations.id', 'formations.titre', 'formations.type', 'formations.image');
            }])
            ->withCount('formations')
            ->when($this->search, function ($query) {
                $query->where('titre', 'like', '%' . $this->search . '%')
                      ->orWhere('description', 'like', '%' . $this->search . '%');
            })
            ->when($this->statusFilter !== '', function ($query) {
                $query->where('active', $this->statusFilter);
            })
            ->latest()
            ->paginate(8);

    return view('livewire.admin.list-pack', [
        'packs' => $packs,
        // Récupère le total sans refaire une requête en BD
    ]);
}



    public function deletePack($packId)
    {
        $pack = PackFormation::findOrFail($packId);

        // Suppression de l'image de couverture si elle existe
        if ($pack->image && Storage::disk('public')->exists($pack->image)) {
            Storage::disk('public')->delete($pack->image);
        }

        // Détacher les formations associées dans la table pivot
        $pack->formations()->detach();

        // Supprimer le pack
        $pack->delete();

        session()->flash('message', 'Le pack a été supprimé avec succès.');
    }
    




   





    public function filtrer()
    {
        //reset page
        $this->resetPage();
    }
}
