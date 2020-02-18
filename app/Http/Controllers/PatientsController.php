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
use App\Specimen;
use App\Lab;
use Session;
use DB;

class PatientsController extends BoeFrsController
{
	public function __construct() {
		parent::__construct();
		$this->middleware('auth');
		$this->middleware(['role:admin|hospital|lab']);
		$this->middleware('page_session');
	}


	/**
	* Display the specified resource.
	*
	* @param  int  $id
	* @return \Illuminate\Http\Response
	*/
	public function show($id)
	{
		/* prepare data */
		$titleName = parent::titleName();
		$title_name = $titleName->keyBy('id');
		$provinces = parent::provinceListArr();
		$symptoms = parent::symptoms();
		$specimen = parent::specimen();
		$specimen = $specimen->keyBy('id');
		$pathogen = parent::pathogen();
		$pathogen = $pathogen->keyBy('id');

		/* get patient */
		$patient = Patients::where('id', '=', $id)
		//->where('lab_status', '!=', 'new')
		->whereNull('deleted_at')
		->get();

		/* get patient clinical */
		$clinical = Clinical::where('ref_pt_id', $patient[0]->id)
		->whereNull('deleted_at')
		->get();

		/* get patient specimen */
		$specimen_data = Specimen::where('ref_pt_id', '=', $id)
		->whereNull('deleted_at')
		->get();
		$specimen_data = $specimen_data->keyBy('specimen_id');
		$specimen_rs = collect();
		$rs = $specimen->each(function($item, $key) use ($specimen_rs, $specimen_data) {
			$tmp['rs_id'] = $item->id;
			$tmp['rs_name_en'] = $item->name_en;
			$tmp['rs_name_th'] = $item->name_th;
			$tmp['rs_abbreviation'] = $item->abbreviation;
			$tmp['rs_note'] = $item->note;
			$tmp['rs_other_field'] = $item->other_field;
			if (count($specimen_data) > 0) {
				foreach ($specimen_data as $k => $v) {
					if ($v['specimen_id'] == $item->id) {
						$tmp['s_id'] = $v['id'];
						$tmp['s_ref_pt_id'] = $v['ref_pt_id'];
						$tmp['s_specimen_id'] = $v['specimen_id'];
						$tmp['s_specimen_other'] = $v['specimen_other'];
						$tmp['s_specimen_date'] = parent::convertMySQLDateFormat($v['specimen_date']);
						$tmp['s_specimen_result'] = $v['specimen_result'];
						$tmp['s_ref_user_id'] = $v['ref_user_id'];
						$tmp['s_created_at'] = $v['created_at'];
						$tmp['s_updated_at'] = $v['updated_at'];
						$tmp['s_deleted_at'] = $v['deleted_at'];
						break;
					} else {
						$tmp['s_id'] = null;
						$tmp['s_ref_pt_id'] = null;
						$tmp['s_specimen_id'] = null;
						$tmp['s_specimen_other'] = null;
						$tmp['s_specimen_date'] = null;
						$tmp['s_specimen_result'] = null;
						$tmp['s_ref_user_id'] = null;
						$tmp['s_created_at'] = null;
						$tmp['s_updated_at'] = null;
						$tmp['s_deleted_at'] = null;
					}
				}
			}
			$specimen_rs->put($item->id, $tmp);
		});
		$specimen_rs->all();

		/* get patient lab result */
		$patient_lab = Lab::where('ref_patient_id', $patient[0]->id)
			->whereNull('deleted_at')
			->get();
		$patient_lab = $patient_lab->toArray();

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
		$data['patient_an'] = $patient[0]->an;
		$data['patient_age'] = $patient[0]->age_year."-".$patient[0]->age_month."-".$patient[0]->age_day;
		$data['patient_house_no'] = $patient[0]->house_no;
		$data['patient_village_no'] = $patient[0]->village_no;
		$data['patient_village'] = $patient[0]->village;
		$data['patient_lane'] = $patient[0]->lane;

		if (!empty($patient[0]->province)) {
			$data['patient_province'] = $provinces[$patient[0]->province]->province_name;
		} else {
			$data['patient_province'] = null;
		}
		if (!empty($patient[0]->district)) {
			$patientDistrict = parent::districtById($patient[0]->district);
			$data['patient_district'] = $patientDistrict[0]->district_name;
		} else {
			$data['patient_district'] = null;
		}
		if (!empty($patient[0]->sub_district)) {
			$patientSubDistrict = parent::subDistrictById($patient[0]->sub_district);
			$data['patient_sub_district'] = $patientSubDistrict[0]->sub_district_name;
		} else {
			$data['patient_sub_district'] = null;
		}
		if (!empty($patient[0]->hospital)) {
			$patientHospital = parent::hospitalByCode($patient[0]->hospital);
			$data['patient_hospital'] = $patientHospital[0]->hosp_name;
		} else {
			$data['patient_hospital'] = null;
		}
		if (!empty($clinical[0]->date_sick)) {
			$data['patient_sickDate'] = parent::convertMySQLDateFormat($clinical[0]->date_sick, '/');
		} else {
			$data['patient_sickDate'] = null;
		}
		$data['patient_type'] = $clinical[0]->pt_type;
		if (!empty($clinical[0]->date_define)) {
			$data['patient_dateDefine'] = parent::convertMySQLDateFormat($clinical[0]->date_define, '/');
		} else {
			$data['patient_dateDefine'] = null;
		}
		$data['patient_temperature'] = $clinical[0]->pt_temperature;

		/* prepare sysmtom to array */
		$data['patient_fever_day'] = $clinical[0]->fever_day;
		$data['patient_fever_sym'] = $clinical[0]->fever_sym;
		$data['patient_cough_sym'] = $clinical[0]->cough_sym;
		$data['patient_sore_throat_sym'] = $clinical[0]->sore_throat_sym;
		$data['patient_runny_stuffy_sym'] = $clinical[0]->runny_stuffy_sym;
		$data['patient_sputum_sym'] = $clinical[0]->sputum_sym;
		$data['patient_headache_sym'] = $clinical[0]->headache_sym;
		$data['patient_myalgia_sym'] = $clinical[0]->myalgia_sym;
		$data['patient_fatigue_sym'] = $clinical[0]->fatigue_sym;
		$data['patient_dyspnea_sym'] = $clinical[0]->dyspnea_sym;
		$data['patient_tachypnea_sym'] = $clinical[0]->tachypnea_sym;
		$data['patient_wheezing_sym'] = $clinical[0]->wheezing_sym;
		$data['patient_conjunctivitis_sym'] = $clinical[0]->conjunctivitis_sym;
		$data['patient_vomiting_sym'] = $clinical[0]->vomiting_sym;
		$data['patient_diarrhea_sym'] = $clinical[0]->diarrhea_sym;
		$data['patient_apnea_sym'] = $clinical[0]->apnea_sym;
		$data['patient_sepsis_sym'] = $clinical[0]->sepsis_sym;
		$data['patient_encephalitis_sym'] = $clinical[0]->encephalitis_sym;
		$data['patient_intubation_sym'] = $clinical[0]->intubation_sym;
		$data['patient_pneumonia_sym'] = $clinical[0]->pneumonia_sym;
		$data['patient_kidney_sym'] = $clinical[0]->kidney_sym;
		$data['patient_other_sym'] = $clinical[0]->other_symptom;
		$data['patient_other_sym_text'] = $clinical[0]->other_symptom_specify;

		if ($clinical[0]->rapid_test == 'y') {
			$rapid_result_arr = explode(',', $clinical[0]->rapid_test_result);
		} else {
			$rapid_result_arr = array();
		}

		if (in_array('nagative', $rapid_result_arr)) {
			$data['patient_rapid_nagative'] = 'nagative';
		} else {
			$data['patient_rapid_nagative'] = null;
		}
		if (in_array('positive-flu-a', $rapid_result_arr)) {
			$data['patient_rapid_flu_a'] = 'positive-flu-a';
		} else {
			$data['patient_rapid_flu_a'] = null;
		}
		if (in_array('positive-flu-b', $rapid_result_arr)) {
			$data['patient_rapid_flu_b'] = 'positive-flu-b';
		} else {
			$data['patient_rapid_flu_b'] = null;
		}

		$data['patient_first_diag'] = $clinical[0]->first_diag;
		$data['patient_specimen'] = $specimen_rs;

		//dd($patient_lab);
		return view('patients.show',
			[
				'symptoms' => $symptoms,
				'specimen' => $specimen,
				'pathogen' => $pathogen,
				/*'specimen_data' => $specimen_data,*/
				'patient_lab' => $patient_lab,
				'data' => $data
			]
		);
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
		$specimen = parent::specimen();
		$patient = parent::patientsById($request->id);
		$user_hospital = parent::hospitalByCode(auth()->user()->hospcode);
		$hospital = parent::hospitalByBoeFrsActive();

		/* get patient clinical */
		$clinical = Clinical::find($request->id);
		$clinical = $clinical->toArray();

		/* get patient specimen */
		$specimen_data = Specimen::where('ref_pt_id', '=', $request->id)
			->whereNull('deleted_at')
			->get()->keyBy('specimen_id');
		$specimen_rs = collect();
		$rs = $specimen->each(function($item, $key) use ($specimen_rs, $specimen_data) {
			$tmp['sp_id'] = $item->id;
			$tmp['sp_name_en'] = $item->name_en;
			$tmp['sp_name_th'] = $item->name_th;
			$tmp['sp_abbreviation'] = $item->abbreviation;
			$tmp['sp_note'] = $item->note;
			$tmp['sp_other_field'] = $item->other_field;
			if (count($specimen_data) > 0) {
				foreach ($specimen_data as $k => $v) {
					if ($v['specimen_id'] == $item->id) {
						$tmp['psp_id'] = $v['id'];
						$tmp['psp_ref_pt_id'] = $v['ref_pt_id'];
						$tmp['psp_specimen_id'] = $v['specimen_id'];
						$tmp['psp_specimen_other'] = $v['specimen_other'];
						$tmp['psp_specimen_date'] = parent::convertMySQLDateFormat($v['specimen_date']);
						$tmp['psp_specimen_result'] = $v['specimen_result'];
						$tmp['psp_ref_user_id'] = $v['ref_user_id'];
						$tmp['psp_created_at'] = $v['created_at'];
						$tmp['psp_updated_at'] = $v['updated_at'];
						$tmp['psp_deleted_at'] = $v['deleted_at'];
						break;
					} else {
						$tmp['psp_id'] = null;
						$tmp['psp_ref_pt_id'] = null;
						$tmp['psp_specimen_id'] = null;
						$tmp['psp_specimen_other'] = null;
						$tmp['psp_specimen_date'] = null;
						$tmp['psp_specimen_result'] = null;
						$tmp['psp_ref_user_id'] = null;
						$tmp['psp_created_at'] = null;
						$tmp['psp_updated_at'] = null;
						$tmp['psp_deleted_at'] = null;
					}
				}
			}
			$specimen_rs->put($item->id, $tmp);
		});
		$specimen_rs->all();
		dd($specimen_rs);
		return view(
			'patients.index',
			[
				'titleName'=>$this->title_name,
				'nationality'=>$nationality,
				'occupation'=>$occupation,
				'symptoms'=>$symptoms,
				'specimen'=>$specimen,
				'patient'=>$patient,
				'user_hospital'=>$user_hospital,
				'hospital'=>$hospital,
				'clinical'=>$clinical
			]
		);
	}

	public function addPatient(Request $request) {
		/* check repeat patient data */
		$chk_patient = Patients::where('id', '=', $request->pid)
			->where('lab_status', '!=', 'new')
			->whereNull('deleted_at')
			->first();
		if ($chk_patient) {
			$chk_patient = $chk_patient->all();
			$message = collect(['status'=>500, 'msg'=>'มีข้อมูลนี้อยู่ในระบบแล้ว โปรดตรวจสอบ!', 'title'=>'Error!']);
			return redirect()->route('list-data.index')->with('message', $message);
		} else {
			/* validation */
			$this->validate($request, [
				'titleNameInput' => 'required',
				'firstNameInput' => 'required',
				'lastNameInput' => 'required',
				'hnInput' => 'required',
				'sexInput' => 'required',
				//'birthDayInput' => 'required',
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
				//'birthDayInput.required' => 'Birth date field is required.',
				'hospitalInput.required' => 'Hospital field is required',
				'provinceInput.required' => 'Province field is required',
				'districtInput.required' => 'District field is required',
				'subDistrictInput.required' => 'Sub-district field is required',
				'patientType.required' => 'Patient type field is required',
				'sickDateInput.required' => 'Sick date field is required',
				'treatDateInput.required' => 'Date define field is required'
			]);

			/* find patient by id */
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
			$clinical = Clinical::find($request->pid);
			//$clinical->ref_pt_id = $request->pid;
			//$clinical->pt_type = $request->patientType;
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
			if ($request->has('rapidTestResultInput') && count($request->rapidTestResultInput) > 0) {
				$clinical->rapid_test_result = parent::arrToStr($request->rapidTestResultInput);
			}
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
			//$clinical->ref_user_id = $request->userIdInput;

			/* get specimen ref data from ref_specimen table  */
			$specimen_data = parent::specimen();
			$specimen_data = $specimen_data->keyBy('id');

			/* update patient specimen from patient form soon */
			/*
			* get specimen by patient id *
			$patient_specimen = Specimen::where('ref_pt_id', '=', $request->pid)->get()->toArray();
			dd($patient_specimen);
			* loop for saved speicimen *
			foreach ($specimen_data as $key=>$val) {
				if ($request->has('specimen'.$val->id)) {
					$specimen = new Specimen;
					$specimen->ref_pt_id = $request->pid;
					$specimen->specimen_id = $request->specimen.$val->id;

					if ($val->other_field == 'Yes') {
						$othStr = 'specimenOth'.$val->id;
						$specimenOth = $request->$othStr;
						$specimen->specimen_other = $specimenOth;
					}

					$dateStr = 'specimenDate'.$val->id;
					$specimenDate = $request->$dateStr;
					if (!empty($specimenDate)) {
						$specimen->specimen_date = parent::convertDateToMySQL($specimenDate);
					} else {
						$specimen->specimen_date = NULL;
					}

					$specimen->ref_user_id = $request->userIdInput;
					$specimen_saved = $specimen->save();
				} else {
					continue;
				}
			}
			*/

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

	}

	public function editPatient(Request $request) {
		return 'Comming soon !!';
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
