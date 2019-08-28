<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;


use Ical\Ical;



class AppointmentMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($address, $startdate, $enddate, $description, $summary, $businessName, $date, $time)
    {
        $this->address = $address;
        $this->startdate = $startdate;
        $this->enddate = $enddate;
        $this->description = $description;
        $this->summary = $summary;
        
        $this->businessName = $businessName;
        $this->date = $date;
        $this->time = $time;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        try {
            $ical = (new Ical())->setAddress($this->address)
                ->setDateStart(new \DateTime($this->startdate))
                ->setDateEnd(new \DateTime($this->enddate))
                ->setDescription($this->description)
                ->setSummary($this->summary)
                ->setFilename(uniqid());
            $ical->addHeader();
        
        } catch (\Exception $e) {
            Log::error($e);
        }

        
        return $this->from('appointy@niels.vannimmen.mtantwerp.eu')->view('email.appointment')
        ->with([
            'address' => $this->address,
            'startdate' => $this->startdate,
            'enddate' => $this->enddate,
            'description' => $this->description,
            'summary' => $this->summary,
            
            'businessName' => $this->businessName,
            'date' => $this->date,
            'time' => $this->time,
            'address' => $this->address,
        ])
        ->subject('Afspraak aangemaakt')
        ->attachData($ical->getICAL(), 'invite.ics', [
            'mime' => 'text/calendar;charset=UTF-8;method=REQUEST',
        ]);
    }
}
