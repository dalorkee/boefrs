<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App;
use App\Patients;
use App\Clinical;
use Session;
use DB;


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
		$user_hospital = parent::hospitalByCode($patient[0]->ref_user_hospcode);
		$hospital = parent::hospitalByBoeFrsActive();
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
		/* validation */
		$this->validate($request, [
			'titleNameInput' => 'required',
			'firstNameInput' => 'required',
			'lastNameInput' => 'required',
			'hnInput' => 'required',
			'sexInput' => 'required',
			'birthDayInput' => 'required',
			'hospitalInput' => 'required',
			'provinceInput' => 'required',
			'districtInput' => 'required',
			'subDistrictInput' => 'required',
			'patientType' => 'required',
			'sickDateInput' => 'required',
			'treatDateInput' => 'required'

		],[
			'titleNameInput.required' => 'Title name field is required.',
			'firstNameInput.required' => 'Firstname field is required',
			'lastNameInput.required' => 'Lastname field is required',
			'hnInput.required' => 'HN field is required',
			'sexInput.required' => 'Gender field is required.',
			'birthDayInput.required' => 'Birth date field is required.',
			'hospitalInput.required' => 'Hospital field is required',
			'provinceInput.required' => 'Province field is required',
			'districtInput.required' => 'District field is required',
			'subDistrictInput.required' => 'Sub-district field is required',
			'patientType.required' => 'Patient type field is required',
			'sickDateInput.required' => 'Sick date field is required',
			'treatDateInput.required' => 'Date define field is required'
		]);

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
		$patient->age_day = $request->ageDayInput;
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
		$patient->lab_status = 'hospital';

		/* Clinical section */
		$clinical = new Clinical;
		$clinical->ref_pt_id = $request->pid;
		$clinical->pt_type = $request->patientType;
		$clinical->date_sick = parent::convertDateToMySQL($request->sickDateInput);
		$clinical->date_define = parent::convertDateToMySQL($request->treatDateInput);
		$clinical->date_admit = parent::convertDateToMySQL($request->admitDateInput);
		$clinical->pt_temperature = $request->temperatureInput;
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
		$clinical->other_symptom = $request->symptom_21_Input;
		$clinical->other_symptom_specify = $request->other_symptom_input;
		$clinical->lung = $request->lungXrayInput;
		$clinical->lung_date = parent::convertDateToMySQL($request->xRayDateInput);
		$clinical->lung_result = $request->xRayResultInput;
		$clinical->cbc_date = parent::convertDateToMySQL($request->cbcDateInput);
		$clinical->hb = $request->hbInput;
		$clinical->hct = $request->htcInput;
		$clinical->platelet_count = $request->plateletInput;
		$clinical->wbc = $request->wbcInput;
		$clinical->n = $request->nInput;
		$clinical->l = $request->lInput;
		$clinical->atyp_lymph = $request->atypLymphInput;
		$clinical->mono = $request->monoInput;
		$clinical->baso = $request->basoInput;
		$clinical->eo = $request->eoInput;
		$clinical->band = $request->bandInput;
		$clinical->first_diag = $request->firstDiagnosisInput;
		$clinical->rapid_test = $request->influRapidInput;
		$clinical->rapid_test_name = $request->influRapidtestName;
		$clinical->rapid_test_result = $request->rapidTestResultInput;
		$clinical->flu_vaccine = $request->influVaccineInput;
		$clinical->flu_vaccine_date = parent::convertDateToMySQL($request->influVaccineDateInput);
		$clinical->antiviral = $request->virusMedicineInput;
		$clinical->antiviral_name = $request->medicineNameInput;
		$clinical->antiviral_date = parent::convertDateToMySQL($request->medicineGiveDateInput);
		$clinical->pregnant_wk = $request->pregnantWeekInput;
		$clinical->pregnant = $request->pregnantInput;
		$clinical->post_pregnant = $request->postPregnantInput;
		$clinical->fat_high = $request->fatHeightInput;
		$clinical->fat_weight = $request->fatWeightInput;
		$clinical->fat = $request->fatInput;
		$clinical->diabetes = $request->diabetesInput;
		$clinical->immune = $request->immuneInput;
		$clinical->immune_specify = $request->immuneSpecifyInput;
		$clinical->early_birth = $request->earlyBirthInput;
		$clinical->early_birth_wk = $request->earlyBirthWeekInput;
		$clinical->malnutrition = $request->malnutritionInput;
		$clinical->copd = $request->copdInput;
		$clinical->asthma = $request->asthmaInput;
		$clinical->heart_disease = $request->heartDiseaseInput;
		$clinical->cerebral = $request->cerebralInput;
		$clinical->kidney_fail = $request->kidneyFailInput;
		$clinical->cancer_specify = $request->cancerSpecifyInput;
		$clinical->cancer = $request->cancerInput;
		$clinical->other_congenital = $request->otherCongenitalInput;
		$clinical->other_congenital_specify = $request->otherCongenitalSpecifyInput;
		$clinical->contact_poultry7 = $request->contactPoultry7Input;
		$clinical->contact_poultry14 = $request->contactPoultry14Input;
		$clinical->contact_poultry14_specify = $request->contactPoultry14SpecifyInput;
		$clinical->stay_poultry14 = $request->stayPoultry14Input;
		$clinical->stay_flu14 = $request->stayFlu14Input;
		$clinical->stay_flu14_place_specify = $request->stayFlu14PlaceSpecifyInput;
		$clinical->contact_flu14 = $request->contactFlu14Input;
		$clinical->visit_flu14 = $request->visitFlu14Input;
		$clinical->health_care_worker = $request->healthcareWorkerInput;
		$clinical->suspect_flu = $request->suspectFluInput;
		$clinical->other_risk = $request->otherRiskInput;
		$clinical->other_risk_specify = $request->otherRiskInputSpecify;
		$clinical->result_cli = $request->resultCliInput;
		$clinical->result_cli_refer = $request->resultCliReferInput;
		$clinical->reported_at = parent::convertDateToMySQL($request->reportDateInput);
		$clinical->ref_user_id = $request->userIdInput;

		/* save method */
		DB::beginTransaction();
		try {
			$patient_saved = $this->storePatient($patient);
			$clinical_saved = $clinical->save();
			DB::commit();
			if ($patient_saved == true && $clinical_saved == true) {
				$message = collect(['status'=>200, 'msg'=>'บันทึกข้อมูลสำเร็จแล้ว', 'title'=>'Flu Right Site']);
			} else {
				DB::rollback();
				$message = collect(['status'=>500, 'msg'=>'Internal Server Error! Something Went Wrong!', 'title'=>'Flu Right Site']);
			}
		} catch (Exception $e) {
			DB::rollback();
			$message = collect(['status'=>500, 'msg'=>'Internal Server Error! Something Went Wrong!', 'title'=>'Flu Right Site']);
		}
		return redirect()->route('list-data.index')->with('message', $message);
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
