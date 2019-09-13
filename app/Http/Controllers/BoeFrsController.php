<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class BoeFrsController extends Controller implements BoeFrs
{
	protected $result;

	public function __construct() {
		$this->result = null;
		return true;
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

	public function getPatientByField($data=['field'=>'value']) {
		return DB::connection('mysql')
			->table('patient')
			->where($data['field'], $data['value'])
			->get();
	}

	public function randPin($prefix=null, $separator=null) {
		// Available alpha caracters
		$characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
		// generate a pin based on 2 * x digits + a random character
		$pin = mt_rand(1000, 9999).mt_rand(1000, 9999).$characters[rand(0, strlen($characters) - 1)];
		// shuffle the result
		$string = $prefix.$separator.str_shuffle($pin);
		return $string;
	}

}
