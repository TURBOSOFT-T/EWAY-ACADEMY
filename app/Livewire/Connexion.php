<?php

namespace App\Livewire;

use App\Mail\TwoFactorCodeMail;
use App\Models\historiques_connexion;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Livewire\Component;


class Connexion extends Component
{

    public $email, $password;

    public function render()
    {
        return view('livewire.connexion');
    }

    public function connexion()
    {
        $this->validate([
            'email' => 'required|email|exists:users,email',
            'password' => 'string|required',
        ], [
            'email.required' => 'Veuillez entrer votre email',
            'email.email' => 'Veuillez entrer un email valide',
            'email.exists' => 'Cet email n\'existe pas',
            'password.string' => 'Veuillez entrer votre mot de passe',
            'password.required' => 'Veuillez entrer votre mot de passe',
        ]);


        $user = User::where('email', $this->email)
            ->first();
       
           
            if ($user && Hash::check($this->password, $user->password)) {

                // 1. Générer un code à 6 chiffres
                $code = rand(100000, 999999);

                // 2. Sauvegarder dans la base de données (expire dans 15 minutes)
                $user->update([
                    'two_factor_code' => $code,
                    'two_factor_expires_at' => now()->addMinutes(15),
                ]);

                // 3. Envoyer l'email (Prévoyez une classe Mailable : TwoFactorCodeMail)
                Mail::to($user->email)->send(new TwoFactorCodeMail($code));

                // 4. Stocker l'ID en session temporaire et rediriger
                session(['2fa_user_id' => $user->id]);

                return redirect()->route('2fa.index');
            }
         else {
            session()->flash('error', 'Adresse e-mail ou mot de passe incorrect.');
        }
    }
}
