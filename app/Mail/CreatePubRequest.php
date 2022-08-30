<?php

namespace App\Mail;

use App\Models\PubPiece;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class CreatePubRequest extends Mailable
{
    use Queueable, SerializesModels;

    private $user;
    private $pub;
    private $type;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(User $user, PubPiece $pub, String $type)
    {
        $this->user = $user;
        $this->pub = $pub;
        $this->type = $type;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        if ($this->type == 'client') {
            $this->subject("O cliente {$this->user->name} fez uma requisição de uma publicidade");
        } else if ($this->type == 'agency') {
            $this->subject("A agência inseriu novas artes para {$this->pub->title}");
        }
        $this->to($this->user->email, $this->user->name);

        return $this->markdown('createpubrequest', [
            'name' => $this->user->name,
            'title' => $this->pub->title,
            'description' => $this->pub->description,
            'deliverDate' => $this->pub->deliver_date,
            'size' => $this->pub->size,
            'type' => $this->type,
        ]);
    }
}
