<?php
namespace App\Mail;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class Rejectapproval extends Mailable
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
        $introLines = array(config('app.name').': Sorry!! your associate approval request is not approved');
       // $outroLines = array('Now you can login into the Project Bidding app');
      $outroLines = array();
        $subject = config('app.name').':Reject Asscociate approval Request';
        $greeting = 'Hello '.$this->user->users_name."!";
        return $this->subject($subject)->markdown('email.approveduser',['level'=>'success','greeting'=>$greeting,'introLines'=>$introLines,'outroLines' => $outroLines]);
     
    }
}
