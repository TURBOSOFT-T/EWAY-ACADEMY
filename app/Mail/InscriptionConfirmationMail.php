<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\Models\Inscription;

class InscriptionConfirmationMail extends Mailable
{
    use Queueable, SerializesModels;

    public $inscription;

    /**
     * Create a new message instance.
     */
    public function __construct(Inscription $inscription)
    {
        $this->inscription = $inscription;
    }

    /**
     * Build the message.
     */
    public function build()
    {
        return $this->subject('Confirmation d’inscription')
                    ->view('Mail.inscription_confirmation')
                    ->with([
                        'nom' => $this->inscription->nom,
                        'prenom' => $this->inscription->prenom,
                        'formation' => $this->inscription->formation->titre ?? '',
                    ]);
    }
}
