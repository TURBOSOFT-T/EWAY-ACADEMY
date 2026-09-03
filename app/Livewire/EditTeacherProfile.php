<?php
namespace App\Livewire;

use App\Models\User;
use App\Models\TeacherProfile;
use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class EditTeacherProfile extends Component
{
    use WithFileUploads;

    public $userId;
    public $bio;
    public $grade;
    public $experience_years;
    public $highest_degree;
    public $speciality;
    public $certifications = [];

    // Propriétés pour le CV
    public $cv;
    public $oldCvPath;

    // Réseaux sociaux
    public $social_links = [
        'linkedin' => '',
        'twitter'  => '',
        'github'   => '',
        'website'  => '',
        'facebook' => '',
        'youtube'  => '',
        'tiktok'   => '',
    ];

    /**
     * Initialisation du profil avec $userId optionnel
     */
    public function mount($userId = null)
    {
        // 1. Si aucun ID n'est fourni, on prend l'ID de l'utilisateur actuellement connecté
        $this->userId = $userId ?? Auth::id();

        if (!$this->userId) {
            abort(403, 'Utilisateur non identifié.');
        }

        $user = User::with('profile')->findOrFail($this->userId);

        if ($user->profile) {
            $this->bio              = $user->profile->bio;
            $this->grade            = $user->profile->grade;
            $this->experience_years = $user->profile->experience_years;
            $this->highest_degree   = $user->profile->highest_degree;
            $this->speciality       = $user->profile->speciality;
            $this->certifications   = $user->profile->certifications ?? [];
            $this->oldCvPath        = $user->profile->cv_path;

            // Chargement des réseaux sociaux enregistrés ou conservation du tableau par défaut
            if ($user->profile->social_links) {
                $this->social_links = array_merge($this->social_links, $user->profile->social_links);
            }
        }
    }

    protected function rules()
    {
        return [
            'bio'              => 'nullable|string|max:1000',
            'grade'            => 'nullable|string|max:255',
            'experience_years' => 'nullable|integer|min:0|max:60',
            'highest_degree'   => 'nullable|string|max:255',
            'speciality'       => 'nullable|string|max:255',
            'cv'               => 'nullable|file|mimes:pdf|max:5120', // PDF max 5Mo
            'social_links.linkedin'    => 'nullable|url',
            'social_links.twitter'     => 'nullable|url',
            'social_links.github'      => 'nullable|url',
            'social_links.website'     => 'nullable|url',
            'social_links.facebook'    => 'nullable|url',
            'social_links.youtube'     => 'nullable|url',
            'social_links.tiktok'      => 'nullable|url',

        ];
    }

    protected $messages = [
        'cv.mimes' => 'Le CV doit être impérativement un document au format PDF.',
        'cv.max'   => 'Le fichier PDF ne doit pas dépasser 5 Mo.',
    ];
public function saveProfile()
{
    $this->validate();

    $user = User::findOrFail($this->userId);
    $profile = $user->profile ?? new TeacherProfile(['user_id' => $user->id]);

    // Traitement du CV
    if ($this->cv && method_exists($this->cv, 'store')) {
        if ($profile->cv_path && Storage::disk('public')->exists($profile->cv_path)) {
            Storage::disk('public')->delete($profile->cv_path);
        }
        $profile->cv_path = $this->cv->store('cvs', 'public');
    }

    // Assignation avec valeurs par défaut pour éviter le NULL en base
    $profile->bio              = $this->bio ?? '';
    $profile->grade            = $this->grade ?? '';
    $profile->experience_years = $this->experience_years !== '' && $this->experience_years !== null ? (int) $this->experience_years : 0; // 👈 Convertit null en 0
    $profile->highest_degree   = $this->highest_degree ?? '';
    $profile->speciality       = $this->speciality ?? '';
    $profile->certifications   = $this->certifications ?? [];
    $profile->social_links     = $this->social_links; // 👈 Enregistrement des liens

    $profile->save();

    $this->reset('cv');
    $this->oldCvPath = $profile->cv_path;

    session()->flash('success', 'Profil enseignant et CV mis à jour avec succès !');
}

    public function render()
    {
        return view('livewire.edit-teacher-profile');
    }
}