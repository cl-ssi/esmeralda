<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;
use App\Mail\Test1;

class TestEmailJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    public string $email;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->email = env('MAIL_TO_TEST');
    }

    /**
     * Execute the job.
     *
     * @return void
     * @throws \Exception
     */
    public function handle()
    {
        Mail::to( env('MAIL_TO_TEST') )->send(
            (new Test1())->attachFromStorageDisk('gcs','esmeralda/suspect_cases/000002ee-dc60-4a85-9e67-11a06642f271.pdf', 'test.pdf', [
                'mime' => 'application/pdf',
            ])
        );
    }
}
