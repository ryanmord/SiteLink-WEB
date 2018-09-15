<?php

namespace App\Mail;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class UserRegistered extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    protected $user;
    protected $password;
    protected $action;
    
    public function __construct($user,$password,$action)
    {
        $this->user      = $user;
        $this->password  = $password;
        $this->action    = $action;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        //User Registration
        if($this->action == 1){
            $introLines = array('Your registration for Project Management is finished successfully');
            $outroLines = array('You can login in to the system using following credentials.','User Name / Email : '.$this->user->users_email,'Password : '.$this->password);
            $subject = 'User Registration';
        }else if($this->action == 2){
            $introLines = array('Your password is changed successfully');
            $outroLines = array('You can login in to the system using following credentials.','User Name / Email : '.$this->user->users_email,'Password : '.$this->password);
            $subject = 'Your Password has been updated';
        }
        $greeting = 'Hello '.$this->user->users_name."!";
        $actionUrl = url('/');
        return $this->subject($subject)->markdown('email.userRegistration',['level'=>'success','greeting'=>$greeting,'introLines'=>$introLines,'outroLines'=>$outroLines, 'actionText' => 'Site Link' , 'actionUrl' => $actionUrl]);
    }
}
