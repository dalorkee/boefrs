<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use App\Hospitals;

class BoeFrsController extends Controller implements BoeFrs
{
	public $result;
	public $title_name;

	public function __construct() {
		$titleName = $this->titleName();
		$this->title_name = $titleName->keyBy('id');
		$this->result = null;
	}

	public function symptoms() {
		return DB::connection('mysql')->table('ref_symptoms')->get();
	}

	public function titleName() {
		return DB::connection('mysql')->table('ref_title_name')->get();
	}

	public function patients() {
		return DB::connection('mysql')->table('patient')->get();
	}

	public function patientByField($field=null, $value=null) {
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

	public function hospitals() {
		return DB::connection('mysql')
			->table('hospitals')
			->orderBy('id', 'asc')
			->limit(100)
			->get();
	}

	public function provinces() {
		return DB::connection('mysql')
			->table('ref_province')
			->orderBy('province_id', 'asc')
			->get();
	}

	public function hospitalByProv($prov_code=0) {
		return DB::connection('mysql')
			->table('hospitals')
			->where('prov_code', '=', $prov_code)
			->orderBy('id', 'asc')
			->get();
	}



}
