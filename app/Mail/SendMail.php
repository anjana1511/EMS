<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Auth;
class SendMail extends Mailable
{
      use Queueable, SerializesModels;
    public $data;
   

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($data)
    {
        $this->data = $data;
     

    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $uid=Auth::user()->email;
       return $this->from($this->data['frommail'])->subject($this->data['subject'])->view('mail')->with('data', $this->data);
    }
}
