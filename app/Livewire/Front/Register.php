<?php

namespace App\Livewire\Front;

use App\Mail\register as MailRegister;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Livewire\Component;

class Register extends Component
{
    public $nom, $prenom, $email, $password, $telephone;

    public function render()
    {
        return view('livewire.front.register');
    }


    public function save(){
        $this->validate([
            'nom' =>'required|string',
            'prenom' =>'required|string',
            'email' =>'required|email|unique:users',
            'password' =>'required|string|min:8',
            'telephone' =>'required|string',
        ],[
            'nom.required' => 'Veuillez entrer votre nom',
            'prenom.required' => 'Veuillez entrer votre prénom',
            'email.required' => 'Veuillez entrer votre email',
            'email.email' => 'Veuillez entrer un email valide',
            'email.unique' => 'Votre email est déjà inscrit',
            'password.required' => 'Veuillez entrer votre mot de passe',
            'password.min' => 'Votre mot de passe doit contenir au moins 8 caractères',
            'telephone.required' => 'Veuillez entrer votre numéro de téléphone',
            'telephone.string' => 'Veuillez entrer un numéro de téléphone valide',
        ]);

        $user = new User();
        $user->nom = $this->nom;
        $user->prenom = $this->prenom;
        $user->email = $this->email;
        $user->password =  $this->password;
        $user->phone = $this->telephone;
        $user->role = "client";
        $user->save();

        //send mail
       // Mail::to($user->email)->send(new MailRegister($user));

        Auth::login($user);
        return redirect('/')->back()->with("success", "Votre compte est crée ");
    }


}
