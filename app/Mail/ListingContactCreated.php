<?php

namespace App\Mail;

use App\{User, Listing};
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class ListingContactCreated extends Mailable
{
    use Queueable, SerializesModels;
    
    public $listing;
    public $sender;
    public $body;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Listing $listing, User $sender, $body)
    {
        $this->listing = $listing;
        $this->sender = $sender;
        $this->body = $body;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('email.listing.contact.message')
                ->subject("{$this->sender->full_name} has sent a message regarding your listing \"{$this->listing->title}\"")
                ->from('no-reply@passonabliss.com')
                ->replyTo($this->sender->email);
    }
}
