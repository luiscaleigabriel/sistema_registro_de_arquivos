<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use App\Models\Usuario;
use App\Models\Aluno;

class WelcomeEmail extends Mailable
{
    use Queueable, SerializesModels;

    public $usuario;
    public $aluno;

    /**
     * Create a new message instance.
     */
    public function __construct(Usuario $usuario, Aluno $aluno)
    {
        $this->usuario = $usuario;
        $this->aluno = $aluno;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Bem-vindo ao Instituto 30 de Setembro',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'emails.welcome',
            with: [
                'nome' => $this->usuario->nome,
                'email' => $this->usuario->email,
                'numeroAluno' => $this->aluno->numero_aluno,
                'curso' => $this->aluno->curso,
                'anoLetivo' => $this->aluno->ano_letivo,
                'dataInscricao' => $this->aluno->data_inscricao->format('d/m/Y'),
            ],
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
     */
    public function attachments(): array
    {
        return [];
    }
}
