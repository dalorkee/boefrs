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
			$patients = Patients::whereNull('deleted_at')->get();
		} elseif ($roleArr[0] == 'hospital' || $roleArr[0] == 'lab') {
			$hospcode = auth()->user()->hospcode;
			$patients = Patients::where('ref_user_hospcode', '=', $hospcode)
				->whereNull('deleted_at')
				->get();
		} else {
			return redirect()->route('logout');
		}
		return view(
			'list-data.index',
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


	public function ajaxListData(Request $request) {
		/* get request from form */
		if ($request->pv == 0 || empty($request->pv)) {
			$pv = 0;
		} else {
			$pv = (int)$request->pv;
		}
		if ($request->hp == 0 || empty($request->hp)) {
			$hp = 0;
		} else {
			$hp = (int)$request->hp;
		}
		if ($request->st == 0 || empty($request->st)) {
			$st = array();
		} else {
			foreach ($request->st as $key => $val) {
				$st[] = $val;
			}
		}
		$cntSt = count($st);

		/* set alert message */
		$roleArr = auth()->user()->getRoleNames();
		$role = $roleArr[0];

		/* admin */
		if ($role == 'admin') {
			if ($pv == 0 && $hp == 0 && $cntSt == 0) {
				$patients = Patients::whereNull('deleted_at')->get();
				$status = 200;
				$msg = 'ค้นหาข้อมูลสำเร็จ';
			} elseif ($pv > 0 && $hp == 0 && $cntSt == 0) {
				$status = 400;
				$msg = 'โปรดเลือกโรงพยาบาล!';
			} elseif ($pv > 0 && $hp > 0 && $cntSt == 0) {
				$patients = Patients::where('ref_user_hospcode', '=', $hp)
					->whereNull('deleted_at')
					->get();
				$status = 200;
				$msg = 'ค้นหาข้อมูลสำเร็จ';
			} elseif ($pv > 0 && $hp > 0 && $cntSt > 0) {
				$patients = Patients::where('ref_user_hospcode', '=', $hp)
					->whereIn('lab_status', $st)
					->whereNull('deleted_at')
					->get();
				$status = 200;
				$msg = 'ค้นหาข้อมูลสำเร็จ'.$st[0];
			} else {
				$status = 500;
				$msg = 'การค้นหาผิดพลาด!!';
			}
			$message = collect(['status'=>$status, 'msg'=>$msg, 'title'=>'Flu Right Size']);
			/* user */
		} elseif ($role == 'hospital') {
			$hospcode = auth()->user()->hospcode;
			if ($cntSt == 0) {
				$patients = Patients::where('ref_user_hospcode', '=', $hospcode)
					->whereNull('deleted_at')
					->get();
				$status = 200;
				$msg = 'ค้นหาข้อมูลสำเร็จ';
			} elseif ($cntSt != 0) {
				$patients = Patients::where('ref_user_hospcode', '=', $hospcode)
					->whereIn('lab_status', $st)
					->whereNull('deleted_at')
					->get();
				$status = 200;
				$msg = 'ค้นหาข้อมูลสำเร็จ';
			} else {
				$status = 400;
				$msg = 'ไม่พบข้อมูล';
			}
			$message = collect(['status'=>$status, 'msg'=>$msg, 'title'=>'Flu Right Size']);
		}

		/* data list */
		$htm = "
			<table class=\"table display mb-4\" id=\"code_table1\" role=\"table\">
				<thead>
					<tr>
						<th>ลำดับ</th>
						<th>ชื่อ-สกุล</th>
						<th>HN</th>
						<th>รหัส</th>
						<th>รหัส รพ.</th>
						<th>สถานะ</th>
						<th>จัดการ</th>
					</tr>
				</thead>
				<tfoot></tfoot>
				<tbody>";
				if ($status == 200) {
					$provinces = parent::provinces();
					$titleName = $this->title_name;
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
							if ($val->title_name != 6) {
								$htm .= "<td>".$titleName[$val->title_name]->title_name.$val->first_name." ".$val->last_name."</td>";
							} else {
								$htm .= "<td>".$val->title_name_other.$val->first_name." ".$val->last_name."</td>";
							}
							$htm .= "<td>".$val->hn."</td>";
							$htm .= "<td><span class=\"text-danger\">".$val->lab_code."</span></td>";
							$htm .= "<td>".$val->ref_user_hospcode."</td>";
							$htm .= "<td><span class=\"badge badge-pill badge-".$status_class."\">".$val->lab_status."</span></td>";
							$htm .= "<td>";
							if ($val->lab_status == 'new') {
								$htm .= "<a href=\"".route('createPatient', ['id'=>$val->id])."\" class=\"btn btn-cyan btn-sm\"><i class=\"fas fa-plus-circle\"></i></a>&nbsp;";
							} else {
								$htm .= "<a href=\"".route('editPatient', ['id'=>$val->id])."\" class=\"btn btn-warning btn-sm\"><i class=\"fas fa-pencil-alt\"></i></a>&nbsp;";
							}
							$htm .= "<button type=\"button\" id=\"btn_delete_ajax".$val->id."\" class=\"btn btn-danger btn-sm\" value=\"".$val->id."\"><i class=\"fas fa-trash\"></i></button>";
							$htm .= "</td>";
						$htm .= "</tr>";
					}
				}
				$htm .= "
				</tbody>
			</table>
			<script>
				$(document).ready(function() {
					$('#code_table1').DataTable({
						'searching': false,
						'paging': true,
						'pageLength': 25,
						'lengthMenu': [[10, 25, 50, -1], [10, 25, 50, \"All\"]],
						'ordering': true,
						'info': false,
						'responsive': false,
						'columnDefs': [{
							targets: -1,
							className: 'dt-head-right dt-body-right'
						}],
						dom: 'frti\"<bottom\"Bp>',
						buttons: [
							{extend: 'copy', text: '<i class=\"far fa-copy\"></i>', titleAttr: 'Copy', className: 'btn btn-outline-danger'},
							{extend: 'csv', text: '<i class=\"far fa-file-alt\"></i>', titleAttr: 'CSV', className: 'btn btn-outline-danger'},
							{extend: 'excel', text: '<i class=\"far fa-file-excel\"></i>', titleAttr: 'Excel', className: 'btn btn-outline-danger'},
							{extend: 'pdf', text: '<i class=\"far fa-file-pdf\"></i>', titleAttr: 'PDF', className: 'btn btn-outline-danger'},
							{extend: 'print', text: '<i class=\"fas fa-print\"></i>', titleAttr: 'Print', className: 'btn btn-outline-danger'}
						]
					});";
					if ($status == 200) {
						foreach($patients as $key => $val) {
							$htm .= "
								$('#btn_delete_ajax".$val->id."').click(function(e) {
									toastr.warning(
										'Are you sure to delete? <br><br><button class=\"btn btn-cyan btc\" value=\"0\">Cancel</button> <button class=\"btn btn-danger btk\" value=\"".$val->id."\">Delete</button>',
										'Flu Right Size',
										{
											'closeButton': true,
											'positionClass': 'toast-top-center',
											'progressBar': true,
											'showDuration': '500'
										}
									);
								});
								";
							}
						}
					$m = $message->all();
					$htm .= "alertMessage('".$m['status']."', '".$m['msg']."', '".$m['title']."');
				});
			</script>";
		return $htm;
	}

	public function ajaxListDataAfterDeleted() {
		$roleArr = auth()->user()->getRoleNames();
		if ($roleArr[0] == 'admin') {
			$patients = Patients::whereNull('deleted_at')->get();
		} elseif ($roleArr[0] == 'hospital' || $roleArr[0] == 'lab') {
			$user_hospcode = auth()->user()->hospcode;
			$patients = Patients::where('ref_user_hospcode', '=', $hospcode)
				->whereNull('deleted_at')
				->get();
		} else {
			return redirect()->route('logout');
		}
		$htm = "
		<table class=\"table display mb-4\" id=\"code_table2\" role=\"table\">
			<thead>
				<tr>
					<th>ลำดับ</th>
					<th>ชื่อ-สกุล</th>
					<th>HN</th>
					<th>รหัส</th>
					<th>รหัส รพ.</th>
					<th>สถานะ</th>
					<th>จัดการ</th>
				</tr>
			</thead>
			<tfoot></tfoot>
			<tbody>";
			if ($patients) {
				foreach($patients as $key => $value) {
					switch ($value->lab_status) {
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
						$htm .= "<td>".$value->id."</td>";
						if ($value->title_name != 6) {
							$htm .= "<td>".$this->title_name[$value->title_name]->title_name.$value->first_name." ".$value->last_name."</td>";
						} else {
							$htm .= "<td>".$value->title_name_other.$value->first_name." ".$value->last_name."</td>";
						}
						$htm .= "<td>".$value->hn."</td>";
						$htm .= "<td><span class=\"text-danger\">".$value->lab_code."</span></td>";
						$htm .= "<td>".$value->ref_user_hospcode."</td>";
						$htm .= "<td><span class=\"badge badge-pill badge-".$status_class."\">".$value->lab_status."</span></td>";
						$htm .= "<td>";
							if ($value->lab_status == 'new') {
								$htm .= "<a href=\"".route('createPatient', ['id'=>$value->id])."\" class=\"btn btn-cyan btn-sm\"><i class=\"fas fa-plus-circle\"></i></a>&nbsp;";
							} else {
								$htm .= "<a href=\"".route('editPatient', ['id'=>$value->id])."\" class=\"btn btn-warning btn-sm\"><i class=\"fas fa-pencil-alt\"></i></a>&nbsp;";
							}
							$htm .= "<button type=\"button\" id=\"btn_delete_ajax".$value->id."\" class=\"btn btn-danger btn-sm\" value=\"".$value->id."\"><i class=\"fas fa-trash\"></i></button>";
						$htm .= "</td>";
					$htm .= "</tr>";
				}
			}
			$htm .= "
			</tbody>
		</table>
		<script>
			$(document).ready(function() {
				$('#code_table2').DataTable({
					'searching': false,
					'paging': true,
					'pageLength': 25,
					'lengthMenu': [[10, 25, 50, -1], [10, 25, 50, 'All']],
					'ordering': true,
					'info': false,
					'responsive': true,
					'columnDefs': [{
						targets: -1,
						className: 'dt-head-right dt-body-right'
					}],
					dom: 'frti\"<bottom\"Bp>',
					buttons: [
						{extend: 'copy', text: '<i class=\"far fa-copy\"></i>', titleAttr: 'Copy', className: 'btn btn-outline-danger'},
						{extend: 'csv', text: '<i class=\"far fa-file-alt\"></i>', titleAttr: 'CSV', className: 'btn btn-outline-danger'},
						{extend: 'excel', text: '<i class=\"far fa-file-excel\"></i>', titleAttr: 'Excel', className: 'btn btn-outline-danger'},
						{extend: 'pdf', text: '<i class=\"far fa-file-pdf\"></i>', titleAttr: 'PDF', className: 'btn btn-outline-danger'},
						{extend: 'print', text: '<i class=\"fas fa-print\"></i>', titleAttr: 'Print', className: 'btn btn-outline-danger'}
					]
				});";
				if ($patients) {
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
				}
			$htm .= "
			});
		</script>";
		return $htm;
	}
}
