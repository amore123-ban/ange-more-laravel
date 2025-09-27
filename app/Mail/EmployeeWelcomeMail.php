<?php
namespace App\Mail;

use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class EmployeeWelcomeMail extends Mailable
{
    use Queueable, SerializesModels;

    public $user;
    public $password;

    /**
     * Le vrai constructeur
     */
    public function __construct(User $user, $password)
    {
        $this->user = $user;
        $this->password = $password;
    }

    /**
     * Définir le sujet du mail
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Vos identifiants de connexion',
        );
    }

    /**
     * Vue à utiliser + variables à injecter
     */
    public function content(): Content
    {
        return new Content(
            view: 'mail.employe_welcome',
            with: [
                'user' => $this->user,
                'password' => $this->password,
            ]
        );
    }

    public function attachments(): array
    {
        return [];
    }
}
