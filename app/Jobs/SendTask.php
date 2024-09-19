<?php

namespace App\Jobs;

use App\Models\User;
use App\Mail\AssignTask;
use Illuminate\Bus\Queueable;
use Illuminate\Support\Facades\Mail;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

class SendTask implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

  public $user_emails;
   


    public function __construct($user_emails)
    {
        $this->user_emails=$user_emails;

    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $user_emails=User::whereIn('id', $this->user_email)->get('email');
        foreach($user_emails as $user_email){
        Mail::to($user_email)->send(new AssignTask());
    
    }
    }
}





