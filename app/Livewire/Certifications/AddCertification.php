<?php

namespace App\Livewire\Certifications;

use Livewire\Component;
use App\Models\Category;
use App\Models\Certification;
use Livewire\WithFileUploads;

use Illuminate\Support\Facades\Storage;
class AddCertification extends Component
{

        use WithFileUploads;

     public $titre, $description, $email, $category_id, $image, $image2, $start, $end, $certification, $type, $free;
    public $updateMode = false;
    public $meta_description;
    public $autre_description;
    public $autre_description1;
    public $telephone, $heure, $location, $country, $adresse;


   // Nouvelle variable pour le mode mise à jour
 // Ajout d'une variable pour stocker l'événement

public $date_debut,
        $date_fin;
        public function mount($certification)
    {
        if ($certification) {
            //   $this->certification = $certification;
            $this->titre = $certification->titre;
            $this->type = $certification->type;
            $this->description = $certification->description;
            $this->meta_description = $certification->meta_description;
            $this->autre_description1 = $certification->autre_description1;
            $this->telephone = $certification->telephone;
            $this->heure = $certification->heure;
            $this->location = $certification->location;
            $this->country = $certification->country;
            $this->adresse = $certification->adresse;
            $this->category_id = $certification->category_id;
            $this->email = $certification->email;
            $this->start = $certification->start;
            $this->end = $certification->end;

            $this->image2 = $certification->image;
            $this->free = $certification->free ?? 0;
        }
    }

    private function resetInputFields()
    {
        $this->titre = '';
        $this->description = '';

        $this->image = '';
        $this->image2 = '';
        $this->start = '';
        $this->end = '';
    }




    public function create()
    {
        $data =  $this->validate([
            'titre' => 'required|string',
            'description' => 'required|string|max:500260',


            'image' => 'sometimes|required|file|mimetypes:image/*',
            'category_id' => 'required|integer|exists:categories,id',
            'type' => 'required|in:webinaire,presentiel',
            'free' => 'nullable',


        ]);;
        [
            'titre.required' => 'Le titre',
            'description.required' => 'Veuillez entrer votre description',

        ];
        $categories = Category::findOrFail($data[('category_id')]);
        $certification = new Certification();

        $certification->titre = $this->titre;
        $certification->user_id = auth()->id();
        $certification->free = $this->free ?? false;
        $certification->description = $this->description;
        $certification->meta_description = $this->meta_description;
        $certification->autre_description = $this->autre_description;
        $certification->autre_description1 = $this->autre_description1;
        $certification->telephone = $this->telephone;
        $certification->heure = $this->heure;
        $certification->location = $this->location;
        $certification->country = $this->country;
        $certification->adresse = $this->adresse;


        $certification->type = $this->type;
        //  $certification->email = $this->email;
        $certification->start = $this->start;
        $certification->end = $this->end;

        //  if($this->image){
        $certification->image = $this->image->store('certifications', 'public');
        //  }


        // $certification->save();
        $categories->certifications()->save($certification);

        $this->resetInputFields();

        session()->flash('success', 'certification ajouté avec succès');
        return redirect()->route('certifications');
    }


    public function render()
    {
        $categories = Category::all();
        return view('livewire.certifications.add-certification',compact('categories'));
    }
}
