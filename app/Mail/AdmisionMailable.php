<?php

namespace App\Mail;

use App\Models\Career;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class AdmisionMailable extends Mailable
{
    use Queueable, SerializesModels;

    public $data;
    public function __construct($data )
    {
        $this->data=$data;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $career=Career::find($this->data->career_id);
        return 
        $this->from('admin@sigu.edu.do','SIGU System')
        ->view('mails.admision')
        ->with(['data'=>$this->data, 'career'=>$career->name]);
    }
}
