<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class DeliveryInfoEmail extends Mailable
{
    use Queueable, SerializesModels;

    public $data;

    public function __construct($data)
    {
        $this->data = $data;
    }


    public function build()
    {
        $data_array = $this->data;
        $email = config('mail.from.address');
        $from_name = config('mail.from.name');

        return $this->from($email, $from_name)
            ->subject('Delivery Info')
            ->view('emails.Info')
            ->with('data', $data_array);
    }
}
