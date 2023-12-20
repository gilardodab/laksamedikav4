<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class PostMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     * 
     */
    public $title;
    public $name;
    public $maildata;
    // public $product;
    public function __construct($title, $name, $maildata)
    {
        //
        $this->title = $title;
        $this->name = $name;
        $this->maildata = $maildata;
        // $this->product = $product;
        
    }
    

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('Faktur Baru Laksa Medika Internusa')->markdown('emails.posts');
    }
}
