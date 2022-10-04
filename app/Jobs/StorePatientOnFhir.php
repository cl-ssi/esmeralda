<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Http;

class StorePatientOnFhir implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

	protected $userClaveUnica;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($userClaveUnica)
    {
        $this->userClaveUnica = $userClaveUnica;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
		$url = env('URL_WSSSI').'/store-patient-on-fhir';

		$response = Http::post($url, $this->userClaveUnica);

		$url2 = 'https://i.saludiquique.gob.cl/api/post-request-inputs';
		$response2 = Http::post($url2, $this->userClaveUnica);

		if($response->getStatusCode() != 200){
			abort($response->getStatusCode());
		}
    }
}
