<?php

namespace App\Mail;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class NewProject extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    protected $user;
    protected $projectName;
    protected $action;
    public function __construct($user,$action,$projectName)
    {
        $this->user = $user;
        $this->action = $action;
        $this->projectName = $projectName;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        if($this->action == 1)
        {
            $introLines = array('Congratulations!! New project assigned to you as Project Manager!');
            $outroLines = array('You can view the '.$this->projectName.' project details into the Scoped app');
            $subject = 'Scoped: Regarding new project';
        }
        else
        {
            $introLines = array('The '.$this->projectName.' project updated by scheduler!');
            $outroLines = array('You can view the '.$this->projectName.' project details into the Scoped app');
            $subject = 'Scoped: Regarding update project';
        }
        $greeting = 'Hello '.$this->user->users_name."!";
        $actionUrl = url('/');
        return $this->subject($subject)->markdown('email.newProject',['level'=>'success','greeting'=>$greeting,'introLines'=>$introLines,'outroLines'=>$outroLines, 'actionText' => 'Site Link' , 'actionUrl' => $actionUrl]);
    }
}
