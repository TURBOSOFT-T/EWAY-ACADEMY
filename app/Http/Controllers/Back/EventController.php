<?php

namespace App\Http\Controllers\Back;
use App\Http\Controllers\Controller;

use App\Models\Event;
use App\Http\Requests\StoreEventRequest;
use App\Http\Requests\UpdateEventRequest;


use App\Http\Requests\StoreOnline_ClasseRequest;
use App\Http\Requests\UpdateOnline_ClasseRequest;
use App\Notifications\SendEmailZoom;
use App\Http\Traits\MeetingZoomTrait;
use App\Models\Online_classe;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Notification;


class EventController extends Controller
{

    use MeetingZoomTrait;

   

     public function store(Request $request)
{
    $meeting = $this->createMeeting($request);
  //  dd($request->all());

   Online_classe ::create([
        'event_id' => $request->event_id,
        'user_id' => auth()->user()->id,
        'meeting_id' => $meeting->id,
        'topic' => $request->topic,
        'start_at' => $request->start_at,
        'type' => $request->input('type', 'event'),
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

public function deletemeet($id)
{
    $meet = Online_classe::findOrFail($id);
    $meet->delete();

   // return response()->json(['success' => true, 'message' => 'Réunion supprimée avec succès.']);
   return back()->with(['ok' => __('The class has been successfully deleted.')]);
}



    /**
     * Display the specified resource.
     */
    public function show(Event $event)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Event $event)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateEventRequest $request, Event $event)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Event $event)
    {
        //
    }
}
