<?php

namespace App\Http\Controllers;

use App\Models\commandes;
use App\Models\config;
use App\Models\historiques_connexion;
use App\Models\{produits,ContenuInscription,Formation, Category, Comment, Document, Examen, favoris as ModelsFavoris, Inscription, Oex_exam_master, Oex_question_master, Oex_result, Online_classe, TeacherEvaluation, User_exam};
use App\Models\User;
use App\Models\views;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\ExportUser;
use App\Http\Traits\ListGouvernorats;
use App\Models\clients;
use App\Models\contenu_commande;
use App\Models\domaines;
use App\Models\notifications;
use App\Models\templates;
use Illuminate\Support\Facades\Session;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Mail;
use App\Mail\{OrderChangeStatuts, ChangeStatut};
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\File;

use Illuminate\Support\Facades\Storage;
class MyAccountController extends Controller
{
    use ListGouvernorats;




    public function comptes()
    {

        $commandes = commandes::where('user_id', auth()->id())->get();
        return view('front.comptes.commandes', compact('commandes'));
    }


    public function profile()
    {
        return view('front.comptes.profile');
    }

    public function avatar(Request $request)
{
    $request->validate([
        'avatar' => 'required|image|mimes:jpeg,png,jpg,gif,svg,webp|max:2048',
    ]);

    $user = Auth::user();

    // 1. Suppression de l'ancien avatar s'il existe
    if ($user->avatar && Storage::disk('public')->exists($user->avatar)) {
        Storage::disk('public')->delete($user->avatar);
    }

    // 2. Enregistrement de la nouvelle image dans storage/app/public/avatars
    $path = $request->file('avatar')->store('avatars', 'public');

    // 3. Mise à jour en BDD
    $user->update([
        'avatar' => $path
    ]);

    return back()->with('success', 'Avatar mis à jour avec succès.');
}

public function account()
    {
        $user = auth()->user();

        // 1. Récupérer les inscriptions principales
        $inscriptions = $user->inscriptions()
            ->with(['event', 'formation.responsable', 'certification'])
            ->paginate(10);

       // 2. Inscriptions et contenu_inscriptions
$inscriptionIds = $user->inscriptions()->pluck('id');

        // 2. Récupérer le contenu des inscriptions via la table contenu_inscriptions
    // On récupère uniquement via les inscriptions liées à l'utilisateur
$contenuInscriptions = ContenuInscription::whereIn('inscription_id', $inscriptionIds)->get();
        // Extraire les IDs
        $eventIds = $contenuInscriptions->pluck('event_id')->filter()->unique();
        $formationIds = $contenuInscriptions->pluck('formation_id')->filter()->unique();
        $certificationIds = $contenuInscriptions->pluck('certification_id')->filter()->unique();

        // 3. Charger les formations liées via contenu_inscriptions avec responsable et évaluations
       

            // 3. Charger les formations avec leur responsable et l'évaluation liée à l'étudiant connecté
$userStudentId = $user->id;

$formations = Formation::whereIn('id', $formationIds)
    ->with([
        'responsable',
        'responsable.teacherEvaluations' => function ($query) use ($userStudentId) {
            $query->where('student_id', $userStudentId)->with('badges');
        }
    ])
    ->get()
    ->map(function ($formation) {
        $teacher = $formation->responsable;

        $formation->evaluation = $teacher 
            ? $teacher->teacherEvaluations->first() 
            : null;

        return $formation;
    });

        // 4. Récupérer les cours en ligne et documents
        $onlineClasses = Online_classe::with(['events', 'formations', 'certifications'])
            ->where(function ($query) use ($eventIds, $formationIds, $certificationIds) {
                $query->whereIn('event_id', $eventIds)
                    ->orWhereIn('formation_id', $formationIds)
                    ->orWhereIn('certification_id', $certificationIds);
            })
            ->paginate(10);

        $documents = Document::with(['events', 'formations', 'certifications'])
            ->where(function ($query) use ($eventIds, $formationIds, $certificationIds) {
                $query->whereIn('event_id', $eventIds)
                    ->orWhereIn('formation_id', $formationIds)
                    ->orWhereIn('certification_id', $certificationIds);
            })
            ->paginate(10);

        $totalZoomMeetings = $onlineClasses->total();
        $totalDocuments   = $documents->total();

        // Statistiques & données annexes
        $totalInscription = $user->inscriptions()
            ->whereIn('statut', ['livrée', 'payée'])
            ->count();

        $totalcomments = $user->comments()->count();

        $comments = $user->comments()
            ->with('blog')
            ->whereNotNull('blog_id')
            ->paginate(10);

        $commentaires = Comment::whereHas('blog', function ($query) use ($user) {
            $query->where('user_id', $user->id);
        })->get();

        $inscriptionsEnCours = $user->inscriptions()
            ->whereIn('statut', ['attente', 'traitement', 'En cours livraison', 'planification'])
            ->count();

        $data['portal_exams'] = Examen::select(['examens.*', 'formations.titre as cat_name'])
            ->join('formations', 'examens.formation_id', '=', 'formations.id')
            ->orderBy('id', 'desc')
            ->where('examens.status', '1')
            ->get()
            ->toArray();

        $student_info = User_exam::select(['user_exams.*', 'users.nom', 'examens.title', 'examens.exam_date'])
            ->join('users', 'users.id', '=', 'user_exams.user_id')
            ->join('examens', 'user_exams.exam_id', '=', 'examens.id')
            ->orderBy('user_exams.exam_id', 'desc')
            ->where('user_exams.user_id', $user->id)
            ->where('user_exams.std_status', '1')
            ->get()
            ->toArray();

        $totalquizs = User_exam::where('user_id', $user->id)
            ->where('std_status', 1)
            ->count();

        return view('front.comptes.account', $data, compact(
            'totalZoomMeetings',
            'student_info',
            'totalquizs',
            'totalInscription',
            'totalcomments',
            'inscriptionsEnCours',
            'comments',
            'inscriptions',
            'contenuInscriptions',
            'onlineClasses',
            'totalDocuments',
            'documents',
            'formations'
        ));
    }

    /**
     * Traitement de l'évaluation d'une formation
     */public function evaluateTeacher(Request $request, $formationId)
{
    // 1. On récupère la formation et son responsable
    $formation = Formation::with('responsable')->findOrFail($formationId);

    // Vérification que le responsable existe bien
    $teacherId = $formation->responsable_id 
        ?? $formation->responsable->id 
        ?? $formation->user_id;

    if (!$teacherId) {
        return redirect()->back()->with('error', 'Aucun responsable associé à cette formation.');
    }

    // 2. Validation (retrait du teacher_id car il est récupéré côté serveur)
    $request->validate([
        'rating'       => 'required|integer|min:1|max:5',
        'comment'      => 'nullable|string|max:1000',
        'is_anonymous' => 'nullable|boolean',
        'badges'       => 'nullable|array',
        'badges.*'     => 'exists:badges,id',
    ]);

    // 3. Enregistrement / Mise à jour
    $evaluation = TeacherEvaluation::updateOrCreate(
        [
            'student_id' => auth()->id(),
            'teacher_id' => $teacherId,
        ],
        [
            'rating'       => $request->rating,
            'comment'      => $request->comment,
            'is_anonymous' => $request->boolean('is_anonymous'),
            'is_approved'  => false,
        ]
    );

    // 4. Synchronisation des badges
    if ($request->has('badges')) {
        $evaluation->badges()->sync($request->input('badges', []));
    } else {
        $evaluation->badges()->detach();
    }

    return redirect()->back()->with('success', 'Votre évaluation a bien été enregistrée !');
}
    public function delecomment($id)
    {
        $comment = Comment::findOrFail($id);
        $comment->delete();


        return response()->json(['success' => true, 'message' => 'Commentaire supprimé avec succès.']);
    }




    //join exam page
    public function join_exam($id)
    {
  $user = Auth::user();

    // Récupérer les ids des formations où l'utilisateur est inscrit
    $formationIds = $user->formations()->pluck('formations.id');

        $question = Oex_question_master::where('exam_id', $id)
            ->where('status', 1)
            ->get();


        $exam = Examen::where('id', $id)->get()->first();
        $exams = Examen::whereIn('formation_id', $formationIds)
                   ->where('status', 1) // uniquement les examens actifs
                   ->with('formation') // charger la formation pour affichage
                   ->get();
        $totalPoints = $question->sum('points');
        return view('front.comptes.join_exam', ['question' => $question, 'exam' => $exam, 'totalPoints' => $totalPoints]);
    }



    //On submit
    public function submit_questions(Request $request)
    {
        $yes_ans = 0;
        $no_ans = 0;
        $totalPointsObtained = 0;
        $data = $request->all();

        $result = [];
        //dd($request->all());
        for ($i = 0; $i < $request->index; $i++) {
            if (isset($data['question' . $i]) && isset($data['ans' . $i])) {
                $q = Oex_question_master::find($data['question' . $i]);

                if ($q && $q->ans == $data['ans' . $i]) {
                    $result[$data['question' . $i]] = 'YES';
                    $yes_ans++;
                    $totalPointsObtained += $q->points;
                } else {
                    $result[$data['question' . $i]] = 'NO';
                    $no_ans++;
                }
            }
        }

        $std_info = User_exam::where('user_id', auth()->id())
            ->where('exam_id', $request->exam_id)
            ->first();

        if ($std_info) {
            $std_info->exam_joined = 1;
            $std_info->save();
        }

        $res = new Oex_result();
        $res->exam_id = $request->exam_id;
        $res->user_id = auth()->id();
        $res->yes_ans = $yes_ans;
        $res->no_ans = $no_ans;
        $res->total_points = $totalPointsObtained;
        $res->result_json = json_encode($result);
        $res->save();

        return redirect(url('account'))->with('success', 'Examen soumis avec succès !');
    }




    //Applying for exam



    public function apply_exam($id)
    {
        $checkuser = User_exam::where('user_id', auth()->id())
            ->where('exam_id', $id)
            ->first();

        if ($checkuser) {
            return response()->json([
                'status' => false,
                'message' => 'Already applied, see your exam section'
            ]);
        }

        User_exam::create([
            'user_id' => auth()->id(),
            'exam_id' => $id,
            'std_status' => 1,
            'exam_joined' => 0,
        ]);

        return response()->json([
            'status' => true,
            'message' => 'Applied successfully',

            'reload' => route('account')
        ]);
    }




    //View Result

    // View Result

    public function view_result($id)
    {


        $data['result_info'] = Oex_result::where('exam_id', $id)->where('user_id', auth()->id())->get()->first();

        $data['student_info'] = User::where('id', auth()->id())->get()->first();

        $data['exam_info'] = Examen::where('id', $id)->get()->first();
        $total = 0;

        $result_info = Oex_result::where('exam_id', $id)
            ->where('user_id', auth()->id())
            ->first();

        if ($result_info) {
            $resultData = json_decode($result_info->result_json, true);

            foreach ($resultData as $questionId => $status) {
                if ($status === 'YES') {
                    $question = Oex_question_master::find($questionId);
                    if ($question) {
                        $total += $question->points; // addition des points de chaque question correcte
                    }
                }
            }
        }



        //dd($data);
        return view('front.comptes.view_result', $data, compact('total'));
    }


    //View answer
    public function view_answer($id)
    {

        $data['question'] = Oex_question_master::where('exam_id', $id)->get()->toArray();

        return view('front.comptes.view_amswer', $data);
    }
}
