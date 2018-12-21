<?php

namespace App\Mail;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class BlockUnblockUser extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    protected $user;
    
    protected $action;
    
    public function __construct($user,$action)
    {
        $this->user      = $user;
        
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
            $introLines = array('Sorry your profile is blocked by scheduler for some time');
            $outroLines = array('Now you can not login into the Scoped app');
            $subject = 'Scoped: Blocked your profile for the some time';
        }else if($this->action == 2){
            $introLines = array('Your profile is Unblocked by scheduler');
            $outroLines = array('Now you can login into the Scoped app');
            $subject = 'Scoped: Unblocked your profile';
        }
        $greeting = 'Hello '.$this->user->users_name."!";
        $actionUrl = url('/');
        return $this->subject($subject)->markdown('email.blockunblockuser',['level'=>'success','greeting'=>$greeting,'introLines'=>$introLines,'outroLines'=>$outroLines, 'actionText' => 'Site Link' , 'actionUrl' => $actionUrl]);
    }
}
