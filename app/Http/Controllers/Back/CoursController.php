<?php

namespace App\Http\Controllers\Back;
use App\Http\Controllers\Controller;

use App\Models\Cours;
use App\Http\Requests\StoreCoursRequest;
use App\Http\Requests\UpdateCoursRequest;

use App\Models\Online_Classe;
use App\Http\Requests\StoreOnline_ClasseRequest;
use App\Http\Requests\UpdateOnline_ClasseRequest;
use App\Notifications\SendEmailZoom;
use App\Http\Traits\MeetingZoomTrait;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Notification;

class CoursController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
   
     public function store(Request $request)
{
    $meeting = $this->createMeeting($request);
  //  dd($request->all());

    Online_classe::create([
        'event_id' => $request->event_id,
        'user_id' => auth()->user()->id,
        'meeting_id' => $meeting->id,
        'topic' => $request->topic,
        'start_at' => $request->start_at,
        'type' => $request->input('type', 'cours'),
       // 'start_at' => Carbon::parse($request->start_time)->toIso8601String(),
        'duration' => $meeting->duration,
        'password' => $meeting->password,
        'start_url' => $meeting->start_url,
        'join_url' => $meeting->join_url,
    ]);

    // Envoi des mails
    $users = User::all();
    $details = [
        'topic' => $request->topic,
        'join_url' => $meeting->join_url,
        'duration' => $meeting->duration,
    ];

    foreach ($users as $user) {
        // Notification::send($user, new SendEmailZoom($details));
    }

    return back()->with(['ok' => __('The class has been successfully created.')]);
}


    /**
     * Display the specified resource.
     */
    public function show(Cours $cours)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Cours $cours)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCoursRequest $request, Cours $cours)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Cours $cours)
    {
        //
    }
}
