<?php

namespace App\Livewire\Formations;

use App\Models\Category;
use App\Models\Formation;
use Livewire\Component;
use Livewire\WithFileUploads;

class AddFormation extends Component
{

    use WithFileUploads;

    public $titre, $description, $email, $image, $image2, $category_id,
        $meta_description, $autre_description;
    public $updateMode = false;  // Nouvelle variable pour le mode mise à jour
    public $formation;  // Ajout d'une variable pour stocker l'événement

    public $date_debut,
        $date_fin;
    public $type;


    public function mount($formation = null)
    {
        if ($formation) {
            $this->updateMode = true;
            $this->formation = $formation;
            $this->titre = $formation->titre;
            $this->description = $formation->description;
            $this->image2 = $formation->image;
            $this->category_id = $formation->category_id;
            $this->meta_description = $formation->meta_description;
            $this->date_debut = $formation->date_debut;
            $this->date_fin = $formation->date_fin;
          //  $this->type = $formation->type;
            // $this->autre_description = $formation->autre_description;
        }
    }
    private function resetInputFields()
    {
        $this->titre = '';
        $this->description = '';
        $this->image = '';
        $this->image2 = '';
        $this->meta_description = '';
        $this->autre_description = '';
    }

    // Create or update formation
    public function create()
    {
        // Validation des inputs
        $data = $this->validate([
            'titre' => 'required|string',
            'description' => 'required|string|max:210060',
            'meta_description' => 'nullable|string|max:20255',
            'autre_description' => 'nullable|string|max:1000255',
            'category_id' => 'required|integer|exists:categories,id',

            'image' => 'sometimes|required|file|mimetypes:image/*',
          //  'type' => 'required|in:formation,traduction,etudes',
        ], [
            'titre.required' => 'Le titre est requis',
            'description.required' => 'Veuillez entrer une description',

        ]);

        if ($this->updateMode) {
            // Mise à jour de l'événement existant
            $formation = Formation::find($this->formation->id);
        } else {
            // Création d'un nouvel événement
            $formation = new Formation();
        }

        // Assignation des données
        $formation->titre = $this->titre;
        $formation->description = $this->description;

        $formation->category_id = $this->category_id;
        $formation->meta_description = $this->meta_description;
     //   $formation->date_debut = $this->date_debut;
      //  $formation->type = $this->type;


        //  $formation->autre_description = $this->autre_description;


        $formation->image = $this->image->store('formations', 'public');

        // ✅ Lier à l'utilisateur connecté
        $formation->user_id = auth()->id();

        // Sauvegarder l'événement
        $formation->save();

        // Réinitialiser les champs et afficher le message de succès
        $this->resetInputFields();
        session()->flash('success', $this->updateMode ? 'Formation mise à jour avec succès' : 'Formation ajoutée avec succès');

        // Rediriger ou fermer le modal si nécessaire
        // $this->emit('closeModal');  // Si vous utilisez un modal
    }
    public function render()
    {
        $categories = Category::all();
        return view('livewire.formations.add-formation', compact('categories'));
    }
}
