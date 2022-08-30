<?php

namespace App\Mail;

use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class NewClient extends Mailable
{

    private $user;
    private $agency;

    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(User $user, User $agency)
    {
        $this->user = $user;
        $this->agency = $agency;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $this->subject("Você possui um novo cliente!!!");
        $this->to($this->agency->email, $this->agency->name);
        return $this->markdown('alertnewclient', [
            'name' => $this->agency->name,
            'nameClient' => $this->user->name,
            'emailClient' => $this->user->email,
        ]);
    }
}
