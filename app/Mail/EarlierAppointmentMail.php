<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;


class EarlierAppointmentMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($businessName, $appointmentDate, $appointmentTime, $businessUrl)
    {
        $this->businessName = $businessName;
        $this->appointmentDate = $appointmentDate;
        $this->appointmentTime = $appointmentTime;
        $this->businessUrl = $businessUrl;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {

        return $this->from('appointy@niels.vannimmen.mtantwerp.eu')->view('email.earlierappointment')
        ->with([
            'businessName' => $this->businessName,
            'appointmentDate' => $this->appointmentDate,
            'appointmentTime' => $this->appointmentTime,
            'businessUrl' => $this->businessUrl,
        ])
        ->subject('Afspraak vrijgekomen');
    }
}
