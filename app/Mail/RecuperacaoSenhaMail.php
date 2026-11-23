<?php

namespace App\Mail;

use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;

class RecuperacaoSenhaMail extends Mailable
{
    public string $token;
    public string $nomeUsuario;

    public function __construct(string $token, string $nomeUsuario)
    {
        $this->token = $token;
        $this->nomeUsuario = $nomeUsuario;
    }

    public function envelope(): Envelope
    {
        return new Envelope(subject: 'SEIVA — Recuperação de Senha');
    }

    public function content(): Content
    {
        return new Content(view: 'emails.recuperacao-senha');
    }
}
