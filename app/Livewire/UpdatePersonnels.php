<?php

namespace App\Livewire;

use App\Models\User;
use App\Models\Shop;
use Livewire\Component;
use Spatie\Permission\Models\Role;
use Illuminate\Validation\Rule;
use Livewire\WithFileUploads; // <-- 1. Importer le trait
use Illuminate\Support\Facades\Storage;

class UpdatePersonnels extends Component
{

use WithFileUploads; // <-- 2. Utiliser le trait ici
    public $personnelId;
    public $nom;
    public $prenom;
    public $email;
    public $phone;
   
    public $role = 'personnel';
// Champs pour l'avatar
    public $avatar;
    public $oldAvatar;
    /**
     * Initialisation des données de l'utilisateur à modifier
     */
    public function mount($personnelId)
    {
        $this->personnelId = $personnelId;
        $personnel = User::findOrFail($personnelId);

        $this->nom = $personnel->nom;
        $this->prenom = $personnel->prenom;
        $this->email = $personnel->email;
        $this->phone = $personnel->phone;
        $this->role = $personnel->role ?? 'personnel';

        // Charge la première boutique rattachée si elle existe

    }

    /**
     * Règles de validation dynamiques avec exclusion de l'utilisateur courant
     */
    protected function rules()
    {
        return [
            'nom'          => 'required|string|max:255',
            'prenom'       => 'required|string|max:255',
            'email'        => ['required', 'email', Rule::unique('users', 'email')->ignore($this->personnelId)],
            'phone'        => ['required', 'numeric', Rule::unique('users', 'phone')->ignore($this->personnelId)],

            'role' => 'required|in:etudiant,personnel,enseignant,admin,commercial',
        ];
    }

    public function render()
    {

        return view('livewire.update-personnels');
    }

    public function update()
    {
        // 1. Validation des champs
        $this->validate();
        // 2. Recherche et mise à jour de l'utilisateur
        $personnel = User::findOrFail($this->personnelId);
        $personnel->nom   = $this->nom;
        $personnel->prenom = $this->prenom;
        $personnel->email  = $this->email;
        $personnel->phone  = $this->phone;
        $personnel->role   = $this->role;

        if ($this->avatar) {
            // Suppression de l'ancien avatar s'il existe dans le stockage
            if ($personnel->avatar && Storage::disk('public')->exists($personnel->avatar)) {
                Storage::disk('public')->delete($personnel->avatar);
            }

            // Enregistrement de la nouvelle image dans storage/app/public/avatars
            $avatarPath = $this->avatar->store('avatars', 'public');
            $personnel->avatar = $avatarPath; // ou $personnel->photo selon le nom de votre colonne
        }
        $personnel->save();
        // 5. Notification et redirection
        session()->flash('success', 'Personnel mis à jour avec succès !');

        return redirect()->route('personnels');
    }
}
