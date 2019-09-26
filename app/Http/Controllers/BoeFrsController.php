<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use App\Hospitals;

class BoeFrsController extends Controller implements BoeFrs
{
	protected $result;
	public $title_name;

	public function __construct() {
		$titleName = $this->getTitleName();
		$this->title_name = $titleName->keyBy('id');
		$this->result = null;
	}

	public function getSymptoms() {
		return DB::connection('mysql')->table('ref_symptoms')->get();
	}

	public function getTitleName() {
		return DB::connection('mysql')->table('ref_title_name')->get();
	}

	public function getPatient() {
		return DB::connection('mysql')->table('patient')->get();
	}

	public function getPatientByField($field=null, $value=null) {
		return DB::connection('mysql')
			->table('patient')
			->where($field, '=', $value)
			->get();
	}

	/* random for generate the pin */
	public function randPin($prefix=null, $separator=null) {
		// Available alpha caracters
		$characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
		// generate a pin based on 2 * x digits + a random character
		$pin = mt_rand(1000, 9999).mt_rand(1000, 9999).$characters[rand(0, strlen($characters) - 1)];
		// get date
		$date = date('Ymd');
		// shuffle the result
		$string = $prefix.$separator.str_shuffle($pin).$date;
		return $string;
	}

	/* get hospital from model */
	/*
	public function getHospital() {
		$hospitals = Hospitals::select('hospcode', 'hosp_name')
						->orderBy('id', 'asc')
						->take(100)
						->get();
		return $hospitals;
	}
	*/

	public function getHospital() {
		return DB::connection('mysql')
			->table('hospitals')
			->orderBy('id', 'asc')
			->limit(100)
			->get();
	}

	public function getProvince() {
		return DB::connection('mysql')
			->table('ref_province')
			->orderBy('province_id', 'asc')
			->get();
	}

}
