<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Code;
use DB;
use Session;

class CodeController extends BoeFrsController
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
		$roleArr = auth()->user()->getRoleNames();
		if ($roleArr[0] == 'admin') {
			$patients = parent::patientByAdmin('new');
		} elseif ($roleArr[0] == 'hospital' || $roleArr[0] == 'lab') {
			$hospcode = auth()->user()->hospcode;
			$patients = parent::patientByUser($hospcode, 'new');
		} else {
			return redirect()->route('logout');
		}
		return view('code.index',
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
		//
	}

/*
	public function ajaxRequestSelect(Request $request) {
		$x = $request->x;
		return response()->json(['x'=>$x]);
	}
*/
	public function ajaxRequestPost(Request $request) {
		if (empty($request->firstNameInput)) {
			return response()->json(['status'=>204, 'msg'=>'โปรดกรอกข้อมูลให้ครบทุกช่อง']);
		} else {
			$code = new Code;
			$code->hoscpde = auth()->user()->hospcode;
			$code->hn = $request->hnInput;
			$code->an = $request->anInput;

			if ($request->titleNameInput == 6 && isset($request->otherTitleNameInput)) {
				$code->title_name = $request->otherTitleNameInput;
			} else {
				$code->title_name = $this->title_name[$request->titleNameInput]->title_name;
			}

			$code->first_name = $request->firstNameInput;
			$code->last_name = $request->lastNameInput;
			$code->lab_code = parent::randPin();
			$code->user = '1';
			$saved = $code->save();
			if ($saved) {
				return response()->json(['status'=>200, 'msg'=>'บันทึกข้อมูลสำเร็จแล้ว']);
			} else {
				return response()->json(['status'=>500, 'msg'=>'Internal Server Error!']);
			}
		}
	}

	public function ajaxRequestTable() {
		$roleArr = auth()->user()->getRoleNames();
		if ($roleArr[0] == 'admin') {
			$patients = parent::patientByAdmin('new');
		} elseif ($roleArr[0] == 'hospital' || $roleArr[0] == 'lab') {
			$hospcode = auth()->user()->hospcode;
			$patients = parent::patientByUser($hospcode, 'new');
		} else {
			return redirect()->route('logout');
		}

		$htm = "
		<table class=\"display mT-2 mb-4\" id=\"code_table1\" role=\"table\">
			<thead>
				<tr>
					<th>ลำดับ</th>
					<th>ชื่อ-สกุล</th>
					<th>HN</th>
					<th>รหัส</th>
					<th>สถานะ</th>
					<th>จัดการ</th>
				</tr>
			</thead>
			<tbody";
			foreach($patients as $key=>$value) {
				$htm .= "<tr>";
					$htm .= "<td>".$value->id."</td>";
					$htm .= "<td>".$value->title_name.$value->first_name." ".$value->last_name."</td>";
					$htm .= "<td>".$value->hn."</td>";
					$htm .= "<td><strong class=\"text-danger\">".$value->lab_code."</strong></td>";
					$htm .= "<td><span class=\"badge badge-pill badge-success\">".$value->lab_status."</span></td>";
					$htm .= "<td>";
						$htm .= "<button type=\"button\" class=\"btn btn-cyan btn-sm\">Edit</button>&nbsp;";
						$htm .= "<button type=\"button\" class=\"btn btn-danger btn-sm\">Delete</button>";
					$htm .= "</td>";
				$htm .= "</tr>";
			}
			$htm .= "</tbody>";
			$htm .= "</table>";
			$htm .= "<script>
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
					});
				});
			";
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



}
