<?php

namespace App\Jobs;

use App\Mail\TestMail1;
use App\Mail\TestMail2;
use App\Mail\TestMail3;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;

class SendEmailJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    protected $details;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($details)
    {
        $this->details = $details;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
            if($this->details['command']=='test1'){
                $email = new TestMail1('first topic');
                $reciever = $this->details['to'];
                Mail::to($reciever)->send($email);
            }
            else if($this->details['command']=='test2'){
                $email = new TestMail2('second topic');
                $reciever = $this->details['to'];
                Mail::to($reciever)->send($email);
            }
            else if($this->details['command']=='test3'){
                $email = new TestMail3('third topic');
                $reciever = $this->details['to'];
                Mail::to($reciever)->send($email);
            }
    }
}
