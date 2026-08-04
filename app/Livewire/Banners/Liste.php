<?php

namespace App\Livewire\Banners;

use App\Models\Banners;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;

class Liste extends Component
{

    protected $listeners = ['BannerAdded' => '$refresh', 'deleteBanner'];


    public function render()
    {
        $banners  = Banners::all();
        return view('livewire.banners.liste', compact("banners"));
    }

    public function confirm($id)
    {
        $this->emit('confirm', $id);
    }


    //protected $listeners = ['deleteBanner'];

    public function deleteBanner($id)
    {
        $banner = Banner::find($id);

        if ($banner) {
            $banner->delete();
            session()->flash('message', 'Bannière supprimée avec succès.');
        }
    }

    public function delete($id){
        $banner = Banners::find($id);
        if($banner){
            if($banner->image){
                Storage::disk('public')->delete($banner->image); 
            }
            $banner->delete();
            session()->flash('success', 'Banner supprimé avec succès');
        }
    }
}
