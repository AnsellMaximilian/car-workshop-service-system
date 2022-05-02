<?php

namespace App\Mail;

use App\Models\Service;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ServiceFinished extends Mailable
{
    use Queueable, SerializesModels;
    public $service;

    /**
     * Create a new message instance.
     *
     * @return void
     */

    public function __construct(Service $service)
    {
        $this->service = $service;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('emails.service-finished');
    }
}
