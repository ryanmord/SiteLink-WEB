<?php

namespace App\Mail;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class updateManager extends Mailable
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
    
    public function __construct($user,$url,$loginUrl,$action)
    {
        $this->user           = $user;
        $this->url            = $url;
        $this->loginUrl       = $loginUrl;
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
            
            $introLines = array('Your Project Manager profile for Scoped app has been updated successfully.');
            $outroLines = array('Below button is for to login in Scoped App.');
            $subject     = 'Scoped: Profile updated!';
            $greeting    = 'Hello '.$this->user->users_name."!";
            $loginUrl = $this->loginUrl;
            return $this->subject($subject)->markdown('email.managersignup',['level'=>'success','greeting'=>$greeting,'introLines'=>$introLines,'outroLines'=>$outroLines,'passwordText' => 'Scoped Login' , 'passwordUrl' => $loginUrl]);
           exit;
        }else {
            $introLines = array('Your Project Manager profile for Scoped app has been updated successfully.Now you need to complete your Email Verification for the Scoped app. Please click on following button.');
            $outroLines = array('Below button is for to login in Scoped App.');
            $subject     = 'Scoped: Profile updated!';
            $greeting    = 'Hello '.$this->user->users_name."!";
            $actionUrl   = $this->url;
            $loginUrl = $this->loginUrl;
            return $this->subject($subject)->markdown('email.managersignup',['level'=>'success','greeting'=>$greeting,'introLines'=>$introLines,'outroLines'=>$outroLines, 'actionText' => 'Verify Email' , 'actionUrl' => $actionUrl,'passwordText' => 'Scoped Login' , 'passwordUrl' => $loginUrl]);
            exit;
        }
        
    }
}
