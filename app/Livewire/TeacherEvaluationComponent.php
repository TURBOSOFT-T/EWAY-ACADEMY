<?php
namespace App\Livewire;

use App\Models\TeacherEvaluation;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class TeacherEvaluationComponent extends Component
{
    public $teacherId;
    public $rating = 5;
    public $comment = '';
    public $is_anonymous = false;

    protected $rules = [
        'rating' => 'required|integer|min:1|max:5',
        'comment' => 'nullable|string|max:1000',
        'is_anonymous' => 'boolean',
    ];

    public function mount($teacherId)
    {
        $this->teacherId = $teacherId;
        
        // Pré-remplir si l'étudiant a déjà laissé une évaluation
        if (Auth::check()) {
            $existing = TeacherEvaluation::where('student_id', Auth::id())
                ->where('teacher_id', $this->teacherId)
                ->first();

            if ($existing) {
                $this->rating = $existing->rating;
                $this->comment = $existing->comment;
                $this->is_anonymous = (bool) $existing->is_anonymous;
            }
        }
    }

    public function submitEvaluation()
    {
        if (!Auth::check()) {
            session()->flash('error', 'Vous devez être connecté pour laisser un avis.');
            return;
        }

        $this->validate();

        TeacherEvaluation::updateOrCreate(
            [
                'student_id' => Auth::id(),
                'teacher_id' => $this->teacherId,
            ],
            [
                'rating' => $this->rating,
                'comment' => $this->comment,
                'is_anonymous' => $this->is_anonymous,
                'is_approved' => true, // Auto-approbation (ou false si vous modérez les avis)
            ]
        );

        session()->flash('message', 'Votre évaluation a bien été enregistrée !');
    }

    public function render()
    {
        $evaluations = TeacherEvaluation::where('teacher_id', $this->teacherId)
            ->where('is_approved', true)
            ->with('student')
            ->latest()
            ->get();

        $noteMoyenne = $evaluations->avg('rating') ?? 0;
        $totalAvis = $evaluations->count();

        return view('livewire.teacher-evaluation-component', compact('evaluations', 'noteMoyenne', 'totalAvis'));
    }
}