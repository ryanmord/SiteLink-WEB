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
    
    public function __construct($user,$verifycode,$action)
    {
        $this->user      = $user;
        $this->verifycode  = $verifycode;
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
            $usertype = $this->user->user_types_id;
            if($usertype == 2)
            {
                $introLines = array('Your registration for Scoped app is completed successfully');
                $outroLines = array('Now you can complete your Email Verification step into the Scoped app using following verification code.','Verification code : '.$this->verifycode);
           
                $subject = 'Scoped: Email verification';
                $greeting = 'Hello '.$this->user->users_name."!";
                $actionUrl = url('/');
                return $this->subject($subject)->markdown('email.userRegistration',['level'=>'success','greeting'=>$greeting,'introLines'=>$introLines,'outroLines'=>$outroLines, 'actionText' => 'Site Link' , 'actionUrl' => $actionUrl]);
                exit;
            }
            else
            {
                $introLines = array('Your registration for Scoped app is completed successfully');
                $outroLines = array('Now you can complete your Email Verification step into the Scoped app using following verification code.','Verification code : '.$this->verifycode);
           
                $subject = 'Scoped: Email verification';
                $greeting = 'Hello '.$this->user->users_name."!";
                $actionUrl = url('/emailVerification');
                return $this->subject($subject)->markdown('email.managersignup',['level'=>'success','greeting'=>$greeting,'introLines'=>$introLines,'outroLines'=>$outroLines, 'actionText' => 'Site Link' , 'actionUrl' => $actionUrl]);
                exit;
            }
            
        }else {
            $introLines = array('Your password is changed successfully');
            $outroLines = array('Now you can login into the Scoped app');
            $subject = 'Scoped: Password changed successfully';
        }
        $greeting = 'Hello '.$this->user->users_name."!";
        $actionUrl = url('/');
        return $this->subject($subject)->markdown('email.userRegistration',['level'=>'success','greeting'=>$greeting,'introLines'=>$introLines,'outroLines'=>$outroLines, 'actionText' => 'Site Link' , 'actionUrl' => $actionUrl]);
    }
}
