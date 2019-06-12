<?php

namespace App\Mail;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class ForgotPassword extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    protected $user;
    protected $url;
    
    public function __construct($user,$url)
    {
        $this->user      = $user;
        $this->url      = $url;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        //User Registration
        
          
        $subject = config('app.name').': Reset Password';
        $outroLines = 'Please click on this button for reset your password';
           
        $greeting = 'Hello '.$this->user->users_name."!";
        $actionUrl = $this->url;
        return $this->subject($subject)->markdown('email.forgotpassword',['level'=>'success','greeting'=>$greeting,'outroLines'=>$outroLines, 'actionText' => 'Password Reset Link' , 'actionUrl' => $actionUrl]);
    }
}
