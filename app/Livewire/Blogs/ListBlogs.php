<?php

namespace App\Livewire\Blogs;

use App\Models\Blog;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\WithFileUploads;
class ListBlogs extends Component
{

 
    protected $listeners = ['add-stock' => '$refresh'];
    use WithPagination;
    public $key;
    public function render()
    {

        $Query = Blog::query();
        if(!is_null($this->key)){
            $Query->where('title', 'like', '%'.$this->key.'%');
        }
        $blogs = $Query->paginate(30);
        $total = Blog::count();
        $total_supprimers = Blog::onlyTrashed()->count();
        return view('livewire.blogs.list-blogs', compact('blogs','total','total_supprimers'));
    }
    public function delete($id)
    {
        $produit = Blog::find($id);
        if ($produit) {
            $produit->delete();
            session()->flash('info', 'Actualité supprimée avec succès');
        }
    }
    public function add_top($id)
    {
        $produit = Blog::find($id);
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
