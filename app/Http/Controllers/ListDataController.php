<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Patients;
use Session;

class ListDataController extends BoeFrsController
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
			$patients = parent::patientByAdmin('new');
		} elseif ($roleArr[0] == 'hospital' || $roleArr[0] == 'lab') {
			$hospital = auth()->user()->hospcode;
			$patients = parent::patientByUserHospcode($hospital, 'new');
		} else {
			return redirect()->route('logout');
		}
		$provinces = parent::provinces();
		$provinces = $provinces->keyBy('province_id');
		return view(
			'list-data.index',
			[
				'provinces' => $provinces,
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
	public function show($id) {
		return '<p>ok ja</p>';
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

	public function listData(Request $request) {

	}

	public function ajaxListData(Request $request) {
		/* get request from form */
		if (isset($request->pv) || $request->pv != '0' || $request->pv != null) {
			$pv = $request->pv;
		} else {
			$pv = '0';
		}
		if (isset($request->hp) || $request->hp != '0' || $request->hp != null) {
			$hp = $request->hp;
		} else {
			$hp = '0';
		}
		if (!isset($request->st)) {
			$st[] = '0';
		} else {
			foreach ($request->st as $key => $val) {
				$st[] = $val;
			}
		}

		$roleArr = auth()->user()->getRoleNames();
		if ($roleArr[0] == 'admin') {
			if ($pv == '0' && $hp == '0' && $st[0] == '0') {
				$patients = Patients::all();
				$status = 200;
				$msg = '1ค้นหาข้อมูลสำเร็จ';
				//$message = collect(['status'=>$status, 'msgx'=>'1ค้นหาข้อมูลสำเร็จ', 'title'=>'Flu Right Size']);
			} elseif ($pv != '0' && $hp == '0' && $st[0] == '0') {
				$status = 406;
				$msg = '2Info! โปรดกรอกข้อมูลให้ครบเงื่อนไข';
				//$message = collect(['status'=>$status, 'msgx'=>'2Info! โปรดกรอกข้อมูลให้ครบเงื่อนไข', 'title'=>'Flu Right Size']);
			} elseif ($pv != '0' && $hp != '0' && $st[0] == '0') {
				$patients = Patients::where('ref_user_hospcode', '=', $hp)->get();
				$status = 200;
				$msg = '3ค้นหาข้อมูลสำเร็จ';
				//$message = collect(['status'=>$status, 'msgx'=>'3ค้นหาข้อมูลสำเร็จ', 'title'=>'Flu Right Size']);
			} elseif ($pv != '0' && $hp != '0' && $st[0] != '0') {
				$patients = Patients::where('ref_user_hospcode', '=', $hp)->whereIn('lab_status', $st)->get();
				$status = 200;
				$msg = '4ค้นหาข้อมูลสำเร็จ';
				//$message = collect(['status'=>$status, 'msgx'=>'4ค้นหาข้อมูลสำเร็จ', 'title'=>'Flu Right Size']);
			} else {
				$status = 404;
				$msg = '5ไม่พบข้อมูล';
				//$message = collect(['status'=>$status, 'msgx'=>'5ไม่พบข้อมูล', 'title'=>'Flu Right Size']);
			}
			$message = collect(['status'=>$status, 'msg'=>$msg, 'title'=>'Flu Right Size']);
		}


		$htm = "
			<table class=\"display mb-4\" id=\"code_table1\" role=\"table\">
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
			<tfoot></tfoot>
		";

		if ($status == 200) {
			$provinces = parent::provinces();
			$titleName = $this->title_name;
			$htm .= "<tbody>";
			foreach($patients as $key => $val) {
				switch ($val->lab_status) {
					case 'new':
						$status_class = 'success';
						break;
					case 'hospital':
						$status_class = 'warning';
						break;
					case 'lab':
						$status_class = 'danger';
						break;
					case 'completed':
						$status_class = 'primary';
						break;
					default :
						$status_class = 'primary';
						break;
				}
				$htm .= "<tr>";
				$htm .= "<td>".$val->id."</td>";
				if ($val->id != 6) {
					$htm .= "<td>".$titleName[$val->id]->title_name.$val->first_name." ".$val->last_name."</td>";
				} else {
					$htm .= "<td>".$val->title_name_other.$val->first_name." ".$val->last_name."</td>";
				}
				$htm .= "<td>".$val->hn."</td>";
				$htm .= "<td><span class=\"text-danger\">".$val->lab_code."</span></td>";
				$htm .= "<td><span class=\"badge badge-pill badge-".$status_class."\">".$val->lab_status."</span></td>";
				$htm .= "<td>";
				$htm .= "<a href=\"".route('createPatient', ['id'=>$val->id])."\" class=\"btn btn-success\">เพิ่มข้อมูล</a>&nbsp;";
				$htm .= "<a href=\"".route('codeSoftDelete', ['id'=>$val->id])."\" class=\"btn btn-danger\">ลบ</button>";
				$htm .= "</td>";
				$htm .= "</tr>";
			}
			$htm .= "</tbody>
			";
		} else {
			$htm .= '<tbody></tbody>';
		}
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
					$m = $message->all();
					$htm .= "alertMessage('".$m['status']."', '".$m['msg']."', '".$m['title']."');
				});
			</script>

		";
		return $htm;
	}
}
