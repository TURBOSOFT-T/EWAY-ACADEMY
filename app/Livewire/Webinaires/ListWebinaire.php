<?php

namespace App\Livewire\Webinaires;

use App\Models\Online_classe;
use Livewire\Component;
use Livewire\WithPagination;

class ListWebinaire extends Component
{

        use WithPagination;
    public $key;

    public function render()
{
    $query = Online_classe::query();

    // 🔒 Si l'utilisateur n'est pas admin, on filtre par user_id
    if (!auth()->user()->isAdmin()) {
        $query->where('user_id', auth()->id());
    }

    // 🔍 Recherche par topic
    if (!is_null($this->key)) {
        $query->where('topic', 'like', '%' . $this->key . '%');
    }

    $webinaires = $query->orderBy('created_at', 'desc')->paginate(30);
    $total = $query->count(); // total filtré

    return view('livewire.webinaires.list-webinaire', compact('webinaires', 'total'));
}

    public function render1()
    {



        $Query = Online_classe::query();
        if(!is_null($this->key)){
            $Query->where('topic', 'like', '%'.$this->key.'%');
        }
         $Query->orderBy('created_at', 'desc');
        $webinaires = $Query->paginate(30);
        $total = Online_classe::count();
      
        return view('livewire.webinaires.list-webinaire', compact('webinaires','total'));
    }

    
    public function delete($id)
    {
        $cat = Online_classe::find($id);
        if ($cat) {
            $cat->delete();
            session()->flash('info', 'Réunion supprimée avec succès');
        }
    }

    public function filtrer()
    {
        //reset page
        $this->resetPage();
    }

}
