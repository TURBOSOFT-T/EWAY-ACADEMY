<?php
namespace App\Livewire\Admin;

use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\Attributes\Locked;
use App\Models\PackFormation;
use App\Models\Formation;
use Illuminate\Support\Facades\Storage;

class EditPackFormation extends Component
{
    use WithFileUploads;

    // Conserve l'ID du pack verrouillé contre la falsification
    #[Locked]
    public $packId;

    // Propriétés du formulaire
    public $titre;
    public $description;
    public $prix;
    public $active = false;
    public $newImage;
    public $oldImage;

    // Formations sélectionnées (changement en tableau d'entiers explicite)
    public array $selectedFormations = [];

    protected function rules()
    {
        return [
            'titre' => 'required|string|max:255',
            'description' => 'nullable|string',
            'prix' => 'required|numeric|min:0',
            'active' => 'boolean',
            'newImage' => 'nullable|image|max:2048',
            'selectedFormations' => 'required|array|min:1',
            'selectedFormations.*' => 'exists:formations,id',
        ];
    }

    protected $messages = [
        'titre.required' => 'Le titre du pack est obligatoire.',
        'prix.required' => 'Le prix est obligatoire.',
        'selectedFormations.required' => 'Veuillez sélectionner au moins une formation.',
        'selectedFormations.min' => 'Veuillez sélectionner au moins une formation pour ce pack.',
        'newImage.image' => 'Le fichier doit être une image valide.',
        'newImage.max' => 'L\'image ne doit pas dépasser 2 Mo.',
    ];

public function mount($packId)
    {
        $pack = PackFormation::with('formations')->findOrFail($packId);

        $this->packId = $pack->id;
        $this->titre = $pack->titre;
        $this->prix = $pack->prix;
        $this->description = $pack->description;
        $this->active = (bool) $pack->active;
        $this->oldImage = $pack->image;
        $this->selectedFormations = $pack->formations->pluck('id')->map(fn($id) => (string) $id)->toArray();
    }
    public function updatePack()
    {
        $this->validate();

        // Récupération explicite et fraîche du modèle en BDD
        $pack = PackFormation::findOrFail($this->packId);

        $imagePath = $this->oldImage;

        // Si une nouvelle image est téléversée
        if ($this->newImage) {
            if ($this->oldImage && Storage::disk('public')->exists($this->oldImage)) {
                Storage::disk('public')->delete($this->oldImage);
            }
            $imagePath = $this->newImage->store('packs', 'public');
        }

        // 1. Mettre à jour le pack en BDD
        $pack->update([
            'titre'       => $this->titre,
            'description' => $this->description,
            'prix'        => $this->prix,
            'active'      => $this->active ? 1 : 0,
            'image'       => $imagePath,
        ]);

        // 2. Formatage des IDs des formations
        $selectedIds = array_map('intval', array_filter($this->selectedFormations));

        // 3. Synchroniser la table pivot
        $pack->formations()->sync($selectedIds);

        session()->flash('message', 'Le pack a été mis à jour avec succès.');

        return redirect()->route('packs');
    }

   public function render()
    {
        return view('livewire.admin.edit-pack-formation', [
            'pack' => PackFormation::findOrFail($this->packId), // <--- Transmettre $pack à la vue
            'formations' => Formation::all(),
        ]);
    }
}