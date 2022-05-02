<?php

namespace App\Mail;

use App\Models\PendaftaranService;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class BookingAccepted extends Mailable
{
    use Queueable, SerializesModels;

    public $pendaftaran;

    /**
     * Create a new message instance.
     *
     * @return void
     */


    public function __construct(PendaftaranService $pendaftaran)
    {
        //
        $this->pendaftaran = $pendaftaran;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('emails.booking-accepted');
    }
}
