<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class NewApprove extends Mailable
{
    use Queueable, SerializesModels;

    private $supervisor;  
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($supervisor)
    {
        $this->supervisor = $supervisor;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject(__("Solicitud aprobada"))
        ->markdown('emails.new_approve')
        ->with('supervisor',$this->supervisor);
    }
}
