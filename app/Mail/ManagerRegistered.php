<?php

namespace App\Mail;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class ManagerRegistered extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    protected $user;
    protected $url;
    protected $action;
    
    public function __construct($user,$url,$setpasswordurl,$action)
    {
        $this->user           = $user;
        $this->url            = $url;
        $this->setpasswordurl = $setpasswordurl;
        $this->action         = $action;
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
                $introLines = array('Your registration for Scoped app is completed successfully.');
                $outroLines = array('Now you need to complete your account Verification in Scoped app. Please click on following button.');
           
                $subject = 'Scoped: Email Verification';
                $greeting = 'Hello '.$this->user->users_name."!";
                $actionUrl = $this->url;
                return $this->subject($subject)->markdown('email.userRegistration',['level'=>'success','greeting'=>$greeting,'introLines'=>$introLines,'outroLines'=>$outroLines, 'actionText' => 'Verify Email' , 'actionUrl' => $actionUrl]);
                exit;
            }
            else
            {
                $introLines = array('Your Project Manager user registration for Scoped app is completed successfully.Now you need to complete your account Verification in Scoped app. Please click on following button.');
                $outroLines = array('Below button is to set your password for Scoped App.');
                $subject     = 'Scoped: Project Manager Registration';
                $greeting    = 'Hello '.$this->user->users_name."!";
                $actionUrl   = $this->url;
                $passwordurl = $this->setpasswordurl;
                return $this->subject($subject)->markdown('email.managersignup',['level'=>'success','greeting'=>$greeting,'introLines'=>$introLines,'outroLines'=>$outroLines, 'actionText' => 'Verify Email' , 'actionUrl' => $actionUrl,'passwordText' => 'Set Password' , 'passwordUrl' => $passwordurl]);
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
