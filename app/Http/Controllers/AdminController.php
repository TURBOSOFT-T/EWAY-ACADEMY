<?php

namespace App\Http\Controllers;

use App\Models\commandes;
use App\Models\config;
use App\Models\historiques_connexion;
use App\Models\{Blog, produits, Category, Certification, Comment as ModelsComment, Marque, Contact, Coupon, Examen, favoris, Formation, Inscription, Oex_category, Oex_exam_master, Oex_question_master, Oex_result, Online_classe, Service, Testimonial, User_exam};
use App\Models\User;
use App\Models\views;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\ExportUser;
use App\Http\Traits\ListGouvernorats;
use App\Models\clients;
use App\Models\contenu_commande;
use App\Models\domaines;
use App\Models\Sponsor;
use App\Models\Event;
use App\Models\Image;
use Illuminate\Support\Facades\Validator;
use App\Models\Video;
use App\Models\notifications;
use App\Models\templates;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Mail;
use App\Mail\{OrderChangeStatut, ChangeStatut};
use Dom\Comment;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Notification;
use App\Http\Traits\MeetingZoomTrait;

class AdminController extends Controller
{
    use ListGouvernorats;
    use MeetingZoomTrait;

    public function comptes()
    {
        $commmandes = commandes::where('user_id', auth()->id())->get();
        return view('front.comptes.commandes', compact('commandes'));
    }

    public function favories()
    {
        $favorie = favoris::where('user_id', auth()->id())->get();
        return view('front.comptes.favoris', compact('favoris'));
    }

    public function admin_contact_form()
    {
        $contacts = Contact::paginate(100);
        return view('admin.contacts.list', compact('contacts'));
    }

    public function supprimer_messages(Request $request, $id)
    {
        $contact = Contact::findOrFail($id);
        $contact->delete();

        return redirect()->back()->with('success', 'Message supprimé avec succès');;
    }

    public function dashboard(Request $request)
    {

        if (auth()->user()->can('dashboard')) {
            // accès OK
        } else {
            $routes = [
                'product_view' => 'produits',
                'sponsor_view' => 'sponsors',
                'event_view' => 'events',
                'video_view' => 'videos',
                'order_view' => 'commandes',
                'clients_view' => 'clients',
                'contact_view' => 'contacts',
                'service_view' => 'services',
            ];

            foreach ($routes as $permission => $route) {
                if (auth()->user()->can($permission)) {
                    return redirect()->route($route);
                }
            }

            return redirect('/')->with('error', "Vous n'avez pas la permission d'accéder à cette page.");
        }



        $currentYear = date('Y');

        $currentYear2 = Carbon::now()->year;


        // Format ISO 8601 (YYYY-MM-DD)
        $firstDayOfYearISO = Carbon::createFromDate($currentYear2, 1, 1)->startOfDay()->format('Y-m-d');
        $lastDayOfYearISO = Carbon::createFromDate($currentYear2, 12, 31)->endOfDay()->format('Y-m-d');



        $date_debut = $request->input('date_debut') ??  $firstDayOfYearISO;
        $date_fin = $request->input('date_fin') ?? $lastDayOfYearISO;


        //get statistiques
        $visitsPerMonth = [];
        $videosPerMonth = [];


        $inscriptionMonth = [];

        for ($i = 1; $i <= 12; $i++) {
            $visitsPerMonth[] = Views::whereYear('created_at', $currentYear)
                ->whereMonth('created_at', $i)
                ->count();
            $videosPerMonth[] = Video::whereYear('created_at', $currentYear)
                ->whereMonth('created_at', $i)->count();

            $inscriptionMonth[] = User::whereYear('created_at', $currentYear)
                ->whereMonth('created_at', $i)
                ->count();
        }

        $topUsers = User::withCount('videos')
            ->orderBy('videos_count', 'desc')
            ->take(5) // Limiter aux 10 meilleurs utilisateurs
            ->get();


        $total_visites = views::whereBetween('created_at', [$date_debut, $date_fin])->count();


        $totalUser = User::whereBetween('created_at', [$date_debut, $date_fin])->count();
        $totalVideos = Video::count();
        $totalFormations = Formation::count();
        $totalMeet = Online_classe::count();
        $totalactualites = Blog::count();
        $latestVideos = Video::orderBy('created_at', 'desc')
            ->take(5)
            ->get();
        $lastevents = Event::latest()->take(5)->get();
        $lastevent = Event::latest()->take(1)->get();
        $latestVideo = Video::orderBy('created_at', 'desc')->first();

        $exam_count = Oex_exam_master::get()->count();

        $videosVues = Online_classe::count();

        $totalEvents = Event::count();
        $totalSponsors = Sponsor::count();

        return view('admin.index', compact('exam_count', 'totalMeet', 'totalactualites', 'totalFormations', 'lastevents', 'lastevent', 'latestVideo', 'videosVues', 'latestVideos', 'total_visites', 'inscriptionMonth', 'totalUser', 'videosPerMonth', 'topUsers', 'totalVideos', 'totalEvents', 'totalSponsors'));
    }



    //Manage exam page
    public function manage_exam()
    {
        $user = auth()->user();

        // Formations disponibles
        $data['formation'] = $user->isAdmin()
            ? Formation::orderBy('titre')->get()
            : Formation::where('user_id', $user->id)->orderBy('titre')->get();

        // Examens avec pagination (et non get())
        $data['examens'] = $user->isAdmin()
            ? Examen::with('formation', 'user')
            ->orderBy('exam_date', 'desc')
            ->paginate(5)
            : Examen::with('formation', 'user')
            ->where('user_id', $user->id)
            ->orderBy('exam_date', 'desc')
            ->paginate(5);

        return view('admin.quizs.manage_exam', $data);
    }





    //Adding new exam page

    public function add_new_exam(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'exam_date' => 'required|date',

            'exam_duration' => 'required|integer',
            'formation_id' => 'required|exists:formations,id',
            'question_limit' => 'required|in:20,40,49,60,80,100',
            'total_points'  => 'required|in:20,40,60,80,100',
        ]);

        $exam = new Examen();
        $exam->title = $request->title;
        $exam->user_id = auth()->id();
        $exam->exam_date = $request->exam_date;
        $exam->exam_duration = $request->exam_duration;

        $exam->formation_id = $request->formation_id;
        $exam->question_limit = $request->question_limit; // Nouveau champ
        $exam->total_points = $request->total_points;
        $exam->status = 0;

        $exam->save();


        return redirect()->route('manage_exam')->with('success', 'Exam added successfully.');
    }


    //editing exam status

    // Editing exam status

    public function exam_status(Request $request, $id)
    {

        $exam = Examen::findOrFail($id);
        $exam->status = $exam->status == 1 ? 0 : 1;
        $exam->save();

        return response()->json([
            'success' => true,
            'status' => $exam->status,
            'message' => 'Statut mis à jour avec succès'
        ]);
    }




    //Deleting exam status
    public function delete_exam($id)
    {
        $exam1 = Examen::where('id', $id)->get()->first();
        $exam1->delete();
        return redirect(url('manage_exam'));
    }



    //Edit Exam
    public function edit_exam($id)
    {
        $user = auth()->user();

        $data['formation'] = $user->isAdmin()
            ? Formation::orderBy('titre')->get()
            : Formation::where('user_id', $user->id)->orderBy('titre')->get();


        $data['exam'] = Examen::where('id', $id)->get()->first();
        return view('admin.quizs.edit_exam', $data);
    }


    //Editing Exam
    public function edit_exam_sub(Request $request)
    {

        $request->validate([
            'title' => 'required|string|max:255',
            'exam_date' => 'required|date',
            'exam_duration' => 'required|integer',
            'formation_id' => 'required|exists:formations,id',
            'question_limit' => 'required|in:20,40,60,80,100', // validation enum
            'total_points'  => 'required|in:20,40,60,80,100',
        ]);

        $exam = Examen::findOrFail($request->id);

        // Vérifier le nombre de questions actives
        $activeQuestions = Oex_question_master::where('exam_id', $exam->id)
            ->where('status', 1)
            ->count();

        if ($request->question_limit < $activeQuestions) {
            return redirect()->back()->with(
                'error',
                "Le quota des questions ne peut pas être inférieur au nombre actuel de questions actives ({$activeQuestions})."
            );
        }

        $exam = Examen::where('id', $request->id)->get()->first();
        $exam->title = $request->title;
        $exam->user_id = auth()->id();
        $exam->exam_date = $request->exam_date;
        // $exam->category = $request->exam_category;
        $exam->exam_duration = $request->exam_duration;
        $exam->formation_id = $request->formation_id;
        $exam->question_limit = $request->question_limit;
        $exam->total_points = $request->total_points;


        $exam->update();
        return redirect(url('manage_exam'));
    }



    //Manage students
    public function manage_students()
    {

        $data['exams'] = Examen::where('status', '1')->get()->toArray();
        $data['students'] = user_exam::select(['user_exams.*', 'users.name', 'examens.title as ex_name', 'examens.exam_date'])
            ->join('users', 'users.id', '=', 'user_exams.user_id')
            ->join('examens', 'user_exams.exam_id', '=', 'examens.id')->orderBy('user_exams.exam_id', 'desc')
            ->get()->toArray();
        return view('admin.quizs.manage_students', $data);
    }



    //Add new students
    public function add_new_students(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required',
            'mobile_no' => 'required',
            'exam' => 'required',
            'password' => 'required'

        ]);

        if ($validator->fails()) {
            $arr = array('status' => 'false', 'message' => $validator->errors()->all());
        } else {
            $std = new User();
            $std->name = $request->name;
            $std->email = $request->email;
            $std->mobile_no = $request->mobile_no;
            $std->exam = $request->exam;
            $std->password = Hash::make($request->password);

            $std->status = 1;

            $std->save();

            $arr = array('status' => 'true', 'message' => 'student added successfully', 'reload' => url('admin/manage_students'));
        }

        echo json_encode($arr);
    }



    //Editing student status
    public function student_status($id)
    {
        $std = user_exam::where('id', $id)->get()->first();

        if ($std->std_status == 1)
            $status = 0;
        else
            $status = 1;

        $std1 = user_exam::where('id', $id)->get()->first();
        $std1->std_status = $status;
        $std1->update();
    }


    //Deleting students
    public function delete_students($id)
    {

        $std = user_exam::where('id', $id)->get()->first();
        $std->delete();
        // return redirect('manage_students');
        return redirect(url('registered_students'));
    }



    //Editing students
    public function edit_students_final(Request $request)
    {

        $std = User::where('id', $request->id)->get()->first();
        $std->name = $request->name;
        $std->email = $request->email;
        $std->mobile_no = $request->mobile_no;
        $std->exam = $request->exam;
        if ($request->password != '')
            $std->password = $request->password;

        $std->update();
        echo json_encode(array('status' => 'true', 'message' => 'Successfully updated', 'reload' => url('admin/manage_students')));
    }




    //Registered student page
    public function registered_students()
    {

        $data['exams'] = Examen::where('status', '1')->get()->toArray();
        $data['students'] = User_exam::select(['user_exams.*', 'users.nom', 'examens.title as ex_name', 'examens.exam_date'])
            ->join('users', 'users.id', '=', 'user_exams.user_id')
            ->join('examens', 'user_exams.exam_id', '=', 'examens.id')->orderBy('user_exams.exam_id', 'desc')
            ->get()->toArray();

        //dd($data);
        return view('admin.quizs.registered_students', $data);
    }


    //Deleting students egistered
    public function delete_registered_students($id)
    {

        $std = User::where('id', $id)->get()->first();
        $std->delete();
        //  return redirect('registered_students');

        return view('admin.quizs.registered_students');
    }




    //addning questions
    public function add_questions($id)
    {


        // $data['questions'] = Oex_question_master::where('exam_id', $id)->get()->toArray();
        $data['questions'] = Oex_question_master::where('exam_id', $id)
            ->orderBy('id', 'desc')
            ->paginate(10);
        $data['exam'] = Examen::findOrFail($id);
        //  dd($data);
        return view('admin.quizs.add_questions', $data);
    }



    //adding new questions
    public function add_new_question(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'question' => 'required',
            'option_1' => 'required',
            'option_2' => 'required',
            'option_3' => 'required',
            'option_4' => 'required',
            'ans' => 'required',
            'exam_id' => 'required|exists:examens,id',
            // 'points' => 'required|integer|min:1',
        ]);
        $exam = Examen::findOrFail($request->exam_id);
        $activeQuestions = Oex_question_master::where('exam_id', $request->exam_id)
            ->where('status', 1)
            ->count();

        if ($exam->question_limit && $activeQuestions >= $exam->question_limit) {
            return redirect()->back()->with('error', "Vous avez atteint la limite de {$exam->question_limit} questions actives pour cet examen.");
        }


        if ($exam->total_points && $activeQuestions >= $exam->total_points) {
            return redirect()->back()->with('error', "Vous avez atteint la limite de {$exam->total_points} points actifs pour cet examen.");
        }
        //dd($request->all());
        if ($validator->fails()) {
            $arr = array('status' => 'flase', 'message' => $validator->errors()->all());
        } else {

            $q = new Oex_question_master();
            $q->exam_id = $request->exam_id;
            $q->questions = $request->question;
            $q->points = $request->points;

            if ($request->ans == 'option_1') {
                $q->ans = $request->option_1;
            } elseif ($request->ans == 'option_2') {
                $q->ans = $request->option_2;
            } elseif ($request->ans == 'option_3') {
                $q->ans = $request->option_3;
            } else {
                $q->ans = $request->option_4;
            }



            $q->status = 0;
            $q->options = json_encode(array('option1' => $request->option_1, 'option2' => $request->option_2, 'option3' => $request->option_3, 'option4' => $request->option_4));

            $q->save();

            return redirect()->back();
        }

        echo json_encode($arr);
    }



    //Edit question status


    // Edit question status
    public function question_status(Request $request, $id)
    {
        $question = Oex_question_master::findOrFail($id);
        $exam = Examen::findOrFail($question->exam_id);

        // Vérification si on veut activer la question
        if ($question->status == 0) {
            $activeQuestions = Oex_question_master::where('exam_id', $question->exam_id)
                ->where('status', 1)
                ->count();

            if ($activeQuestions >= $exam->question_limit) {
                return response()->json([
                    'success' => false,
                    'status' => $question->status,
                    'total_points' => Oex_question_master::where('exam_id', $question->exam_id)
                        ->where('status', 1)
                        ->sum('points'),
                    'message' => "Impossible d'activer cette question. Limite de {$exam->question_limit} questions actives atteinte."
                ]);
            }

            // Vérification du total des points si l'examen a une limite
            if (isset($exam->total_points)) {
                $totalPoints = Oex_question_master::where('exam_id', $question->exam_id)
                    ->where('status', 1)
                    ->sum('points');

                if ($totalPoints + $question->points > $exam->total_points) {
                    return response()->json([
                        'success' => false,
                        'status' => $question->status,
                        'total_points' => $totalPoints,
                        'message' => "Impossible d'activer cette question. Total des points maximum ({$exam->total_points}) dépassé."
                    ]);
                }
            }
        }

        // Inverser le statut
        $question->status = $question->status == 1 ? 0 : 1;
        $question->save();

        // Total des points après mise à jour
        $totalPoints = Oex_question_master::where('exam_id', $question->exam_id)
            ->where('status', 1)
            ->sum('points');

        return response()->json([
            'success' => true,
            'status' => $question->status,
            'total_points' => $totalPoints,
            'message' => 'Statut de la question mis à jour avec succès'
        ]);
    }

    public function question_status2(Request $request, $id)
    {
        $question = Oex_question_master::findOrFail($id);
        $exam = Examen::findOrFail($question->exam_id);

        // Si on veut activer la question
        if ($question->status == 0) { // actuellement inactive
            $activeQuestions = Oex_question_master::where('exam_id', $question->exam_id)
                ->where('status', 1)
                ->count();

            if ($activeQuestions >= $exam->question_limit) {
                return response()->json([
                    'success' => false,
                    'status' => $question->status,
                    'message' => "Impossible d'activer cette question. Limite de {$exam->question_limit} questions actives atteinte."
                ]);
            }
        }

        // Inverser le statut
        $question->status = $question->status == 1 ? 0 : 1;
        $question->save();

        return response()->json([
            'success' => true,
            'status' => $question->status,
            'message' => 'Statut de la question mis à jour avec succès'
        ]);
    }

    public function question_status1(Request $request, $id)
    {
        $question = Oex_question_master::findOrFail($id);
        $question->status = $question->status == 1 ? 0 : 1;
        $question->save();

        return response()->json([
            'success' => true,
            'status' => $question->status,
            'message' => 'Statut de la question mis à jour avec succès'
        ]);
    }



    //Delete questions
    public function delete_question($id)
    {

        $q = Oex_question_master::where('id', $id)->get()->first();
        $exam_id = $q->exam_id;
        $q->delete();

        return redirect(url('add_questions/' . $exam_id));
    }



    //update questions
    public function update_question($id)
    {

        $data['q'] = Oex_question_master::where('id', $id)->get()->toArray();

        return view('admin.quizs.update_question', $data);
    }


    //Edit question
    public function edit_question_inner(Request $request)
    {

        $q = Oex_question_master::where('id', $request->id)->get()->first();

        $q->questions = $request->question;
        $q->points = $request->points;

        if ($request->ans == 'option_1') {
            $q->ans = $request->option_1;
        } elseif ($request->ans == 'option_2') {
            $q->ans = $request->option_2;
        } elseif ($request->ans == 'option_3') {
            $q->ans = $request->option_3;
        } else {
            $q->ans = $request->option_4;
        }

        $q->options = json_encode(array('option1' => $request->option_1, 'option2' => $request->option_2, 'option3' => $request->option_3, 'option4' => $request->option_4));

        $q->update();
        return redirect(url('add_questions/' . $q->exam_id));
        // echo json_encode(array('status'=>'true','message'=>'successfully updated','reload'=>url('admin/add_questions/'.$q->exam_id)));

    }


    public function admin_view_result($id)
    {

        $std_exam = User_exam::where('id', $id)->get()->first();

        $data['student_info'] = User::where('id', $std_exam->user_id)->get()->first();

        $data['exam_info'] = Examen::where('id', $std_exam->exam_id)->get()->first();

        $data['result_info'] = Oex_result::where('exam_id', $std_exam->exam_id)->where('user_id', $std_exam->user_id)->get()->first();
        $total = 0;
        $result =  Oex_result::where('exam_id', $std_exam->exam_id)->where('user_id', $std_exam->user_id)->get()->first();


        if ($result) {
            $resultData = json_decode($result->result_json, true);

            foreach ($resultData as $questionId => $status) {
                if ($status === 'YES') {
                    $question = Oex_question_master::find($questionId);
                    if ($question) {
                        $total += $question->points; // addition des points de chaque question correcte
                    }
                }
            }
        }

        return view('admin.quizs.admin_view_result', $data, compact('total'));
    }



    public function update_config(Request $request)
    {
        $send_mail_update_commande = $request->input('send_mail_update_commande') ? 1 : 0;
        $config = config::first();
        $config->send_mail_update_commande = $send_mail_update_commande;
        $config->save();

        return redirect()
            ->route('commandes')
            ->with('success', 'Configuration mise à jour avec succès');
    }




    public function export_clients()
    {
        $users = clients::select('nom', 'phone', 'adresse', 'pays', 'gouvernorat')
            ->get();
        return Excel::download(new ExportUser($users), 'users.xlsx');
    }



    public function live_notifications()
    {
        $total = notifications::where("statut", "unread")->count();
        return response()->json(
            [
                'total' => $total
            ]
        );
    }
    //////////Categories/////////////
    public function category_add()
    {
        return view('admin.categories.add');
    }

    public function categories()
    {
        return view('admin.categories.list');
    }

    public function categories_update($id)
    {
        $category = Category::find($id);
        if (!$category) {
            $message = "Category non disponible !";
            abort(404, $message);
        }
        return view('admin.categories.update', compact('category'));
    }

    //////////////Les meetings//////////////
    public function webinaire_add()
    {
        $user = auth()->user();

        $formations = $user->isAdmin()
            ? Formation::orderBy('titre')->get()
            : Formation::where('user_id', $user->id)->orderBy('titre')->get();

        $events = $user->isAdmin()
            ? Event::orderBy('titre')->get()
            : Event::where('user_id', $user->id)->orderBy('titre')->get();

        $certifications = $user->isAdmin()
            ? Certification::orderBy('titre')->get()
            : Certification::where('user_id', $user->id)->orderBy('titre')->get();

        return view('admin.webinaires.add', compact('formations', 'events', 'certifications'));
    }

    public function webinaire_add2()
    {
        $formations = Formation::all();
        $events = Event::all();
        $certifications = Certification::all();
        return view('admin.webinaires.add', compact('formations', 'events', 'certifications'));
    }


    public function store(Request $request)
    {
        $request->validate([
            'type' => 'required|in:formation,event,certification',
            'topic' => 'required|string',
            'start_at' => 'required|date',
            'formation_id' => 'nullable|exists:formations,id',
            'event_id' => 'nullable|exists:events,id',
            //  'certification_id' => 'nullable|exists:certifications,id',
        ]);

        $meeting = $this->createMeeting($request);

        $onlineClass = new Online_classe();
        $onlineClass->user_id = auth()->id();
        $onlineClass->meeting_id = $meeting->id;
        $onlineClass->topic = $request->topic;
        $onlineClass->start_at = $request->start_at;
        $onlineClass->duration = $meeting->duration;
        $onlineClass->password = $meeting->password;
        $onlineClass->start_url = $meeting->start_url;
        $onlineClass->join_url = $meeting->join_url;
        $onlineClass->type = $request->type;

        // Gestion des types
        if ($request->type === 'formation') {
            $onlineClass->formation_id = $request->formation_id;
            $onlineClass->event_id = null;
            // $onlineClass->certification_id = null;
        } elseif ($request->type === 'event') {
            $onlineClass->event_id = $request->event_id;
            $onlineClass->formation_id = null;
            //  $onlineClass->certification_id = null;
        } /* elseif ($request->type === 'certification') {
            $onlineClass->certification_id = $request->certification_id;
            $onlineClass->formation_id = null;
            $onlineClass->event_id = null;
        } */

        $onlineClass->save();

        // Envoi des mails (optionnel)
        $users = User::all();
        $details = [
            'topic' => $request->topic,
            'join_url' => $meeting->join_url,
            'duration' => $meeting->duration,
        ];

        foreach ($users as $user) {
            // Notification::send($user, new SendEmailZoom($details));
        }

        return back()->with('ok', __('The class has been successfully created.'));
    }





    public function webinaires()
    {
        return view('admin.webinaires.list');
    }




    /////////////Les documents//////////////////
    public function document_add()
    {
        /*  $formations = Formation::all();
      $events = Event::all();
      $certifications = Certification::all(); */

        $user = auth()->user();

        $formations = $user->isAdmin() ? Formation::orderBy('titre')->get()
            : Formation::where('user_id', $user->id)->orderBy('titre')->get();

        $events = $user->isAdmin() ? Event::orderBy('titre')->get()
            : Event::where('user_id', $user->id)->orderBy('titre')->get();

        $certifications = $user->isAdmin() ? Certification::orderBy('titre')->get()
            : Certification::where('user_id', $user->id)->orderBy('titre')->get();

        return view('admin.documents.add', compact('formations', 'events', 'certifications'));
    }


    public function documents()
    {
        return view('admin.documents.list');
    }

    //////////Services///////////////////////
    public function service_add()
    {
        return view('admin.services.add');
    }

    public function services()
    {
        return view('admin.services.list');
    }

    public function services_update($id)
    {
        $service = Service::find($id);
        if (!$service) {
            $message = "Service non disponible !";
            abort(404, $message);
        }
        return view('admin.services.update', compact('service'));
    }


    //////////Blogs////////////////////////////

    public function blog_add()
    {
        return view('admin.blogs.add');
    }

    public function blogs()
    {
        return view('admin.blogs.list');
    }

    public function blogs_update($id)
    {
        $blog = Blog::find($id);
        if (!$blog) {
            $message = "Blog non disponible !";
            abort(404, $message);
        }
        return view('admin.blogs.update', compact('blog'));
    }


    /////////////Formations////////////

    public function formations()
    {
        $user = auth()->user();

        if ($user->role === 'admin') {
            $formations = Formation::all();
        } else {
            $formations = Formation::where('user_id', $user->id)->get();
        }



        return view('admin.formations.list', compact('formations'));
    }
    public function inscriptions()
    {

        $inscriptions = Inscription::with(['country', 'state', 'city', 'formation'])
            ->where('type', 'Formation')
            ->get();
        return view('admin.formations.list-inscriptions', compact('inscriptions'));
    }


    //////////////////////events//////////////

    public function events()
    {
        $events = Event::all();
        return view('admin.evenements.list', compact('events'));
    }

    public function inscriptions_evenements()
    {
        // $inscriptions = Inscription::all();
        $inscriptions = Inscription::with(['country', 'state', 'city', 'event'])
            ->where('type', 'Event')
            ->get();
        return view('admin.evenements.list-inscriptions', compact('inscriptions'));
    }


    /////////////////Certifications///////

    public function certifications()
    {
        $certifications4 = Certification::all();
        return view('admin.certifications.list', compact('certifications'));
    }

    public function inscriptions_certifications()
    {
        // $inscriptions = Inscription::all();
        $inscriptions = Inscription::with(['country', 'state', 'city', 'certification'])
            ->where('type', 'Certificationt')
            ->get();
        return view('admin.certifications.list-inscriptions', compact('inscriptions'));
    }


    /////////////////sponsor//////////////

    public function sponsors()
    {

        $sponsors = Sponsor::all();
        return view('admin.sponsors.list', compact('sponsors'));
    }
    ///////////////Testimonials////////////

    public function testimonials()
    {
        $testimonials = Testimonial::paginate(10);
        return view('admin.testimonials.list', compact('testimonials'));
    }

    //////////////////Comments//////////////
    public function comment()
    {
        $comments = ModelsComment::paginate(10);

        return view('admin.comments.list', compact('comments'));
    }

    ///////////////////////Images////////////

    public function images()
    {
        $images = Image::all();
        return view('admin.images.list', compact('images'));
    }

    ////////////////////////videos////////////

    public function videos()
    {
        $videos = Video::all();
        return view('admin.videos.list', compact('videos'));
    }

    public function sponsor_add()
    {
        return view('admin.sponsors.add');
    }

    public function sponsor_update($id)
    {

        $sponsor = Sponsor::find($id);
        if (!$sponsor) {
            $message = "Sponsor non disponible !";
            abort(404, $message);
        }

        return view('admin.sponsors.update', compact('sponsor'));
    }





    ////////////////coupons //////////////////

    public function coupons()
    {
        $coupons = Coupon::orderBy('id', 'DESC')->paginate('10');
        return view('admin.coupons.list', compact('coupons'));
    }

    public function coupon_add()
    {
        $commercials = User::where('role', 'commercial')->get();
        return view('admin.coupons.add', compact('commercials'));
    }

    public function coupons_update($id)
    {
        $coupon = Coupon::find($id);
        if (!$coupon) {
            $message = "Coupon non disponible !";
            abort(404, $message);
        }
        return view('admin.coupons.update', compact('coupon'));
    }





    public function parametres()
    {
        $connexions = historiques_connexion::Orderby("id", "Desc")
            ->where('user_id', Auth::id())
            ->get();

        $ipAddress = request()->ip();
        return view('admin.parametres.index', compact('connexions'));
    }


    public function personnels()
    {
        // $personnels = User::where('role', 'personnel')->get();
        $total_supprimers = User::onlyTrashed()->count();
        //   $personnels = User::whereNotIn('role', ['client','etudiant', 'admin'])->get();
        $personnels = User::whereIn('role', ['enseignant', 'admin', 'personnel', 'commercial'])->get();
        return view('admin.personnels.list', compact('personnels', 'total_supprimers'));
    }


    public function corbeillepersonnel()
    {
        return view("admin.personnels.corbeille");
    }

    public function updateRole(Request $request, $id)
    {
        // Validation
        $request->validate([
            'role' => 'required|string'
        ]);

        // Recherche utilisateur
        $user = User::findOrFail($id);

        // Mise à jour
        $user->role = $request->role;
        $user->save();

        // Redirection + message
        return redirect()->back()->with('success', 'Rôle mis à jour avec succès');
    }









    public function clients()
    {
        $clients = User::whereNotIn('role', ['personnel', 'commercial', 'admin'])->get();
        return view('admin.clients.list', compact('clients'));
    }


    //////////////////Support client

    public function support()
    {
        return view('admin.supports.list');
    }



    public function contact_admin()
    {
        return view('admin.parametres.contact');
    }

    public function delete_personnel($id)
    {
        $user = User::where("id", '=', $id)->first();
        if ($user) {
            $user->delete();
            return redirect()->back()->with('success', 'Personnel supprimé avec succès!');
        }
    }


    public function update_permission(Request $request)
    {

        $selectedPermissions = $request->input('permissions', []);
        $user = User::findOrFail($request->input('id'));
        $user->syncPermissions($selectedPermissions);
        return redirect()
            ->back()
            ->with('success', 'Permissions mises à jour avec succès.');
    }
}
