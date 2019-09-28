@extends('layouts.index')
@section('custom-style')
	<link rel='stylesheet' href='public/assets/libs/datatables-1.10.18/datatables-1.10.18/css/jquery.dataTables.min.css'>
	<link rel='stylesheet' href='public/assets/libs/datatables-1.10.18/Responsive-2.2.2/css/responsive.bootstrap.min.css'>
	<link rel='stylesheet' href='public/assets/libs/bootstrap-select-1.13.9/dist/css/bootstrap-select.min.css'>
	<link rel="stylesheet" type="text/css" href="public/assets/libs/select2/dist/css/select2.min.css">
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
/* select with icons badges single*/
.select-icon .select2-selection__placeholder .badge {
	display: none;
}
.select-icon .placeholder {
	display: none;
}
.select-icon .select2-results__option:before,
.select-icon .select2-results__option[aria-selected=true]:before {
	display: none !important;
	/* content: "" !important; */
}
.select-icon  .select2-search--dropdown {
	display: none;
}
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
						<li class="breadcrumb-item"><a href="#">หน้าหลัก</a></li>
						<li class="breadcrumb-item active" aria-current="page">รายการข้อมูล</li>
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
			<form class="mx-4">
				<div class="form-group row pt-4">
					<div class="col-sm-12 col-md-3 col-lg-3 col-xl-3 my-1">
						<select class="form-control my-1 select-province" style="width:100%;">
							<option value="0">-- เลือกจังหวัด --</option>
							@php
								$provinces->keyBy('province_id');
								$provinces->each(function ($item, $key) {
									echo "<option value=\"".$item->province_id."\">".$item->province_name."</option>";
								});
							@endphp

						</select>
					</div>
					<div class="col-sm-12 col-md-3 col-lg-3 col-xl-3 my-1">
						<select class="form-control my-1 select-hospital" style="width:100%;">
							<option value="0">-- เลือกโรงพยาบาล --</option>

							@foreach ($hospitals as $hospital)
								<option value="{{ $hospital->hospcode }}">{{ $hospital->hosp_name }}</option>
							@endforeach
						</select>
					</div>
					<div class="col-sm-12 col-md-3 col-lg-3 col-xl-3 my-1">
						<select class="form-control my-1 select-status" multiple="multiple" style="width:100%;">
							<option value="new">New</option>
							<option value="process">Processing</option>
							<option value="complete">Complete</option>
						</select>
					</div>
					<div class="col-sm-12 col-md-1 col-lg-1 col-xl-1 mt-1">
						<button type="button" class="btn btn-primary" style="height:40px;"><i class="fas fa-search"></i> ค้นหา</button>
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
								$patients->each(function ($item, $key) {
									switch ($item->lab_status) {
										case 'New':
											$status_class = 'danger';
											break;
										case 'Processing':
											$status_class = 'warning';
											break;
										case 'Complete':
											$status_class = 'success';
											break;
										default :
											$status_class = 'primary';
											break;
									}

									echo "<tr>";
										echo "<td>".$item->id."</td>";
										echo "<td>".$item->title_name.$item->first_name." ".$item->last_name."</td>";
										echo "<td>".$item->hn."</td>";
										echo "<td><span class=\"text-danger\">".$item->lab_code."</span></td>";
										echo "<td><span class=\"badge badge-pill badge-".$status_class."\">".$item->lab_status."</span></td>";
										echo "<td>";
											echo "<a href=\"#\" class=\"btn btn-info\">แก้ไข</a>&nbsp;";
											echo "<a href=\"#\" class=\"btn btn-danger\">ลบ</button>";
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
</div>
@endsection
@section('bottom-script')
<script src='public/assets/libs/datatables-1.10.18/datatables-1.10.18/js/jquery.dataTables.min.js'></script>
<script src='public/assets/libs/datatables-1.10.18/Responsive-2.2.2/js/responsive.bootstrap.min.js'></script>
<script src="public/assets/libs/select2/dist/js/select2.full.min.js"></script>
<script src="public/assets/libs/select2/dist/js/select2.min.js"></script>
<script>
$(document).ready(function() {
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

	/* select2 */
	//$(".select2").select2();
});
</script>
<script>
/* ajax request */
$.ajaxSetup({
	headers: {
		'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
	}
});
$(".select-province").select2();
$(".select-hospital").select2({
	closeOnSelect : false
});
$(".select-status").select2({
	closeOnSelect : false,
	placeholder : "-- เลือกสถานะ --",
	allowHtml: true,
	allowClear: true,
	tags: true
});
$(".select-province").on("select2:select select2:unselect", function(e) {
	var s = $(e.currentTarget).val();
	alert(s);
});
/*
$(".search-status").on("select2:select select2:unselect", function(e) {
	e.preventDefault();
	// var s = $(e.currentTarget).val();
	var s = $(this).val();
	$.ajax({
		type: "POST",
		url: "{ route('ajaxSelect') }}",
		dataType: 'json',
		data: {'x': s},
		success: function(data) {
			alert(data.x);
		}
	});
});
*/
$("#x").click(function(e) {
	e.preventDefault();
	$.ajax({
		type: "POST",
		url: "{{ route('ajaxSelect') }}",
		dataType: 'json',
		data: {'x':'123'},
		success: function(data) {
			alert(data.x);
		}
	});
});
</script>
@endsection
