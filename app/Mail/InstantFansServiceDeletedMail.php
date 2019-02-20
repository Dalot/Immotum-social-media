<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class InstantFansServiceDeletedMail extends Mailable
{
    use Queueable, SerializesModels;
    public $ourCount;
    public $theirCount;
    public $oldProducts;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($ourCount, $theirCount, $oldProducts)
    {
        $this->ourCount = $ourCount;
        $this->theirCount = $theirCount;
        $this->oldProducts = $oldProducts;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('emails.if-service-deleted');
    }
}
