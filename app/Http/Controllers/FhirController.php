<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use App\Patient;

class FhirController extends Controller
{
	public $token = 'ya29...';
	public $url_fhir = 'https://healthcare.googleapis.com..';
	
	/**
	* Return json fhir patient
	*/
	public function show($id)
	{
		$response = Http::withToken($this->token)
			->withHeaders([
				'Content-Type' => 'application/fhir+json; charset=utf-8'
			])
			->get($this->url_fhir.'/Patient/'.$id);
		return json_decode($response->body());
	}

	/**
	* Return patient in json format
	*/
	public function storeToFhir()
	{
		$patients = Patient::whereNotNull('run')->whereNotNull('dv')
			->with('demographic','demographic.commune','demographic.region')
			->skip(3000)
			->take(1000)
			->get();
		// $patient = Patient::with('demographic','demographic.commune','demographic.region')->find(64);
		echo '<pre>';
		foreach($patients as $patient)
		{
			//print_r($patient);
			// print_r($this->parsePatientFhirFormat($patient));
			// die();
			$response = Http::withToken($this->token)
			->withHeaders([
				'Content-Type' => 'application/fhir+json; charset=utf-8'
			])
			->post($this->url_fhir.'/Patient', $this->parsePatientFhirFormat($patient));
			print_r($response->status());
			echo "<br>";
		}

		//return json_decode(json_encode($this->parsePatientFhirFormat($patient)));
	}

	/**
	*	Retorna un objeto fhir
	*/
	public function parsePatientFhirFormat($patient)
	{
		$fhirPatient = ["resourceType" => "Patient"];

		$fhirPatient["identifier"][] = 
		[
			"system" => "http://www.registrocivil.cl/run",
			"type" => [
				"text"=>"RUN"
			],
			"use"=>"official",
			"value"=> "$patient->run-$patient->dv",
		];

		$fhirPatient["active"] = true;
		
		$fhirPatient["name"] = 
		[
			[
				"_family"=>[
					"extension"=>[
					[
						"url"=>"http://hl7.org/fhir/StructureDefinition/humanname-fathers-family",
						"valueString"=> "$patient->fathers_family",
					],
					[
						"url"=>"http://hl7.org/fhir/StructureDefinition/humanname-mothers-family",
						"valueString"=>"$patient->mothers_family"
					]
					]
				],
				"family"=>"$patient->fathers_family $patient->mothers_family",
				"given" => explode(' ',$patient->name),
				"text"=>"$patient->fullName",
				"use"=>"official"
			]
		];

		$fhirPatient["deceasedBoolean"]	= ($patient->deceased_at) ? true:false;

		if($patient->gender)
		{
			$fhirPatient["gender"] = "$patient->gender";
		}

		if($patient->birthday)
		{
			$fhirPatient["birthDate"] = "{$patient->birthday->format('Y-m-d')}";
		}

		if($patient->demographic)
		{
			if($patient->demographic->telephone)
			{
				$fhirPatient['telecom'][] =
				[
					"system"=>"phone",
					"use"=>"mobile",
					"value"=>"{$patient->demographic->telephone}"
				];
			}

			if($patient->demographic->email)
			{
				$fhirPatient['telecom'][] = 
				[
					"system"=>"email",
					"use"=>"home",
					"value"=> strtolower(trim($patient->demographic->email))
				];
			}
			
			if($patient->demographic->city)
			{
				$fhirPatient['address'][0]["city"] = "{$patient->demographic->city}";
			}

			if($patient->demographic->commune_id)
			{
				$fhirPatient['address'][0]["district"] = "{$patient->demographic->commune->name}";
			}

			if($patient->demographic->region_id)
			{
				$fhirPatient['address'][0]["state"] = "{$patient->demographic->region->name}";
			}

			if($patient->demographic->city)
			{
				$fhirPatient['address'][0]["city"] = "{$patient->demographic->city}";
			}

			if($patient->demographic->nationality)
			{
				$fhirPatient['address'][0]["country"] = $patient->demographic->nationality;
			}
				
			if($patient->demographic->street_type) 
				$fhirPatient['address'][0]['line'][0] = $patient->demographic->street_type;
			if($patient->demographic->address) 
				$fhirPatient['address'][0]['line'][0] .= ' '.$patient->demographic->address;
			if($patient->demographic->number) 
				$fhirPatient['address'][0]['line'][0] .= ' '.$patient->demographic->number;
			if($patient->demographic->department) 
				$fhirPatient['address'][0]['line'][0] .= ' Depto '.$patient->demographic->department;

			if(array_key_exists('address',$fhirPatient))
			{
				if(array_key_exists(0,$fhirPatient['address']))
					$fhirPatient['address'][0]["text"] = $fhirPatient['address'][0]['line'][0].',';
			}
			
			if($patient->demographic->city)
				$fhirPatient['address'][0]["text"] .=  ' '.$patient->demographic->city;
			if($patient->demographic->region->name)
				$fhirPatient['address'][0]["text"] .=  ' '.$patient->demographic->region->name;
			if($patient->demographic->nationality)
				$fhirPatient['address'][0]["text"] .=  ' '.$patient->demographic->nationality;

			if($patient->demographic->street_type)
			{
				$fhirPatient['address'][0]['_line'][0]['extension'][] = 
				[
					"url"=>"http://hl7.org/fhir/StructureDefinition/iso21090-ADXP-streetNameType",
					"valueString"=>"{$patient->demographic->street_type}"
				];
			}

			if($patient->demographic->address)
			{
				$fhirPatient['address'][0]['_line'][0]['extension'][] = 
				[
					"url"=>"http://hl7.org/fhir/StructureDefinition/iso21090-ADXP-streetName",
					"valueString"=>"{$patient->demographic->address}"
				];
			}

			if($patient->demographic->number)
			{
				$fhirPatient['address'][0]['_line'][0]['extension'][] = 
				[
					"url"=>"http://hl7.org/fhir/StructureDefinition/iso21090-ADXP-houseNumber",
					"valueString"=>"{$patient->demographic->number}"
				];
			}

			if($patient->demographic->department)
			{
				$fhirPatient['address'][0]['_line'][0]['extension'][] = 
				[
					"url"=>"http://hl7.org/fhir/StructureDefinition/iso21090-ADXP-additionalLocator",
					"valueString"=>"{$patient->demographic->department}"
				];
			}

			if($patient->demographic->latitude AND $patient->demographic->latitude)
			{
				$fhirPatient['address'][0]['extension'][] = [
					"extension"=>[
						[
							"url"=>"latitude",
							"valueDecimal"=> floatval($patient->demographic->latitude),
						],
						[
							"url"=>"longitude",
							"valueDecimal"=> floatval($patient->demographic->latitude)
						]
					],
					"url"=>"http://hl7.org/fhir/StructureDefinition/geolocation"
				];
			}

			if(array_key_exists('address',$fhirPatient))
			{
				if(array_key_exists(0,$fhirPatient['address']))
				$fhirPatient['address'][0]["use"] = "home";
			}
		}

		$birthday = ($patient->birthday) ? '<p><b>Fecha de nacimiento:</b>'. $patient->birthday->format('Y-m-d') .'</p>' : '';

		$fhirPatient['text'] = [
			   "div" => "<div><p><b>Nombre:</b> {$patient->fullName}</p><b>RUN:</b> $patient->run-$patient->dv<p><b>Sexo:</b> $patient->sexEsp </p>$birthday</div>",
			   "status"=>"generated"
		];

		

		return $fhirPatient;
	}
}
