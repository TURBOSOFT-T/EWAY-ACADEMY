<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Inscription;
use Illuminate\Support\Facades\Auth;

class UserDashboard extends Component
{
    public function render()
    {
        // Charge toutes les inscriptions de l'utilisateur avec leurs contenus et détails
        $inscriptions = Inscription::where('user_id', Auth::id())
            ->with([
                'contenus.formation',
                'contenus.packFormation'
            ])
            ->orderBy('created_at', 'desc')
            ->get();

        return view('livewire.user-dashboard', [
            'inscriptions' => $inscriptions
        ]);
    }
}