@extends('layouts.index')
@section('custom-style')
	<link rel='stylesheet' href="{{ URL::asset('assets/libs/datatables-1.10.18/DataTables-1.10.18/css/jquery.dataTables.min.css') }}">
	<link rel='stylesheet' href="{{ URL::asset('assets/libs/datatables-1.10.18/Responsive-2.2.2/css/responsive.bootstrap.min.css') }}">
	<link rel="stylesheet" href="{{ URL::asset('assets/libs/select2/dist/css/select2.min.css') }}">
	<link rel='stylesheet' href="{{ URL::asset('assets/libs/bootstrap-select-1.13.9/dist/css/bootstrap-select.min.css') }}">
	<link rel="stylesheet" href="{{ URL::asset('assets/libs/toastr/build/toastr.min.css') }}">
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
	td:nth-of-type(5):before { content: "สถานะ";margin-top:10px;font-weight:600;}
	td:nth-of-type(6):before { content: "จัดการ";margin-top:10px;text-align:left;!important;font-weight:600;}
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
/*
// select 2 dropdown icon
.select2-container--default .select2-selection--multiple:before {
    content: ' ';
    display: block;
    position: absolute;
    border-color: #888 transparent transparent transparent;
    border-style: solid;
    border-width: 5px 4px 0 4px;
    height: 0;
    right: 6px;
    margin-left: -4px;
    margin-top: -2px;top: 50%;
    width: 0;cursor: pointer
}

.select2-container--open .select2-selection--multiple:before {
    content: ' ';
    display: block;
    position: absolute;
    border-color: transparent transparent #888 transparent;
    border-width: 0 4px 5px 4px;
    height: 0;
    right: 6px;
    margin-left: -4px;
    margin-top: -2px;top: 50%;
    width: 0;cursor: pointer
}
// end select 2 dropdown icon
*/
/* select 2 dropdown checkbox */
/*
.select2-results__option {
	padding-right: 20px;
	vertical-align: middle;
}
.select2-results__option:before {
	content: "";
	display: inline-block;
	position: relative;
	height: 20px;
	width: 20px;
	border: 2px solid #27A9E3;
	border-radius: 4px;
	background-color: #fff;
	margin-right: 20px;
	vertical-align: middle;
}
.select2-results__option[aria-selected=true]:before {
	font-family: 'themify';
	content: "\e64c";
	color: #fff;
	background-color: #f77750;
	border: 0;
	display: inline-block;
	padding-left: 3px;
}
.select2-container--default .select2-results__option[aria-selected=true] {
	background-color: #fff;
}
.select2-container--default .select2-results__option--highlighted[aria-selected] {
	background-color: #eaeaeb;
	color: #272727;
}
.select2-container--default .select2-selection--multiple {
	margin-bottom: 5px;
}
.select2-container--default.select2-container--open.select2-container--below .select2-selection--multiple {
	border-radius: 4px;
}
.select2-container--default.select2-container--focus .select2-selection--multiple {
	border-color: #f77750;
	border-width: 2px;
}
.select2-container--default .select2-selection--multiple {
	border-width: 2px;
}
.select2-container--open .select2-dropdown--below {
	border-radius: 10px;
	box-shadow: 0 0 10px rgba(0,0,0,0.5);

}
.select2-selection .select2-selection--multiple:after {
	content: 'hhghgh';
}
*/
/* select with icons badges single*/
/*
.select-icon .select2-selection__placeholder .badge {
	display: none;
}
.select-icon .placeholder {
	display: none;
}
.select-icon .select2-results__option:before,
.select-icon .select2-results__option[aria-selected=true]:before {
	display: none !important; */
	/* content: "" !important; */
	/*
}
.select-icon  .select2-search--dropdown {
	display: none;
}*/
/* end select 2 dropdown checkbox */
</style>
@endsection
@section('meta-token')
<meta name="csrf-token" content="{{ csrf_token() }}">
@endsection
@section('contents')
<div class="page-breadcrumb bg-light">
	<div class="row">
		<div class="col-12 d-flex no-block align-items-center">
			<h4 class="page-title"><span style="display:none;">Print</span></h4>
			<div class="ml-auto text-right">
				<nav aria-label="breadcrumb">
					<ol class="breadcrumb">
						<li class="breadcrumb-item"><a href="#">Form</a></li>
						<li class="breadcrumb-item active" aria-current="page">All</li>
					</ol>
				</nav>
			</div>
		</div>
	</div>
</div>
<div class="container-fluid">
	<div class="card">
		<div class="card-body">
			<div class="d-md-flex align-items-center" style="border-bottom:1px solid #EAEAEA">
				<div>
					<h4 class="card-title">รายการข้อมูล โครงการเฝ้าระวังเชื้อไวรัสก่อโรคระบบทางเดินหายใจ</h4>
					<h5 class="card-subtitle">Flu-BOE</h5>
				</div>
			</div>
			<form name="search_frm" class="mx-4" id="search_frm">
				@php
					$user_hospital_name = Session::get('user_hospital_name');
					$provinces = Session::get('provinces');
				@endphp
				<div class="form-group row pt-4">
					<div class="col-sm-12 col-md-2 col-lg-2 col-xl-2 my-1">
					@role('admin')
						<select name="province" class="form-control selectpicker show-tick" id="select_province">
							<option value="0">-- จังหวัด --</option>
							@php
								$provinces->each(function ($item, $key) {
									echo "<option value=\"".$item->province_id."\">".$item->province_name."</option>";
								});
							@endphp
						</select>
					@endrole
					@role('hospital|lab')
						<select name="province" class="form-control selectpicker show-tick" id="select_province" readonly>
							<option value="{{ auth()->user()->province }}">{{ $provinces[auth()->user()->province]->province_name }}</option>
						</select>
					@endrole
					</div>
					<div class="col-sm-12 col-md-3 col-lg-3 col-xl-3 my-1">
					@role('admin')
						<select name="hospcode" class="form-control selectpicker show-tick" id="select_hospital" disabled>
							<option value="0">-- โรงพยาบาล --</option>
						</select>
					@endrole
					@role('hospital|lab')
						<select name="hospcode" class="form-control selectpicker" id="select_hospital" disabled>
							<option value="{{ auth()->user()->hospcode }}">{{ $user_hospital_name }}</option>
						</select>
					@endrole
					</div>
					<div class="col-sm-12 col-md-2 col-lg-2 col-xl-2 my-1">
						@role('admin')
						<select name="lab_status" class="form-control my-1 select-status" id="select_status" multiple="multiple" disabled style="width:100%;">
						@endrole
						@role('hospital|lab')
						<select name="lab_status" class="form-control my-1 select-status" id="select_status" multiple="multiple" style="width:100%;">
						@endrole
							<option value="new">New</option>
							<option value="hospital">Hospital</option>
							<option value="lab">Lab</option>
							<option value="completed">Completed</option>
						</select>
					</div>
					<div class="col-sm-12 col-md-1 col-lg-1 col-xl-1 mt-1">
						<!-- <button type="submit" class="btn btn-primary"><i class="fas fa-search"></i> ค้นหา</button> -->
						<a href="#" class="btn btn-primary" id="btn_search" style="height:38px;"><i class="fas fa-search"></i> ค้นหา</a>
					</div>
				</div>
			</form>
			<div class="row">
				<div class="col-md-12">
					<div class="card">
						<div class="card-body">
							<div id="patient_data">
								<table class="display mb-4" id="code_table" role="table">
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
									<tbody>
									@php
										$patients->each(function ($item, $key) use ($titleName) {
											switch ($item->lab_status) {
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
											echo "<tr>";
												echo "<td>".$item->id."</td>";
												if ($item->id != 6) {
													echo "<td>".$titleName[$item->id]->title_name.$item->first_name." ".$item->last_name."</td>";
												} else {
													echo "<td>".$item->title_name_other.$item->first_name." ".$item->last_name."</td>";
												}
												echo "<td>".$item->hn."</td>";
												echo "<td><span class=\"text-danger\">".$item->lab_code."</span></td>";
												echo "<td><span class=\"badge badge-pill badge-".$status_class."\">".$item->lab_status."</span></td>";
												echo "<td>";
													if ($item->lab_status == 'new') {
														echo "<a href=\"".route('createPatient', ['id'=>$item->id])."\" class=\"btn btn-cyan btn-sm\"><i class=\"fas fa-plus-circle\"></i></a>&nbsp;";
													} else {
														echo "<a href=\"".route('editPatient', ['id'=>$item->id])."\" class=\"btn btn-warning btn-sm\"><i class=\"fas fa-pencil-alt\"></i></a>&nbsp;";
													}
													echo "<button name=\"delete\" type=\"button\" id=\"btn_delete".$item->id."\" class=\"btn btn-danger btn-sm\" value=\"".$item->id."\"><i class=\"fas fa-trash\"></i></button>";
												echo "</td>";
											echo "</tr>";
										});
									@endphp
									</tbody>
								</table>
							</div>
						</div><!-- card body -->
					</div><!-- card -->
				</div><!-- column -->
			</div><!-- row -->
		</div><!-- card body -->
	</div><!-- card -->
</div><!-- contrainer -->
@endsection
@section('bottom-script')
<script src="{{ URL::asset('assets/libs/datatables-1.10.18/DataTables-1.10.18/js/jquery.dataTables.min.js') }}"></script>
<script src="{{ URL::asset('assets/libs/datatables-1.10.18/Responsive-2.2.2/js/responsive.bootstrap.min.js') }}"></script>
<script src="{{ URL::asset('assets/libs/select2/dist/js/select2.full.min.js') }}"></script>
<script src="{{ URL::asset('assets/libs/select2/dist/js/select2.min.js') }}"></script>
<script src="{{ URL::asset('assets/libs/bootstrap-select-1.13.9/dist/js/bootstrap-select.min.js') }}"></script>
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

	@php
	$htm = "";
		foreach ($patients as $key => $value) {
			$htm .= "
			$('#btn_delete".$value->id."').click(function(e) {
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
	echo $htm;
	@endphp

	/* select2 setting */
	//$(".select-province").select2();
	/*$(".select-hospital").select2({
		closeOnSelect : true
	});
	*/

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
				success: function(data) {
					$('#select_hospital').empty();
					$('#select_hospital').html(data);
					$('#select_hospital').selectpicker("refresh");
				},
				error: function(xhr, status, error) {
					alertMessage(xhr.status, error, 'Flu Right Size');
				}
			});
		} else {
			$('#select_hospital').empty();
			$('#select_hospital').append('<option value="0">-- เลือกโรงพยาบาล --</option>');
			$('#select_hospital').prop('disabled', true);
			$('#select_hospital').selectpicker("refresh");
			$('#select_status').val(null).trigger('change');
			$('#select_status').prop('disabled', true);
		}
	});

	$('#select_hospital').change(function() {
		var hosp_id = $('#select_hospital').val();
		if (hosp_id != 0) {
			$('#select_status').prop('disabled', false);
		} else {
			$('#select_status').val(null).trigger('change');
			$('#select_status').prop('disabled', true);
		}
	});


	/*
	$(".select-province").on("select2:select select2:unselect", function(e) {
		var prov_id = parseInt($(e.currentTarget).val());
		if (prov_id > 0) {
			$('#select_hospital').prop('disabled', false);
			$.ajax({
				type: "GET",
				url: "{ route('ajaxGetHospByProv') }",
				dataType: 'HTML',
				data: {prov_id: prov_id},
				success: function(data) {
					$('#select_hospital').empty();
					$('#select_hospital').html(data);
				},
				error: function(xhr, status, error) {
					alertMessage(xhr.status, error, 'Flu Right Size');
				}
			});
		} else {
			$('#select_hospital').empty();
			$('#select_hospital').append($('<option>', {
				value: '0',
				text: '-- โรงพยาบาล --'
			}));
			$('#select_hospital').prop('disabled', true);
			$('#select_status').val(null).trigger('change');
			$('#select_status').prop('disabled', true);
		}
	});
	*/

	/* select hospital */
	/*
	$(".select-hospital").on("select2:select select2:unselect", function(e) {
		var hid = parseInt($(e.currentTarget).val());
		if (hid != 0) {
			$('#select_status').prop('disabled', false);
		} else {
			$('#select_status').val(null).trigger('change');
			$('#select_status').prop('disabled', true);
		}
	});
	*/

	$(".select-status").select2({
		closeOnSelect : false,
		placeholder : "-- สถานะ --",
		allowHtml: true,
		allowClear: true,
		tags: true,
		closeOnSelect : true
	});

	/* search ajax */
	$("#btn_search").click(function(e) {
		var pv = $('#select_province').val();
		var hp = $('#select_hospital').val();
		var st = $('#select_status').val();
		if (pv == "") {
			pv = 0;
		}
		if (hp == "") {
			hp = 0;
		}
		if (st == "") {
			st = 0;
		}
		$.ajax({
			method: 'POST',
			url: '{{ route('ajax-list-data') }}',
			data: {pv:pv, hp:hp, st:st},
			dataType: 'HTML',
			success: function(data) {
				$('#patient_data').html(data);
			},
			error: function(xhr, status, error){
				alertMessage(xhr.status, error, 'Flu Right Sizex');
			}
		});
	});

	/* alert message */
	@php
		if (Session::has('message')) {
			$message = Session::get('message');
			$message = $message->all();
			Session::forget('message');
			echo "alertMessage('".$message['status']."', '".$message['msg']."', '".$message['title']."')";
		}
	@endphp
});
</script>
<script>
	$('body').on('click', '.btc', function (toast) {
		toastr.clear();
	});
	$('body').on('click', '.btk', function (toast) {
		var val = toast.target.value;
		$.ajax({
			method: 'POST',
			url: '{{ route('codeSoftConfirmDelete') }}',
			data: {val:val},
			dataType: 'JSON',
			success: function(data) {
				if (data.status === '200') {
					$.ajax({
						method: 'GET',
						url: '{{ route('ajaxRequestTable') }}',
						data: {pj:data.status},
						dataType: 'HTML',
						success: function(data) {
							$('#patient_data').html(data);
						},
						error: function(data, status, error) {
							alertMessage(500, error, 'Flu Right Size');
						}
					});
				}
			},
			error: function(data, status, error) {
				alertMessage(500, error, 'Flu Right Size');
			}
		});
	});
</script>
<script>
function alertMessage(status, message, title) {
	if (status == 200) {
		toastr.success(message, title,
			{
				'closeButton': true,
				'positionClass': 'toast-top-center',
				'progressBar': true,
				'showDuration': '600',
			}
		);
	} else if (status == 400) {
		toastr.warning(message, title,
			{
				'closeButton': true,
				'positionClass': 'toast-top-center',
				'progressBar': true,
				'showDuration': '600',
			}
		);
	} else {
		toastr.error(message, title,
			{
				'closeButton': true,
				'positionClass': 'toast-top-center',
				'progressBar': true,
				'showDuration': '600',
			}
		);
	}
}
</script>
@endsection
