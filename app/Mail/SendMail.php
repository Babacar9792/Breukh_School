<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use Illuminate\Mail\Mailables\Address;







class SendMail extends Mailable
{

    use Queueable, SerializesModels;
    public $message;
    public $subject;
    // public $firstname;
    // public $lastname;

    /**
     * Create a new message instance.
     */
    public function __construct($subject, $message)
    {
        $this->message = $message;
        $this->subject = $subject;
        // $this->firstname=$firstname;
        // $this->lastname=$lastname;
    }

    /**
     * Get the message envelope.
     */
    // public function envelope(): Envelope
    // {
    //     return new Envelope(
    //         from:new Address('bassirouseye53@gmail.com','Bassirou seye'),
    //         subject: 'Envoi Mail',
    //     );
    // }
    public function build()
    {
        $mes = $this->message;
        return $this->from('babacar77979204@gmail.com', 'Babacar')
            ->subject($this->subject)
            ->view('information')
            ->with([
                'mes' => $mes,
            ]);
    }

    /**
     * Get the message content definition.
     */


    /**
     * Get the attachments for the message.
     *
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
     */
    public function attachments(): array  
    {
        return [
            // public_path("269797803_10208897498992435_7282942147018686230_n.jpeg")
            public_path("aldieye.png")
        ];
    }





    //     use Queueable, SerializesModels;

    //     /**
    //      * Create a new message instance.
    //      */
    // public $details;
    //     public function __construct($details)
    //     {
    //         //
    //         $this->details = $details;
    //     }

    //     /**
    //      * Get the message envelope.
    //      */
    //     public function envelope(): Envelope
    //     {
    //         return new Envelope(
    //             subject: 'Send Mail',
    //         );
    //     }

    //     /**
    //      * Get the message content definition.
    //      */
    //     public function content(): Content
    //     {
    //         return new Content(
    //             view: 'emails.sendMail',
    //         );
    //     }

    //     /**
    //      * Get the attachments for the message.
    //      *
    //      * @return array<int, \Illuminate\Mail\Mailables\Attachment>
    //      */
    //     public function attachments(): array
    //     {
    //         return [];
    //     }
}
