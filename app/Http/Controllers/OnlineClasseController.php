<?php

namespace App\Http\Controllers;

use App\Models\Online_classe;
use App\Http\Requests\StoreOnline_classeRequest;
use App\Http\Requests\UpdateOnline_classeRequest;
use App\Notifications\SendEmailZoom;
use App\Http\Traits\MeetingZoomTrait;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Notification;


class OnlineClasseController extends Controller
{

    use MeetingZoomTrait;
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
        //   $chapitres = Chapitre::findOrFail($data['chapitre']);

        Online_classe::create([
           'formation_id' => $request->formation_id,
            'user_id' => auth()->user()->id,
            'meeting_id' => $meeting->id,
            'topic' => $request->topic,
            'start_at' => $request->start_at,
            'duration' => $meeting->duration,
            'password' => $meeting->password,
            'start_url' => $meeting->start_url,
            'join_url' => $meeting->join_url,
        ]);



        //send mail to users
        $users = User::all();
        $details = array();
        $details['topic'] = $request->topic;
        $details['join_url'] = $request->join_url;
        $details['duration'] = $request->duration;

        foreach ($users as $user) {
         //   Notification::send($user, new SendEmailZoom($details));
            // User::find(Auth::user()->id)->notify(new SendEmailNotification($details));
        }







        return back()->with(['ok' => __('The  class has been successfully created.')]);
    }



    /**
     * Display the specified resource.
     */
    public function show(Online_classe $online_classe)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Online_classe $online_classe)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateOnline_classeRequest $request, Online_classe $online_classe)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Online_classe $online_classe)
    {
        //
    }
}
