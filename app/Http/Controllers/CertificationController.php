<?php

namespace App\Http\Controllers;

use App\Models\Certification;
use App\Http\Requests\StoreCertificationRequest;
use App\Http\Requests\UpdateCertificationRequest;

class CertificationController extends Controller
{
    
public function certifications()
{
    $user = auth()->user();

    $certifications = $user->isAdmin()
        ? Certification::orderBy('created_at', 'desc')->get()
        : Certification::where('user_id', $user->id)->orderBy('created_at', 'desc')->get();

    return view('admin.certifications.list', compact('certifications'));
}


 
}
