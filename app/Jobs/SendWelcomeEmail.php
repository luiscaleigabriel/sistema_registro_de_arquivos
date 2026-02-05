<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use App\Models\Usuario;
use App\Models\Aluno;
use Illuminate\Support\Facades\Mail;
use App\Mail\WelcomeEmail;

class SendWelcomeEmail implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $usuario;
    protected $aluno;

    /**
     * Create a new job instance.
     */
    public function __construct(Usuario $usuario, Aluno $aluno)
    {
        $this->usuario = $usuario;
        $this->aluno = $aluno;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        try {
            Mail::to($this->usuario->email)->send(new WelcomeEmail($this->usuario, $this->aluno));
        } catch (\Exception $e) {
            // Log error but don't fail the job
            \Log::error('Erro ao enviar email de boas-vindas: ' . $e->getMessage());
        }
    }
}
