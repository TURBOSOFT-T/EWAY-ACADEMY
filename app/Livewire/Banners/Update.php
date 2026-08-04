<?php

namespace App\Livewire\Banners;

use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\WithFileUploads;

class Update extends Component
{
    use WithFileUploads;
    public $banner, $titre, $sous_titre, $photo, $image;

    public function mount($banner)
    {
        $this->banner = $banner;
        $this->titre = $banner->titre;
        $this->sous_titre = $banner->sous_titre;
        $this->image = $banner->image;
    }

    public function render()
    {
        return view('livewire.banners.update');
    }


    public function update()
    {
        $this->validate([
            'titre' => 'nullable|string|max:50',
            'sous_titre' => 'nullable|string|max:250',
           // 'photo' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:1024',
            'photo' => 'sometimes|nullable|file|mimetypes:image/*',
        ], [
                 'sous_titre.max' => 'Le sous titre ne doit pas dépasser 70 caractères',
            'photo.image' => 'Le fichier doit être une image',
            'photo.mimes' => 'Le fichier doit être au format jpg, jpeg, png'
        ]);

        $OldBanner = $this->banner;

        if($this->photo){
            Storage::disk('public')->delete($OldBanner->image); 
            $OldBanner->image = $this->photo->store("bannners", "public");
        }
        $OldBanner->titre = $this->titre;
        $OldBanner->sous_titre = $this->sous_titre;
        $OldBanner->save();

        $this->image = $OldBanner->image;

        //flash  success message
        session()->flash('success', 'Le modifications ont été enregistrées.');


    }

}
