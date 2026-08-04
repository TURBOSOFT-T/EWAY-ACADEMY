<?php

namespace App\Http\Controllers\Back;
use App\Http\Controllers\Controller;


use App\Http\Traits\MeetingZoomTrait;
use App\Models\Online_classe;
use App\Models\User;
use Illuminate\Http\Request;

use App\Models\Certification;
use App\Http\Requests\StoreCertificationRequest;
use App\Http\Requests\UpdateCertificationRequest;

class CertificationController extends Controller
{
    /**
     * Display a listing of the resource.
     */

     use MeetingZoomTrait;

   
     public function store(Request $request)
{
    $meeting = $this->createMeeting($request);
  //  dd($request->all());

   Online_classe ::create([
        'certification_id' => $request->certification_id,
        'user_id' => auth()->user()->id,
        'meeting_id' => $meeting->id,
        'topic' => $request->topic,
        'start_at' => $request->start_at,
        'type' => $request->input('type', 'certification'),
      
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

}
