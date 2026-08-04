<?php

namespace App\Http\Controllers;


use App\Http\Requests\StoreSubscriberRequest;
use App\Http\Requests\UpdateSubscriberRequest;

use App\Providers\RouteServiceProvider;
use App\Http\Requests\Front\ContactRequest;
use App\Mail\NewsletterSubscribedMail;
use App\Models\Contact;
use App\Models\Newsletter as ModelsNewsletter;
use App\Models\Subscriber;
use Auth;
use Session;
use Hash;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Notifications\NewsletterSubscribed;
use Illuminate\Support\Str;
use App\Notifications\NewsletterNotification;
use Illuminate\Support\Facades\Mail;

class SubscriberController extends Controller
{
  



public function subscribe(Request $request)
{
    try {
        $request->validate([
            'email' => 'required|email',
        ]);

        // Vérifie si l'email existe déjà
        if (\App\Models\Subscriber::where('email', $request->email)->exists()) {
            return response()->json([
                'success' => false,
                'message' => 'Cet email est déjà abonné à la newsletter.',
            ], 409);
        }

       $token = Str::random(40);

        // Crée le nouvel abonné
        $subscriber = Subscriber::create([
            'email' => $request->email,
            'unsubscribe_token' => $token,
        ]);


        // ✅ Envoie l'e-mail de confirmation
        Mail::to($request->email)->send(new NewsletterSubscribedMail($request->email));

        return response()->json([
            'success' => true,
            'message' => 'Merci pour votre abonnement à la newsletter ! Un e-mail de confirmation vous a été envoyé. 🎉',
        ], 201);

    } catch (\Illuminate\Validation\ValidationException $e) {
        return response()->json([
            'success' => false,
            'message' => 'Veuillez entrer une adresse e-mail valide.',
        ], 422);
    } catch (\Exception $e) {
        return response()->json([
            'success' => false,
            'message' => 'Une erreur est survenue, veuillez réessayer plus tard.',
        ], 500);
    }
}    
        // Désinscription de la newsletter
       public function unsubscribe(Request $request)
{
    $email = $request->query('email');

    if (!$email) {
        return response()->view('newsletter.unsubscribe', [
            'status' => 'error',
            'message' => 'Adresse e-mail manquante.'
        ]);
    }

    $subscriber = \App\Models\Subscriber::where('email', $email)->first();

    if (!$subscriber) {
        return response()->view('newsletter.unsubscribe', [
            'status' => 'error',
            'message' => 'Aucun abonnement trouvé pour cette adresse e-mail.'
        ]);
    }

    // Si déjà désabonné
    if ($subscriber->unsubscribed_at) {
        return response()->view('newsletter.unsubscribe', [
            'status' => 'info',
            'message' => 'Vous êtes déjà désabonné(e) de notre newsletter.'
        ]);
    }

    // Met à jour le statut
    $subscriber->update(['unsubscribed_at' => now()]);

    return response()->view('newsletter.unsubscribe', [
        'status' => 'success',
        'message' => 'Vous avez été désabonné(e) avec succès de notre newsletter.'
    ]);
}

}
