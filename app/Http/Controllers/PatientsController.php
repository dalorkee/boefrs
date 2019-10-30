<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App;
use App\Patients;


class PatientsController extends BoeFrsController
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
	public function index(Request $request) {
		return $this->create($request);
	}

	/**
	* Show the form for creating a new resource.
	*
	* @return \Illuminate\Http\Response
	*/
	public function create(Request $request) {
		$nationality = parent::nationality();
		$occupation = parent::occupation();
		$symptoms = parent::symptoms();
		$patient = parent::patientsById($request->id);
		$user_hospital = parent::hospitalByCode($request->hospcode);
		$hospital = parent::hospitalByActive();

		return view(
			'patients.index',
			[
				'titleName'=>$this->title_name,
				'nationality'=>$nationality,
				'occupation'=>$occupation,
				'symptoms'=>$symptoms,
				'patient'=>$patient,
				'user_hospital'=>$user_hospital,
				'hospital'=>$hospital
			]
		);
	}

	public function addPatient(Request $request) {
		$patient = Patients::find($request->pid);
		/* General section */
		if ($request->titleNameInput == -6) {
			$patient->title_name = 6;
		} else {
			$patient->title_name = $request->titleNameInput;
		}
		if (isset($request->otherTitleNameInput) && !empty($request->otherTitleNameInput)) {
			$patient->title_name_other = $request->otherTitleNameInput;
		}
		$patient->first_name = $request->firstNameInput;
		$patient->last_name = $request->lastNameInput;
		$patient->hn = $request->hnInput;
		$patient->an = $request->anInput;
		$patient->gender = $request->sexInput;
		$patient->date_of_birth = parent::convertDateToMySQL($request->birthDayInput);
		$patient->age_year = $request->ageYearInput;
		$patient->age_month = $request->ageMonthInput;
		$patient->nationality = $request->nationalityInput;

		if (isset($request->otherNationalityInput) && !empty($request->otherNationalityInput)) {
			$patient->nationality_other = $request->otherNationalityInput;
		}
		$patient->hospital = $request->hospitalInput;
		$patient->house_no = $request->houseNoInput;
		$patient->village_no = $request->villageNoInput;
		$patient->village = $request->villageInput;
		$patient->lane = $request->laneInput;
		$patient->province = $request->provinceInput;
		$patient->district = $request->districtInput;
		$patient->sub_district = $request->subDistrictInput;
		$patient->occupation = $request->occupationInput;
		if (isset($request->occupationOtherInput) && !empty($request->occupationOtherInput)) {
			$patient->occupation_other = $request->occupationOtherInput;
		}
		$patient->lab_status = 'hosp_added';

		$general = $this->storePatient($patient);
		//$patient->save();

		/* Clinical section */
		$clinical->ref_pt_id = $request->pid;
		$clinical->pt_type = $request->patientType;
		$clinical->date_sick = $request->sickDateInput;
		$clinical->date_define = $request->treatDateInput;
		$clinical->date_admit = $request->admitDateInput;
		$clinical->pt_pt_temperature = $request->temperatureInput;

		$clinical->fever_sym = $request->symptom_1_Input;
		$clinical->cough_sym = $request->symptom_2_Input;
		$clinical->sore_throat_sym = $request->symptom_3_Input;
		$clinical->runny_stuffy_sym = $request->symptom_4_Input;
		$clinical->sputum_sym = $request->symptom_5_Input;
		$clinical->headache_sym = $request->symptom_6_Input;
		$clinical->myalgia_sym = $request->symptom_7_Input;
		$clinical->fatigue_sym = $request->symptom_8_Input;
		$clinical->dyspnea_sym = $request->symptom_9_Input;
		$clinical->tachypnea_sym = $request->symptom_10_Input;
		$clinical->wheezing_sym = $request->symptom_11_Input;
		$clinical->conjunctivitis_sym = $request->symptom_12_Input;
		$clinical->vomiting_sym = $request->symptom_13_Input;
		$clinical->diarrhea_sym = $request->symptom_14_Input;
		$clinical->apnea_sym = $request->symptom_15_Input;
		$clinical->sepsis_sym = $request->symptom_16_Input;
		$clinical->encephalitis_sym = $request->symptom_17_Input;
		$clinical->intubation_sym = $request->symptom_18_Input;
		$clinical->pneumonia_sym = $request->symptom_19_Input;
		$clinical->kidney_sym = $request->symptom_20_Input;
		$clinical->other_symptom = $request->other_symptom;

		$clinical->lung = $request->lungXrayInput;
		$clinical->lung_date = $request->xRayDateInput;
		$clinical->lung_result = $request->xRayResultInput;
		$clinical->cbc_date = $request->cbcDateInput;
		$clinical->hb = $request->hbInput;
		$clinical->hct = $request->htcInput;
		$clinical->platelet_count = $request->plateletInput;
		$clinical->wbc = $request->wbcInput;
		$clinical->n = $request->nInput;
		$clinical->l = $request->lInput;
		$clinical->atyp_lymph = $request->atypLymphInput;



		//dd($patient);



	}

	/**
	* Store a newly created resource in storage.
	*
	* @param  \Illuminate\Http\Request  $request
	* @return \Illuminate\Http\Response
	*/
	public function store(Request $request) {
		//$input = $request->all();
	}

	public function storePatient($data) {
		try {
			$pt = new Patients;
			$pt = $data;
			return $pt->save();
		} catch(\Exception $e) {
			return $e->getMessage();
		}
	}

	public function storeClinical($data) {
		try {
			$cli = new Clinical;
			$cli = $data;
			return $cli->save();
		} catch(\Exception $e) {
			return $e->getMessage();
		}
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
	public function update(Request $request, $id) {
		$input = $request->all();
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

	public function districtFetch(Request $request) {
		$coll = parent::districtByProv($request->id);
		$districts = $coll->keyBy('district_id');
		$htm = "<option value=\"0\">-- โปรดเลือก --</option>";
		foreach ($districts as $key => $val) {
			$htm .= "<option value=\"".$val->district_id."\">".$val->district_name."</option>";
		}
		return $htm;
	}

	public function subDistrictFetch(Request $request) {
		$coll = parent::subDistrictByDistrict($request->id);
		$sub_districts = $coll->keyBy('sub_district_id');
		$htm = "<option value=\"0\">-- โปรดเลือก --</option>";
		foreach ($sub_districts as $key => $val) {
			$htm .= "<option value=\"".$val->sub_district_id."\">".$val->sub_district_name."</option>";
		}
		return $htm;
	}
}
