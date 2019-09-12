<?php
namespace App\Http\Controllers;

use App\CodeGen;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Http\Controllers\Controller;
use Session;

class CodeGenController extends BoeFrsController
{
	/**
	* Display a listing of the resource.
	*
	* @return \Illuminate\Http\Response
	*/
	public function index()
	{
		$titleName = parent::getTitleName();
		 $patient = parent::getPatient();
		return view(
			'admin.codeGen.index',
			[
				'titleName' => $titleName,
				'patient' => $patient,
				'ajaxRequest' => true
			]
		);
	}

	/**
	* Show the form for creating a new resource.
	*
	* @return \Illuminate\Http\Response
	*/
	public function create()
	{
		//
	}

	/**
	* Store a newly created resource in storage.
	*
	* @param  \Illuminate\Http\Request  $request
	* @return \Illuminate\Http\Response
	*/
	public function store(Request $request)
	{
		$this->validate($request, [
			'titleNameInput' => 'required|min:1'
		]);

		/*
		$code = new CodeGen;
		$code->hoscpde = '1111';
		$code->title_name = $request->titleNameInput;
		$code->first_name = $request->firstNameInput;
		$code->last_name = $request->lastNameInput;
		$code->hn = $request->hnInput;
		$code->lab_status = 'New';
		$code->user = 'user';
		$code->active = '1';
		$saved = $code->save();
		if (!$saved) {
			App::abort(500, 'Internal Server Error.');
		} else {
			return redirect('code');
		}
		*/
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

/*
	public function ajaxRequest()
	{
		$titleName = parent::getTitleName();
		$patient = parent::getPatient();
		return view(
			'admin.codeGen.index',
			[
				'titleName'=>$titleName,
				'patient'=>$patient
			]
		);
	}
*/

	public function ajaxRequestPost(Request $request)
	{
		if (empty($request->firstNameInput)) {
			return response()->json(['status'=>204, 'msg'=>'โปรดกรอกข้อมูลให้ครบทุกช่อง']);
		} else {
			$code = new CodeGen;
			$code->hoscpde = '1111';
			$code->hn = $request->hnInput;
			$code->title_name = $request->titleNameInput;
			$code->first_name = $request->firstNameInput;
			$code->last_name = $request->lastNameInput;
			$code->lab_code = parent::ranPin('L', '-');
			$code->lab_status = 'New';
			$code->user = 'user';
			$code->active = '1';
			$saved = $code->save();
			if (!$saved) {
				return response()->json(['status'=>500, 'msg'=>'Internal Server Error!']);
			} else {
				return response()->json(['status'=>200, 'msg'=>'บันทึกข้อมูลสำเร็จแล้ว']);
			}
		}
	}

	public function ajaxRequestTable()
	{
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
		$patient = parent::getPatient();
		foreach($patient as $key=>$value) {
			$htm .= "<tr>";
				$htm .= "<td>".$value->id."</td>";
				$htm .= "<td>".$value->title_name.$value->first_name." ".$value->last_name."</td>";
				$htm .= "<td>".$value->hn."</td>";
				$htm .= "<td span class=\"text-danger\">".$value->lab_code."</td>";
				$htm .= "<td>".$value->lab_status."</td>";
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
