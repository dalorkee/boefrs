<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Http\Controllers\BoeFrsController;
use App\Code;
use App\Clinical;
use App\Specimen;
use Session;
use Storage;

class CodeController extends BoeFrsController {
	public function __construct() {
		parent::__construct();
		$this->middleware('auth');
		$this->middleware(['role:admin|hospital|lab']);
		$this->middleware('page_session');
	}

	/**
	* Display a listing of the resource.
	*
	* @return \Illuminate\Http\Response
	*/

	public function index(Request $request) {
		/* set thai province to session */
		if (!Session::has('provinces')) {
			$provinces = BoeFrsController::provinceList();
			Session::put('provinces', $provinces);
		}
		$specimen = parent::specimen();
		$roleArr = auth()->user()->getRoleNames();
		if ($roleArr[0] == 'admin') {
			$patients = parent::patientByAdmin('new');
		} elseif ($roleArr[0] == 'hospital' || $roleArr[0] == 'lab') {
			$hospital = auth()->user()->hospcode;
			$patients = parent::patientByUserHospcode($hospital, 'new');
		} else {
			return redirect()->route('logout');
		}
		return view('code.index',
			[
				'specimen'=> $specimen,
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
	public function create() {
		//
	}

	/**
	* Store a newly created resource in storage.
	*
	* @param  \Illuminate\Http\Request  $request
	* @return \Illuminate\Http\Response
	*/
	public function store(Request $request) {
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
	public function edit($id) {
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
		//
	}

	/**
	* Remove the specified resource from storage.
	*
	* @param  int  $id
	* @return \Illuminate\Http\Response
	*/
	public function destroy($id) {
		$code = Code::destroy($id);
		if ($code) {
			response()->json(['status'=>200, 'msg'=>'ลบข้อมูลสำเร็จแล้ว']);
		} else {
			response()->json(['status'=>503, 'msg'=>'Service Unavailable']);
		}
		return redirect()->route('code.index');
	}

	public function confirmDestroy(Request $request) {
		$id = trim($request->val);
		$code = Code::destroy($id);
		if ($code) {
			return response()->json(['status'=>'200', 'msg'=>'ลบข้อมูลสำเร็จแล้ว', 'title'=>'Deleted']);
		} else {
			return response()->json(['status'=>'500', 'msg'=>'Service Unavailable', 'title'=>'Alert']);
		}
	}

	private function notFoundMessage() {
		return [
			'code' => 404,
			'message' => 'Note not found',
			'success' => false,
		];
	}

	private function successfulMessage($code, $message, $status, $count, $payload) {
		return [
			'code' => $code,
			'message' => $message,
			'success' => $status,
			'count' => $count,
			'data' => $payload,
		];
	}

	public function ajaxRequestPost(Request $request) {
		if (!isset($request) || empty($request->titleNameInput) || empty($request->firstNameInput) || empty($request->hnInput)) {
			return response()->json(['status'=>204, 'msg'=>'โปรดกรอกข้อมูลให้ครบทุกช่อง']);
		} else {
			$roleArr = auth()->user()->getRoleNames();
			if ($roleArr[0] == 'admin') {
				$province = $request->province;
				$hospcode = $request->hospcode;
				$created_by = 'admin';
			} else {
				$province = auth()->user()->province;
				$hospcode = auth()->user()->hospcode;
				$created_by = 'user';
			}

			/* get defalut specimen data */
			$specimen_data = parent::specimen();
			$specimen_data = $specimen_data->keyBy('id');

			/* chk specimen input or not  */
			$chk_specimen_count = 0;
			foreach ($specimen_data as $key=>$val) {
				if ($request->has('specimen'.$val->id)) {
					$chk_specimen_count += 1;
				} else {
					continue;
				}
			}

			/* chk specimen_date_input */
			$chk_specimen_date_input = 0;
			foreach ($specimen_data as $key=>$val) {
				if ($request->has('specimen'.$val->id)) {
					$specimenDateInput = $request->input('specimenDate'.$val->id);
					if (!empty($specimenDateInput) || !is_null($specimenDateInput)) {
						$chk_specimen_date_input += 1;
					} else {
						$chk_specimen_date_input += 0;
					}
				} else {
					continue;
				}
			}

			/* validate and save data to db */
			if ($chk_specimen_count <= 0) {
				return response()->json(['status'=>204, 'msg'=>'โปรดกรอกข้อมูลตัวอย่างให้ครบถ้วน!']);
				exit;
			} else {
				if ($chk_specimen_count != $chk_specimen_date_input) {
					return response()->json(['status'=>204, 'msg'=>'โปรดกรอกข้อมูลตัวอย่างให้ครบถ้วน!']);
					exit;
				} else {
					$code = new Code;
					$code->title_name = $request->titleNameInput;
					if (isset($request->otherTitleNameInput) && !empty($request->otherTitleNameInput)) {
						$code->title_name_other = $request->otherTitleNameInput;
					} else {
						$code->title_name_other = NULL;
					}
					$code->first_name = $request->firstNameInput;
					$code->last_name = $request->lastNameInput;
					$code->hn = $request->hnInput;
					$code->an = $request->anInput;
					$code->lab_code = parent::randPin();
					$code->ref_user_id = auth()->user()->id;
					$code->ref_user_hospcode = $hospcode;
					$code->created_by = $created_by;
					$saved = $code->save();
					$last_patient_insert_id = $code->id;

					/* Clinical save method */
					$clinical = new Clinical;
					$clinical->ref_pt_id = $last_patient_insert_id;
					$clinical->pt_type = $request->patientType;
					$clinical->ref_user_id = auth()->user()->id;
					$clinical_saved = $clinical->save();

					/* specimen save method */
					foreach ($specimen_data as $key=>$val) {
						if ($request->has('specimen'.$val->id)) {
							$specimen = new Specimen;
							$specimen->ref_pt_id = $last_patient_insert_id;
							$specimen->specimen_type_id = $request->specimen.$val->id;

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
							$specimen->ref_user_id = auth()->user()->id;
							$specimen_saved = $specimen->save();
						} else {
							continue;
						}
					}

					/* validate saved */
					if ($saved) {
						$this->simpleQrcode($code->lab_code);
						return response()->json(['status'=>200, 'msg'=>'บันทึกข้อมูลสำเร็จแล้ว']);
					} else {
						return response()->json(['status'=>500, 'msg'=>'Internal Server Error!']);
					}
				}
			}
		}
	}

	public function ajaxRequestTable() {
		$roleArr = auth()->user()->getRoleNames();
		if ($roleArr[0] == 'admin') {
			$patients = parent::patientByAdmin('new');
		} elseif ($roleArr[0] == 'hospital' || $roleArr[0] == 'lab') {
			$user_hospcode = auth()->user()->hospcode;
			$patients = parent::patientByUserHospcode($user_hospcode, 'new');
		} else {
			return redirect()->route('logout');
		}
		$htm = "
		<table class=\"table display mT-2 mb-4\" id=\"code_table1\" role=\"table\">
			<thead>
				<tr>
					<th>ลำดับ</th>
					<th>รหัส</th>
					<th>ชื่อ-สกุล</th>
					<th>HN</th>
					<th>สถานะ (รพ.)</th>
					<th>สถานะ (Lab)</th>
					<th>วัน/เวลา</th>
					<th>จัดการ</th>
				</tr>
			</thead>
			<tbody";
			foreach($patients as $key=>$value) {
				$htm .= "<tr>";
					$htm .= "<td>".$value->id."</td>";
					$htm .= "<td><span class=\"text-danger\">".$value->lab_code."</span></td>";
					if ($value->title_name != 6) {
						$htm .= "<td>".$this->title_name[$value->title_name]->title_name.$value->first_name." ".$value->last_name."</td>";
					} else {
						$htm .= "<td>".$value->title_name_other.$value->first_name." ".$value->last_name."</td>";
					}
					$htm .= "<td>".$value->hn."</td>";
					$htm .= "<td><span class=\"badge badge-pill badge-primary\">".ucfirst($value->hosp_status)."</span></td>";
					$htm .= "<td><span class=\"badge badge-pill badge-primary\">".ucfirst($value->lab_status)."</span></td>";
					$htm .= "<td>".$value->created_at."</td>";
					$htm .= "<td>";
						$htm .= "<a href=\"".route('createPatient', ['id'=>$value->id])."\" class=\"btn btn-cyan btn-sm\"><i class=\"fas fa-plus-circle\"></i></a>&nbsp;";
						$htm .= "<button name=\"delete\" type=\"button\" id=\"btn_delete_ajax".$value->id."\" class=\"btn btn-danger btn-sm\" value=\"".$value->id."\"><i class=\"fas fa-trash\"></i></button>";
					$htm .= "</td>";
				$htm .= "</tr>";
			}
			$htm .= "</tbody>";
			$htm .= "</table>";
			$htm .= "
			<script>
				$(document).ready(function() {
					$('#code_table1').DataTable({
						'searching': false,
						'paging': false,
						'ordering': true,
						'info': false,
						'responsive': true,
						'columnDefs': [{
							targets: -1,
							className: 'dt-head-right dt-body-right'
						}]
					});";
					foreach($patients as $key=>$value) {
						$htm .= "
						$('#btn_delete_ajax".$value->id."').click(function(e) {
							toastr.warning(
								'Are you sure to delete? <br><br><button class=\"btn btn-cyan btc\" value=\"0\">Cancel</button> <button class=\"btn btn-danger btk\" value=\"".$value->id."\">Delete</button>',
								'Flu Right Size',
								{
									'closeButton': true,
									'positionClass': 'toast-top-center',
									'progressBar': true,
									'showDuration': '500'
								}
							);
						});";
					}
			$htm .= "
				});
			</script>";
		return $htm;
	}

	public function ajaxGetHospByProv(Request $request)
	{
		$this->result = parent::hospitalByProv($request->prov_id);
		$htm = "<option value=\"0\">-- โปรดเลือก --</option>\n";
		foreach($this->result as $key=>$value) {
				$htm .= "<option value=\"".$value->hospcode."\">".$value->hosp_name."</option>\n";
		}
		return $htm;
	}

	public function simpleQrcode($str='str') {
		$image = \QrCode::format('png')->size(100)->generate($str);
		Storage::disk('qrcode')->put('/qr'.$str.'.png', $image);
	}
}
