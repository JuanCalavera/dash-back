<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ClientCreation extends Mailable
{
    use Queueable, SerializesModels;

    private $email;
    private $name;
    private $agency;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(String $email, String $name, String $agency)
    {
        $this->email = $email;
        $this->name = $name;
        $this->agency = $agency;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $this->subject("Venha ser cliente da {$this->agency}");
        $this->to($this->email, $this->name);

        return $this->markdown('newclient', [
            'email' => $this->email,
            'name' => $this->name,
            'agency' => $this->agency
        ]);
    }
}
