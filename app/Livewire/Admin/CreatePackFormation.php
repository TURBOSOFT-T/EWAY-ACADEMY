<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use Livewire\WithFileUploads;
use App\Models\PackFormation;
use App\Models\Formation;
use Illuminate\Support\Str;

class CreatePackFormation extends Component
{
    use WithFileUploads;

    // Propriétés du formulaire
    public $titre = '';
    public $description = '';
    public $prix = '';
    public $image;
    public $active = true;

    // Tableau des IDs des formations sélectionnées
    public array $selectedFormations = [];

    // Recherche dynamique de formations
    public $searchFormation = '';

    protected function rules()
    {
        return [
            'titre'              => 'required|string|max:255',
            'description'        => 'nullable|string',
            'prix'               => 'required|numeric|min:0',
            'image'              => 'nullable|image|max:2048', // Max 2MB
            'active'             => 'boolean',
            'selectedFormations' => 'required|array|min:1',
            'selectedFormations.*' => 'exists:formations,id',
        ];
    }

    protected $messages = [
        'titre.required'              => 'Le titre du pack est obligatoire.',
        'prix.required'               => 'Le prix est obligatoire.',
        'prix.numeric'                => 'Le prix doit être un nombre valide.',
        'selectedFormations.required' => 'Vous devez sélectionner au moins une formation.',
        'selectedFormations.min'      => 'Veuillez cocher au moins une formation pour ce pack.',
    ];

    public function savePack()
    {
        $this->validate();

        // Traitement de l'image
        $imagePath = null;
        if ($this->image) {
            $imagePath = $this->image->store('packs', 'public');
        }

        // 1. Création du pack
        $pack = PackFormation::create([
            'titre'       => $this->titre,
            'description' => $this->description,
            'prix'        => $this->prix,
            'image'       => $imagePath,
            'active'      => $this->active,
        ]);

        // 2. Attachement des formations associées (Table pivot)
        $pack->formations()->attach($this->selectedFormations);

        // Message de succès et réinitialisation
        session()->flash('message', 'Le pack de formation a été créé avec succès !');

        return redirect()->route('packs'); // Modifiez selon votre nom de route
    }

    public function render()
    {
        // Récupération des formations avec recherche
        $formations = Formation::query()
            ->when($this->searchFormation, function ($query) {
                $query->where('titre', 'like', '%' . $this->searchFormation . '%');
            })
            ->orderBy('titre', 'asc')
            ->take("5")
            ->get();

        return view('livewire.admin.create-pack-formation', [
            'formations' => $formations,
        ]); // Ajustez selon votre layout admin
    }
}