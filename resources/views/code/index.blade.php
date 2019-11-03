@extends('layouts.index')
@section('custom-style')
<link rel='stylesheet' href="{{ URL::asset('public/assets/libs/datatables-1.10.18/datatables-1.10.18/css/jquery.dataTables.min.css') }}">
<link rel='stylesheet' href="{{ URL::asset('public/assets/libs/datatables-1.10.18/Responsive-2.2.2/css/responsive.bootstrap.min.css') }}">
<link rel="stylesheet" href="{{ URL::asset('public/assets/libs/bootstrap-select-1.13.9/dist/css/bootstrap-select.min.css') }}">
<link rel="stylesheet" href="{{ URL::asset('public/assets/libs/toastr/build/toastr.min.css') }}">
@endsection
@section('internal-style')
<style>
@media
	only screen
	and (max-width: 760px), (min-device-width: 768px)
	and (max-device-width: 1024px)  {
	/* Force table to not be like tables anymore */
	table, thead, tbody, th, td, tr {
		display: block !important;
	}
	/* Hide table headers (but not display: none;, for accessibility) */
	thead tr {
		position: absolute !important;
		top: -9999px !important;
		left: -9999px !important;
	}
	tr {
		margin: 0 0 1rem 0 !important;
	}
	tr:nth-child(odd) {
		background: #eee;
	}
	td {
		/* Behave like a "row" */
		/* border: none; */
		border-bottom: 1px solid #eee;
		position: relative !important;
		padding-left: 50% !important;
	}
	td:before {
		/* Now like a table header */
		position: absolute !important;
		/* Top/left values mimic padding */
		top: 0 !important;
		left: 6px !important;
		width: 45% !important;
		padding-right: 10px !important;
		white-space: nowrap !important;
	}
	/* Label the data */
	td:nth-of-type(1):before { content: "ลำดับ";margin-top:10px;font-weight:600;}
	td:nth-of-type(2):before { content: "ชื่อ-สกุล";margin-top:10px;font-weight:600;}
	td:nth-of-type(3):before { content: "HN";margin-top:10px;font-weight:600;}
	td:nth-of-type(4):before { content: "รหัส";margin-top:10px;font-weight:600;}
	td:nth-of-type(6):before { content: "สถานะ";margin-top:10px;font-weight:600;}
		td:nth-of-type(5):before { content: "วันที่";margin-top:10px;font-weight:600;}
	td:nth-of-type(7):before { content: "จัดการ";margin-top:10px;text-align:left;!important;font-weight:600;}
}

.error{
	display: none;
	margin-left: 10px;
}

.error_show{
	color: red;
	margin-left: 10px;
}
input.invalid, textarea.invalid{
	border: 2px solid red;
}

input.valid, textarea.valid{
	border: 2px solid green;
}
</style>
@endsection
@section('meta-token')
<meta name="csrf-token" content="{{ csrf_token() }}">
@endsection
@section('contents')
@php
/*
	$response = Session::get('response');
	if (isset($response)) {
		dd($response);
	}
*/
@endphp
<div class="page-breadcrumb bg-light">
	<div class="row">
		<div class="col-12 d-flex no-block align-items-center">
			<h4 class="page-title"><span style="display:none;">Print</span></h4>
			<div class="ml-auto text-right">
				<nav aria-label="breadcrumb">
					<ol class="breadcrumb">
						<li class="breadcrumb-item"><a href="#">Laboratory</a></li>
						<li class="breadcrumb-item active" aria-current="page">Create</li>
					</ol>
				</nav>
			</div>
		</div>
	</div>
</div>
<div class="container-fluid">
	<div class="row">
		<div class="col-md-12">
			<div class="card">
				<div class="card-body">
					<div class="d-md-flex align-items-center">
						<div>
							<h4 class="card-title">สร้างรหัสแบบฟอร์มเก็บข้อมูล</h4>
							<h5 class="card-subtitle">ID Flu-BOE</h5>
						</div>
					</div>
					<div class="alert" role="alert" style="border:1px solid #ccc;">
						<form id="patient_form" class="mt-4 mb-3">
							@role('admin')
							<div class="form-row">
								<div class="col-xs-12 col-sm-12 col-md-4 col-lg-2 col-xl-2 mb-3">
									<div class="form-group">
										<label for="province">จังหวัด</label>
										<select name="province" class="form-control selectpicker show-tick" id="select_province" data-style="btn-danger" >
											<option value="0">-- เลือกจังหวัด --</option>
											@php
												$provinces = Session::get('provinces');
												$provinces->each(function ($item, $key) {
													echo "<option value=\"".$item->province_id."\">".$item->province_name."</option>\n";
												});
											@endphp
										</select>
									</div>
								</div>
								<div class="col-xs-12 col-sm-12 col-md-4 col-lg-2 col-xl-2 mb-3">
									<div class="form-group">
										<label for="hospital">โรงพยาบาล</label>
										<select name="hospital" class="form-control selectpicker show-tick" id="select_hospital" data-style="btn-danger">
											<option value="0">-- เลือกโรงพยาบาล --</option>
										</select>
									</div>
								</div>
							</div>
							@endrole
							<div class="form-row">
								<div class="col-xs-12 col-sm-12 col-md-4 col-lg-2 col-xl-2 mb-3">
									<div class="form-group">
										<label for="titleName">คำนำหน้าชื่อ</label>
										<select name="titleNameInput" class="form-control selectpicker show-tick select-title-name" id="title_name_input">
											<option value="0">-- โปรดเลือก --</option>
											@php
												$titleName->each(function ($item, $key) {
													echo "<option value=\"".$item->id."\">".$item->title_name."</option>";
												});
											@endphp
										</select>
									</div>
								</div>
								<div class="col-xs-12 col-sm-12 col-md-4 col-lg-2 col-xl-2 mb-3">
									<label for="otherTitleNameInput">อื่นๆ ระบุ</label>
									<input type="text" name="otherTitleNameInput" class="form-control" id="other_title_name_input" placeholder="คำนำหน้าชื่ออื่นๆ" disabled>
								</div>
							</div>
							<div class="form-row">
								<div class="col-xs-12 col-sm-12 col-md-4 col-lg-2 col-xl-2 mb-3">
									<label for="firstNameInput">ชื่อจริง</label>
									<input type="text" name="firstNameInput" class="form-control" id="first_name_input" placeholder="ชื่อ">
								</div>
								<div class="col-xs-12 col-sm-12 col-md-4 col-lg-4 col-xl-3 mb-3">
									<label for="lastNameInput">นามสกุล</label>
									<input type="text" name="lastNameInput" class="form-control" id="last_name_input" placeholder="นามสกุล">
								</div>
							</div>
							<div class="form-row">
								<div class="col-xs-12 col-sm-12 col-md-3 col-lg-2 col-xl-2 mb-3">
									<label for="hnInput">HN</label>
									<input type="text" name="hnInput" class="form-control" id="hn_input" placeholder="HN">
								</div>
								<div class="col-xs-12 col-sm-12 col-md-3 col-lg-2 col-xl-2 mb-3">
									<label for="anInput">AN</label>
									<input type="text" name="anInput" class="form-control" id="an_input" placeholder="AN">
								</div>
							</div>
							<button type="button" class="btn btn-primary" id="btn_submit">สร้างรหัส</button>
						</form>
					</div>
					<div>
					@if(count($errors) > 0)
						<div class="alert alert-danger">
							<ul>
							@foreach ($errors->all as $error)
								<li>{{ $error }}</li>
							@endforeach
							</ul>
						</div>
					@endif
					</div>
					<div id="patient_data">
						<table class="display mT-2 mb-4" id="code_table" role="table">
							<thead>
								<tr>
									<th>ลำดับ</th>
									<th>รหัส</th>
									<th>ชื่อ-สกุล</th>
									<th>HN</th>
									<th>สถานะ</th>
									<th>วัน/เวลา</th>
									<th>จัดการ</th>
								</tr>
							</thead>
							<tbody>
							@foreach ($patients as $key => $value)
								<tr>
									<td>{{ $value->id }}</td>
									<td><span class="text-danger">{{ $value->lab_code }}</span></td>
									@if ($value->title_name != 6)
										<td>{{ $titleName[$value->title_name]->title_name.$value->first_name." ".$value->last_name }}</td>
									@else
										<td>{{ $value->title_name_other.$value->first_name." ".$value->last_name }}</td>
									@endif
									<td>{{ $value->hn }}</td>
									<td><span class="badge badge-pill badge-success">{{ $value->lab_status }}</span></td>
									<td>{{ $value->created_at }}</td>
									<td>
										<a href="{{ route('createPatient', ['id'=>$value->id]) }}" class="btn btn-outline-primary btn-sm">Edit</a>&nbsp;
										<a href="{{ route('codeSoftDelete', ['id'=>$value->id]) }}" id="delete" class="btn btn-outline-danger btn-sm">Delete</a>
										<!--<button name="delete" type="submit" id="delete" class="btn btn-outline-danger btn-sm" value="{ $value->id }">Delete</button> -->
									</td>
								</tr>
							@endforeach
							</tbody>
						</table>
					</div>
				</div><!-- card body -->
			</div><!-- card -->
		</div><!-- column -->
	</div><!-- row -->
</div>
@endsection
@section('bottom-script')
<script src="{{ URL::asset('public/assets/libs/datatables-1.10.18/datatables-1.10.18/js/jquery.dataTables.min.js') }}"></script>
<script src="{{ URL::asset('public/assets/libs/datatables-1.10.18/Responsive-2.2.2/js/responsive.bootstrap.min.js') }}"></script>
<script src="{{ URL::asset('public/assets/libs/bootstrap-select-1.13.9/dist/js/bootstrap-select.min.js') }}"></script>
<script src="{{ URL::asset('public/assets/libs/bootstrap-validate-2.2.0/dist/bootstrap-validate.js') }}"></script>
@php
	if (Session::has('message')) {
		$msg = Session::get('message');
		$msg->all();
		echo "<script>";
			echo "
				$(document).ready(function() {
					var msg = ".$msg['status'].";
					if (msg == 200) {
						toastr.success('".$msg['msg']."', 'Flu Right Size',
							{
								'closeButton': true,
								'positionClass': 'toast-top-center',
								'progressBar': true,
								'showDuration': '600'
							}
						);
					} else {
						toastr.error('".$msg['msg']."', 'Flu Right Size',
							{
								'closeButton': true,
								'positionClass': 'toast-top-center',
								'progressBar': true,
								'showDuration': '800'
							}
						);
					}
				});";
		echo "</script>";
	}
@endphp
<script>
$(document).ready(function() {
	/* ajax request */
	$.ajaxSetup({
		headers: {
			'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
		}
	});

	/* data table */
	$('#code_table').DataTable({
		"searching": false,
		"paging": false,
		"ordering": true,
		"info": false,
		responsive: true,
		columnDefs: [{
			targets: -1,
			className: 'dt-head-right dt-body-right'
		}]
	});

	/* select province */
	$('#select_province').change(function() {
		var prov_id = $('#select_province').val();
		if (prov_id > 0) {
			$('#select_hospital').prop('disabled', false);
			$.ajax({
				type: "GET",
				url: "{{ route('ajaxGetHospByProv') }}",
				dataType: 'HTML',
				data: {prov_id: prov_id},
				success: function(response) {
					$('#select_hospital').empty();
					$('#select_hospital').html(response);
					$('#select_hospital').selectpicker("refresh");
				},
				error: function(response) {
					alert(data.status);
				}
			});
		} else {
			$('#select_hospital').empty();
			$('#select_hospital').selectpicker("refresh");
			$('#select_hospital').prop('disabled', true);
		}
	});

	/* title name */
	$('#title_name_input').change(function() {
		if ($('select#title_name_input').val() === '6') {
			$('#other_title_name_input').prop('disabled', false);
		} else {
			$('#other_title_name_input').val('');
			$('#other_title_name_input').prop('disabled', true);
		}
	});

	/* submit ajax */
	$("#btn_submit").click(function(e){
		var input = ConvertFormToJSON("#patient_form");
		$.ajax({
			type: 'POST',
			url: "{{ route('ajaxRequest') }}",
			data: input,
			success: function(data){
				if (data.status == 204) {
					toastr.warning(data.msg, "Flu Right Size",
						{
							"closeButton": true,
							"positionClass": "toast-top-center",
							"progressBar": true,
							"showDuration": "500"
						}
					);
				} else if (data.status == 200) {
					$.ajax({
						type: 'GET',
						url: "{{ route('ajaxRequestTable') }}",
						dataType: "HTML",
						success: function(res){
							$('#patient_data').html(res);
							$("#select_province").val('0').selectpicker("refresh");
							$("#select_hospital").val('0').selectpicker("refresh");
							$("#title_name_input").val('0').selectpicker("refresh");
							$('#patient_form').find('input:text').val('');
							toastr.success(data.msg, "Flu Right Size",
								{
									"closeButton": true,
									"positionClass": "toast-top-center",
									"progressBar": true,
									"showDuration": "500"
								}
							);
						},
						error: function(jqXhr, textStatus, errorMessage){
							$("#select_province").val('0').selectpicker("refresh");
							$("#select_hospital").val('0').selectpicker("refresh");
							$("#title_name_input").val('0').selectpicker("refresh");
							$('#patient_form').find('input:text').val('');
							toastr.error(jqXhr.status + " " + textStatus + " " + errorMessage, " Flu Right Size",
								{
									"closeButton": true,
									"positionClass": "toast-top-center",
									"progressBar": true,
									"timeOut": 0,
									"extendedTimeOut": 0
								}
							);
						}
					});
				} else {
					alert('Error!');
				}
			},
			error: function(data, status, error){
				$("#select_province").val('0').selectpicker("refresh");
				$("#select_hospital").val('0').selectpicker("refresh");
				$("#title_name_input").val('0').selectpicker("refresh");
				$('#patient_form').find('input:text').val('');
				toastr.error(data.status + " " + status + " " + error, " Flu Right Size",
					{
						"closeButton": true,
						"positionClass": "toast-top-center",
						"progressBar": true,
						"timeOut": 0,
						"extendedTimeOut": 0
					}
				);
			}
		});
	});


});
</script>
<script>
function resetForm($form) {
	$form.find('input:text, input:password, input:file, select, textarea').val('');
	$form.find('input:radio, input:checkbox')
	.removeAttr('checked').removeAttr('selected');
}
function ConvertFormToJSON(form){
	var array = jQuery(form).serializeArray();
	var json = {};
	jQuery.each(array, function() {
		json[this.name] = this.value || '';
	});
	return json;
}
</script>
@endsection
