@extends('layouts.index')
@section('style')
<link rel='stylesheet' href='public/assets/libs/datatables-1.10.18/datatables-1.10.18/css/jquery.dataTables.min.css'>
<link rel='stylesheet' href='public/assets/libs/datatables-1.10.18/Responsive-2.2.2/css/responsive.bootstrap.min.css'>
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
</style>
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
	<div class="row">
		<div class="col-md-12">
			<div class="card">
				<div class="card-body">
					<div class="d-md-flex align-items-center">
						<div>
							<h4 class="card-title">รายการข้อมูล โครงการเฝ้าระวังเชื้อไวรัสก่อโรคระบบทางเดินหายใจ</h4>
							<h5 class="card-subtitle">Flu-BOE</h5>
						</div>
					</div>
					<div id="patient_data">
						<table class="display mT-2 mb-4" id="code_table" role="table">
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
								$titleNameKeyed = $titleName->keyBy('id');
								$patient->each(function ($item, $key) use ($titleNameKeyed) {
									echo "<tr>";
										echo "<td>".$item->id."</td>";
										echo "<td>".$titleNameKeyed[$item->title_name]->title_name.$item->first_name." ".$item->last_name."</td>";
										echo "<td>".$item->hn."</td>";
										echo "<td><span class=\"text-danger\">".$item->lab_code."</span></td>";
										echo "<td><span class=\"badge badge-pill badge-success\">".$item->lab_status."</span></td>";
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
@section('script')
<script src='public/assets/libs/datatables-1.10.18/datatables-1.10.18/js/jquery.dataTables.min.js'></script>
<script src='public/assets/libs/datatables-1.10.18/Responsive-2.2.2/js/responsive.bootstrap.min.js'></script>
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

});
</script>
@endsection
