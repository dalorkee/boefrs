<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Patients;
use App\Clinical;
use Session;

class LabController extends BoeFrsController
{
	public function __construct() {
		parent::__construct();
		$this->middleware('auth');
		$this->middleware(['role:admin|hospital|lab']);
	}

	/**
	* Display a listing of the resource.
	*
	* @return \Illuminate\Http\Response
	*/
	public function index() {
		$roleArr = auth()->user()->getRoleNames();
		if ($roleArr[0] == 'admin') {
			$patients = Patients::where('lab_status', '!=', 'new')
				->whereNull('deleted_at')->get();
		} elseif ($roleArr[0] == 'hospital' || $roleArr[0] == 'lab') {
			$hospcode = auth()->user()->hospcode;
			$patients = Patients::where('ref_user_hospcode', '=', $hospcode)
				->where('lab_status', '!=', 'new')
				->whereNull('deleted_at')
				->get();
		} else {
			return redirect()->route('logout');
		}
		return view(
			'lab.index',
			[
				'titleName' => $this->title_name,
				'patients' => $patients
			]
		);
	}

	/**
	* Show the form for creating a new resource.
	*
	* @return \Illuminate\Http\Response
	*/
	public function create(Request $request) {
		/* prepare data */
		$provinces = parent::provinceListArr();
		$symptoms = parent::symptoms();
		$patient = Patients::where('id', '=', $request->id)
			->where('lab_status', '!=', 'new')
			->whereNull('deleted_at')
			->get();
		$clinical = Clinical::where('ref_pt_id', $patient[0]->id)
			->whereNull('deleted_at')
			->get();

		/* *** set data to array *** */
		/* user full name */
		$utn_key = auth()->user()->title_name;
		if ($utn_key == 6) {
			$utn = auth()->user()->title_name_other;
		} else {
			$utn = $titleName[$utn_key]->title_name;
		}
		$uFullName = $utn.auth()->user()->name." ".auth()->user()->lastname;
		$data['user_fullname'] = $uFullName;

		/* user office */
		$user_office = parent::hospitalByCode(auth()->user()->hospcode);
		$uOffice = $user_office[0]->hosp_name;
		$data['user_office'] = $uOffice;

		/* user province */
		$uProvince = $provinces[auth()->user()->province]->province_name;
		$data['user_province'] = $uProvince;

		/* user phone/fax */
		$data['user_phone'] = auth()->user()->phone;
		$data['user_fax'] = auth()->user()->fax;

		/* patient data */
		$data['patient_id'] = $patient[0]->id;
		$data['patient_lab_code'] = $patient[0]->lab_code;

		if ($patient[0]->title_name == 6) {
			$ptn = $patient[0]->title_name_other;
		} else {
			$ptn = $titleName[$patient[0]->title_name]->title_name;
		}
		$pFullName = $ptn.$patient[0]->first_name." ".$patient[0]->last_name;
		$data['patient_fullname'] = $pFullName;

		$data['patient_gender'] = $patient[0]->gender;
		$data['patient_hn'] = $patient[0]->hn;
		$data['patient_age'] = $patient[0]->age_year."-".$patient[0]->age_month."-".$patient[0]->age_day;
		$data['patient_house_no'] = $patient[0]->house_no;
		$data['patient_village_no'] = $patient[0]->village_no;
		$data['patient_village'] = $patient[0]->village;
		$data['patient_lane'] = $patient[0]->lane;
		$data['patient_province'] = $provinces[$patient[0]->province]->province_name;

		$patientDistrict = parent::districtById($patient[0]->district);
		$data['patient_district'] = $patientDistrict[0]->district_name;

		$patientSubDistrict = parent::subDistrictById($patient[0]->sub_district);
		$data['patient_sub_district'] = $patientSubDistrict[0]->sub_district_name;

		$data['patient_sickDate'] = parent::convertMySQLDateFormat($clinical[0]->date_sick, '/');

		$patientHospital = parent::hospitalByCode($patient[0]->hospital);
		$data['patient_hospital'] = $patientHospital[0]->hosp_name;

		$data['patient_dateDefine'] = parent::convertMySQLDateFormat($clinical[0]->date_define, '/');
		$data['patient_temperature'] = $clinical[0]->pt_temperature;

		/* prepare sysmtom to array */
		$data['patient_fever_sym'] = $clinical[0]->fever_sym;
		$data['patient_cough_sym'] = $clinical[0]->cough_sym;

		//dd($data);
		return view('lab.create',
			[
				'symptoms'=>$symptoms,
				'data'=>$data
			]
		);
	}

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
