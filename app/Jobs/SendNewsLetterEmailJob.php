<?php

namespace App\Jobs;

use App\Mail\NewsLetterEmail;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;

class SendNewsLetterEmailJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     */
    public function __construct()
    {
        //
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
//        Mail::send('emails.newsLetter', [], function ($message) {
//            $message->to(config('mail.from.address'));
//        });
        $data = ['message' => 'This is your newsletter!'];
        Mail::to('recipient@example.com')->send(new NewsLetterEmail($data));
    }
}
