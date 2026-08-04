<?php

namespace App\Livewire\Produits;

use App\Models\produits;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\WithPagination;

class ListProduit extends Component
{

    protected $listeners = ['add-stock' => '$refresh'];
    use WithPagination;
    public $key;




    public function render()
    {
        $Query = produits::query();
        if(!is_null($this->key)){
            $Query->where('nom', 'like', '%'.$this->key.'%');
        }
        $produits = $Query->paginate(30);
        $total = produits::count();
        $total_supprimers = produits::onlyTrashed()->count();
        return view('livewire.produits.list-produit',compact('produits','total','total_supprimers'));
    }




    public function delete($id)
    {
        $produit = produits::find($id);
        if ($produit) {
            $produit->delete();
            session()->flash('info', 'Produit supprimé avec succès');
        }
    }




    public function add_top($id)
    {
        $produit = produits::find($id);
        if ($produit) {
            if ($produit->top == 1) {
                $produit->top = 0;
            } else {
                $produit->top = 1;
            }
            $produit->save();
        }
    }





    public function filtrer()
    {
        //reset page
        $this->resetPage();
    }
}
