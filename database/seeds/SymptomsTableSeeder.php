<?php

use Illuminate\Support\Str;
use Illuminate\Database\Seeder;

class SymptomsTableSeeder extends Seeder
{
	/**
	* Run the database seeds.
	*
	* @return void
	*/
	public function run()
	{
		App\Symptoms::truncate();
		$symptoms = [
			[
				'symptom_name_en' => 'feverish',
				'symptom_name_th' => 'ไข้',
			],
			[
				'symptom_name_en' => 'cough',
				'symptom_name_th' => 'ไอ',
			],
			[
				'symptom_name_en' => 'sore throat',
				'symptom_name_th' => 'เจ็บคอ',
			],
			[
				'symptom_name_en' => 'runny or stuffy nose',
				'symptom_name_th' => 'มีน้ำมูก/คัดจมูก',
			],
			[
				'symptom_name_en' => 'sputum',
				'symptom_name_th' => 'มีเสมหะ',
			],
			[
				'symptom_name_en' => 'headache',
				'symptom_name_th' => 'ปวดศรีษะ',
			]
		];
		App\Symptoms::insert($symptoms);
	}
}
