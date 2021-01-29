<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class RecuperarSenha extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

     /**
     * Build the message.
     *
     * @return $this
     */
    public function build() {
        $email = config('mail.from'); 
        return $this->from($email['address'], 'Cartão Vacina - Não Responder')
                    ->view('email.recuperar-senha', $this->dados)->subject('Cartão Vacina - Recuperar Senha'); 
    }
}
