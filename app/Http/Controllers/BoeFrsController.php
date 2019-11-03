<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use App\Symptoms;


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
		return Symptoms::all();
		//return DB::connection('mysql')->table('ref_symptoms')->get();
	}

	public function titleName() {
		return DB::connection('mysql')->table('ref_title_name')->get();
	}

	public function patients() {
		return DB::connection('mysql')->table('patient')->get();
	}

	public function patientsById($id=0) {
		return DB::connection('mysql')
			->table('patients')
			->where([
				['id', '=', $id],
				['status', '=', 'active'],
			])
			->whereNull('deleted_at')
			->orderBy('id', 'desc')->get();
	}

	public function patientByField($field=null, $value=null) {
		return DB::connection('mysql')
			->table('patients')
			->where($field, '=', $value)
			->whereNull('deleted_at')
			->get();
	}

	protected function patientByAdmin($lab_status='new') {
		return DB::connection('mysql')
			->table('patients')
			->where('lab_status', '=', $lab_status)
			->whereNull('deleted_at')
			->get();
	}

	protected function patientByUser($user=null, $lab_status='new') {
		return DB::connection('mysql')
			->table('patients')
			->where('user', '=', $user)
			->where('lab_status', '=', $lab_status)
			->whereNull('deleted_at')
			->get();
	}

	protected function patientByUserHospcode($hospcode=null, $lab_status='new') {
		return DB::connection('mysql')
			->table('patients')
			->where('hospital', '=', $hospcode)
			->where('lab_status', '=', $lab_status)
			->whereNull('deleted_at')
			->get();
	}

	public function provinces() {
		return DB::connection('mysql')
			->table('ref_province')
			->orderBy('province_id', 'asc')
			->get();
	}

	public static function provinceList() {
		$prov = DB::connection('mysql')
				->table('ref_province')
				->orderBy('province_id', 'asc')
				->get();
		$provinces = $prov->keyBy('province_id');
		$provinces->all();
		return $provinces;
	}

	public function district() {
		return DB::connection('mysql')
			->table('ref_district')
			->orderBy('district_id', 'asc')
			->get();
	}

	public function districtByProv($prov_code=0) {
		return DB::connection('mysql')
			->table('ref_district')
			->where('province_id', '=', $prov_code)
			->orderBy('district_id', 'asc')
			->get();
	}

	public function subDistrictByDistrict($dist_code=0) {
		return DB::connection('mysql')
			->table('ref_sub_district')
			->where('district_id', '=', $dist_code)
			->orderBy('sub_district_id', 'asc')
			->get();
	}

	public function hospitals() {
		return DB::connection('mysql')
			->table('hospitals')
			->orderBy('id', 'asc')
			->limit(100)
			->get();
	}

	public function hospitalByActive() {
		return DB::connection('mysql')
			->table('hospitals')
			->where('accive', '=', 1)
			->orderBy('id', 'asc')
			->limit(100)
			->get();
	}

	public function hospitalByProv($prov_code=0) {
		return DB::connection('mysql')
			->table('hospitals')
			->where('prov_code', '=', $prov_code)
			->whereIn('hosp_type_code', ['05', '06', '07', '11'])
			->orderBy('id', 'asc')
			->get();
	}

	public function hospitalByCode($hosp_code=0) {
		return DB::connection('mysql')
			->table('hospitals')
			->where('hospcode', '=', $hosp_code)
			->limit(1)
			->get();
	}

	public function nationality() {
		return DB::connection('mysql')
			->table('ref_nationality')
			->orderBy('id', 'asc')
			->get();
	}

	public function occupation() {
		return DB::connection('mysql')
			->table('ref_occupation')
			->orderBy('id', 'asc')
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
	protected function convertDateToMySQL($date='00/00/0000') {
		if (!is_null($date) || !empty($date)) {
			$ep = explode("/", $date);
			$string = $ep[2]."-".$ep[1]."-".$ep[0];
		} else {
			$string = NULL;
		}
		return $string;
	}






}
