<?php

namespace App\Livewire;

use App\Models\User;
use App\Models\historiques_connexion;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Verify2FA extends Component
{
    public $code;

    public function verify()
    {
        $this->validate(['code' => 'required|numeric']);

        $userId = session('2fa_user_id');
        $user = User::find($userId);

        if (!$user || $user->two_factor_code !== $this->code || now()->isAfter($user->two_factor_expires_at)) {
            session()->flash('error', 'Le code est invalide ou expiré.');
            return;
        }


        $user->resetTwoFactor();
        Auth::login($user);

        Auth::login($user);
        $count = historiques_connexion::where('ip_address', request()->ip())->count();
        if ($count == 0) {
            $userLogin = new historiques_connexion();
            $userLogin->user_id = $user->id;
            $userLogin->ip_address = request()->ip();
            $userLogin->user_agent = request()->header('User-Agent');
            $userLogin->save();
        }

        session()->forget('2fa_user_id');
        return redirect()->route('dashboard');
    }

    public function render()
    {
        return view('livewire.verify-2fa');
    }
}
