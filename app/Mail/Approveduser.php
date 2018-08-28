<?php
namespace App\Mail;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class Approveduser extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    protected $user;
    protected $action;
    public function __construct($user)
    {
       $this->user = $user;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $introLines = array('Your associate approval request for '.config('app.name').' is approved successfully');
        $outroLines = array('You can login into the app using following credentials.','Username : '.$this->user->users_email,'Password : '.$this->user->users_password);
        $subject = 'Asscociate Request Approved Successfully';
        $greeting = 'Hello '.$this->user->users_name."!";
        return $this->subject($subject)->markdown('email.approveduser',['level'=>'success','greeting'=>$greeting,'introLines'=>$introLines,'outroLines'=>$outroLines]);
     
    }
}
