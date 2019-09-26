<?php
namespace App\Http\Controllers;

use App\Code;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Http\Controllers\Controller;
use Session;

class CodeController extends BoeFrsController
{

	public function __construct() {
		parent::__construct();
	}
	/**
	* Display a listing of the resource.
	*
	* @return \Illuminate\Http\Response
	*/

	public function index() {
		$patient = parent::getPatientByField('lab_status', 'New');
		return view(
			'code.index',
			[
				'titleName' => $this->title_name,
				'patient' => $patient
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

	public function ajaxRequestSelect(Request $request) {
		$x = $request->x;
		return response()->json(['x'=>$x]);
	}

	public function ajaxRequestPost(Request $request) {
		if (empty($request->firstNameInput)) {
			return response()->json(['status'=>204, 'msg'=>'โปรดกรอกข้อมูลให้ครบทุกช่อง']);
		} else {
			$code = new Code;
			$code->hoscpde = '1111';
			$code->hn = $request->hnInput;
			$code->an = $request->anInput;
			if ($request->titleNameInput == '6') {
				$code->title_name = $request->otherTitleNameInput;
			} else {
				$code->title_name = $this->title_name[$request->titleNameInput]->title_name;
			}
			$code->first_name = $request->firstNameInput;
			$code->last_name = $request->lastNameInput;
			$code->lab_code = parent::randPin();
			$code->lab_status = 'New';
			$code->user = auth()->user()->name;
			$code->active = '1';
			$saved = $code->save();
			if (!$saved) {
				return response()->json(['status'=>500, 'msg'=>'Internal Server Error!']);
			} else {
				return response()->json(['status'=>200, 'msg'=>'บันทึกข้อมูลสำเร็จแล้ว']);
			}
		}
	}

	public function ajaxRequestTable() {
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
		$patient = parent::getPatientByField('lab_status', 'New');
		foreach($patient as $key=>$value) {
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



}
