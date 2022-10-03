<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use App\Patient;
use Illuminate\Support\Facades\Http;

class StorePatientOnFhir implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

	protected $patient;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(Patient $patient)
    {
        $this->patient['run'] = $patient->run.'-'.$patient->dv;
        $this->patient['name'] = $patient->name;
        $this->patient['fathers_family'] = $patient->mothers_family;
        $this->patient['mothers_family'] = $patient->mothers_family;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
		$url = env('URL_WSSSI').'/store-patient-on-fhir';
		$response = Http::get($url, $this->patient);

		abort($response->getStatusCode());
		//return $response->getStatusCode();
		// if ($response->failed()) {
		// 	return json_encode("No se pudo almacenar en fhir " . $response->reason());
		// }
    }
}
