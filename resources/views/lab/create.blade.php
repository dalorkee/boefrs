@extends('layouts.index')
@section('custom-style')
<link rel="stylesheet" type="text/css" href="{{ URL::asset('assets/libs/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css') }}">
<link rel="stylesheet" type="text/css" href="{{ URL::asset('assets/libs/bootstrap-select-1.13.9/dist/css/bootstrap-select.min.css') }}">
<link rel="stylesheet" type="text/css" href="{{ URL::asset('assets/libs/toastr/build/toastr.min.css') }}">
<style>
input:-moz-read-only { /* For Firefox */
	background-color: #fafafa !important;
}
input:read-only {
	background-color: #fafafa !important;
}
</style>
@endsection
@section('meta-token')
<meta name="csrf-token" content="{{ csrf_token() }}">
@endsection
@section('contents')
<div class="page-breadcrumb bg-light">
	<div class="row">
		<div class="col-12 d-flex no-block align-items-center">
			<h4 class="page-title"><span style="display:none;">Form</span></h4>
			<div class="ml-auto text-right">
				<nav aria-label="breadcrumb">
					<ol class="breadcrumb">
						<li class="breadcrumb-item"><a href="#">Home</a></li>
						<li class="breadcrumb-item active" aria-current="page">Form</li>
						<li class="breadcrumb-item active" aria-current="page">Lab</li>
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
					@if (count($errors) > 0)
						<div class="alert alert-danger">
							<ul>
							@foreach ($errors->all() as $error)
								<li>{{ $error }}</li>
							@endforeach
							</ul>
						</div>
					@endif
					<div class="d-md-flex align-items-center">
						<div>
							<h4 class="card-title">แบบเก็บข้อมูลโครงการเฝ้าระวังเชื้อไวรัสก่อโรคระบบทางเดินหายใจ</h4>
							<h5 class="card-subtitle">ID Flu-BOE</h5>
						</div>
					</div>
					<Form action="#" method="POST" class="needs-validation custom-form-legend" novalidate>
						<div class="card">
							<div class="card-body">
								<div class="bd-callout bd-callout-info" style="margin-top:0;position:relative">
									<div style="position:absolute; top:2px; right:2px;">
										<img src="{{ URL::asset('qrcode/qr'.$patient[0]->lab_code.'.png') }}" />
									</div>
									<div class="form-row">
										<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 mb-3">
											<div class="input-group-append">
												<span class="btn btn-danger btn-lg" data-toggle="tooltip" data-placement="top" title="โปรดเขียนรหัสนี้ลงบนแบบฟอร์ม">{{ $patient[0]->lab_code }}</span>
												{{ csrf_field() }}
												<input type="hidden" name="pid" value="{{ $patient[0]->id }}">
												<input type="hidden" name="formIndexInput" value="{{ $patient[0]->lab_code }}">
											</div>
										</div>
									</div>
									<h1 class="text-info">1. ชื่อและที่อยู่ของผู้นำส่งตัวอย่าง</h1>
									<div class="form-row">
										<div class="col-xs-12 col-sm-12 col-md-6 col-lg-3 col-xl-2 mb-3">
											<div class="form-group">
												<label for="titleName">คำนำหน้าชื่อ</label>
												<input type="hidden" name="title_name_cache" value="{{ auth()->user()->title_name }}">
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
										<div class="col-xs-12 col-sm-12 col-md-6 col-lg-3 col-xl-2 mb-3">
											<label for="otherTitleNameInput">อื่นๆ ระบุ</label>
											<input type="text" name="otherTitleNameInput" class="form-control" id="other_title_name_input" placeholder="คำนำหน้าชื่ออื่นๆ" disabled>
										</div>
										<div class="col-xs-12 col-sm-12 col-md-6 col-lg-3 col-xl-2 mb-3">
											<label for="firstNameInput">ชื่อจริง</label>
											<input type="text" name="firstNameInput" class="form-control" value="{{ auth()->user()->name }}" placeholder="ชื่อ">
										</div>
										<div class="col-xs-12 col-sm-12 col-md-6 col-lg-3 col-xl-2 mb-3">
											<label for="lastNameInput">นามสกุล</label>
											<input type="text" name="lastNameInput" class="form-control" value="{{ auth()->user()->lastname }}" placeholder="นามสกุล">
										</div>
									</div>
									<div class="form-row">
										<div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 col-xl-2 mb-3">
											<div class="form-group">
												<label for="province">จังหวัด</label>
												<select name="province" class="form-control selectpicker show-tick" id="select_province" data-live-search="true" >
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
										<div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 col-xl-2 mb-3">
											<div class="form-group">
												<label for="hospital">โรงพยาบาล</label>
												<select name="hospcode" class="form-control selectpicker show-tick" id="select_hospital" data-live-search="true" disabled>
													<option value="0">-- เลือกโรงพยาบาล --</option>
												</select>
											</div>
										</div>
										<div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 col-xl-2 mb-3">
											<label for="phoneInput">โทรศัพท์</label>
											<input type="text" name="phoneInput" class="form-control" id="phone_input" placeholder="โทรศัพท์">
										</div>
										<div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 col-xl-2 mb-3">
											<label for="faxInput">โทรสาร</label>
											<input type="text" name="faxInput" class="form-control" id="fax_input" placeholder="โทรสาร">
										</div>
									</div>
								</div>
								<div class="bd-callout bd-callout-info" style="margin-top:0;position:relative">
									<h1 class="text-info">2. ข้อมูลผู้ป่วย</h1>
									<div class="form-row">
										<div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 col-xl-2 mb-3">
											<label for="patientName">ชื่อ</label>
											<input type="text" name="pNameInput" class="form-control" value="" placeholder="ชื่อ-สกุล">
										</div>
										<div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 col-xl-2 mb-3">
											<label for="patientName">นามสกุล</label>
											<input type="text" name="pLastnameInput" class="form-control" value="" placeholder="ชื่อ-สกุล">
										</div>
										<div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 col-xl-2 mb-3">
											<label for="patientName">เพศ</label>
											<div class="custom-control custom-checkbox">
												<div class="form-check form-check-inline">
													<input type="checkbox" name="cerebralInput" value="" class="custom-control-input form-check-input" id="sex_male">
													<label for="male" class="custom-control-label">&nbsp;ชาย</label>
												</div>
												<div class="form-check form-check-inline">
													<input type="checkbox" name="cerebralInput" value="" class="custom-control-input form-check-input" id="sex_female">
													<label for="female" class="custom-control-label">&nbsp;หญิง</label>
												</div>
											</div>
										</div>
										<div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 col-xl-2 mb-3">
											<label for="HN">HN</label>
											<input type="text" name="hnInput" class="form-control" placeholder="HN" value="">
										</div>
										<div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 col-xl-2 mb-3">
											<label for="age">อายุ</label>
											<input type="text" name="ageInput" class="form-control" placeholder="อายุ" value="">
										</div>
									</div>
									<div class="form-row">
										<div class="col-xs-12 col-sm-12 col-md-6 col-lg-2 col-xl-2 mb-3">
											<div class="form-group">
												<label for="houseNo">ที่อยู่ปัจจุบัน/ขณะป่วย เลขที่</label>
												<input type="text" name="houseNoInput" class="form-control" placeholder="บ้านเลขที่">
											</div>
										</div>
										<div class="col-xs-12 col-sm-12 col-md-6 col-lg-1 col-xl-1 mb-3">
											<div class="form-group">
												<label for="villageNo">หมู่ที่</label>
												<input type="text" name="villageNoInput" class="form-control" placeholder="หมู่ที่">
											</div>
										</div>
										<div class="col-xs-12 col-sm-12 col-md-6 col-lg-3 col-xl-3 mb-3">
											<label for="village">หมู่บ้าน</label>
											<input type="text" name="villageInput" class="form-control" placeholder="หมู่บ้าน">
										</div>
										<div class="col-xs-12 col-sm-12 col-md-6 col-lg-3 col-xl-4 mb-3">
											<div class="form-group">
												<label for="lane">ซอย</label>
												<input type="text" name="laneInput" class="form-control" placeholder="ซอย">
											</div>
										</div>
									</div>
									<div class="form-row">
										<div class="col-xs-12 col-sm-12 col-md-6 col-lg-2 col-xl-2 mb-3">
											<div class="form-group {{ $errors->has('provinceInput') ? 'has-error' : '' }}">
												<label for="province">จังหวัด</label>
												<select name="provinceInput" class="form-control selectpicker show-tick" id="select_province">
													<option value="">-- เลือกจังหวัด --</option>
													@php
														$provinces = Session::get('provinces');
														$provinces->each(function ($item, $key) {
															echo "<option value=\"".$item->province_id."\">".$item->province_name."</option>\n";
														});
													@endphp
												</select>
											</div>
										</div>
										<div class="col-xs-12 col-sm-12 col-md-6 col-lg-3 col-xl-3 mb-3">
											<div class="form-group">
												<label for="district">อำเภอ</label>
												<select name="districtInput" class="form-control selectpicker show-tick" id="select_district">
													<option value="">-- โปรดเลือก --</option>
												</select>
											</div>
										</div>
										<div class="col-xs-12 col-sm-12 col-md-6 col-lg-2 col-xl-2 mb-3">
											<div class="form-group">
												<label for="subDistrict">ตำบล</label>
												<select name="subDistrictInput" class="form-control selectpicker show-tick" id="select_sub_district">
													<option value="">-- โปรดเลือก --</option>
												</select>
											</div>
										</div>
									</div>
									<div class="form-row">
										<div class="col-xs-12 col-sm-12 col-md-6 col-lg-2 col-xl-2 mb-3">
											<div class="form-group">
												<label for="sickDateInput">วันที่เริ่มป่วย</label>
												<div class="input-group date" data-provide="datepicke" id="sickDateInput">
													<div class="input-group">
														<input type="text" name="sickDateInput" class="form-control">
														<div class="input-group-append">
															<span class="input-group-text"><i class="mdi mdi-calendar"></i></span>
														</div>
													</div>
												</div>
											</div>
										</div>
										<div class="col-xs-12 col-sm-12 col-md-6 col-lg-3 col-xl-3 mb-3">
											<div class="form-group">
												<label for="hospital">โรงพยาบาล</label>
												<input type="text" name="hospitalNoInput" class="form-control" placeholder="โรงพยาบาล">
											</div>
										</div>
										<div class="col-xs-12 col-sm-12 col-md-6 col-lg-2 col-xl-2 mb-3">
											<div class="form-group">
												<label for="treatDateInput">วันที่เข้ารับการรักษา</label>
												<div class="input-group date" data-provide="datepicke" id="treatDateInput">
													<div class="input-group">
														<input type="text" name="treatDateInput" class="form-control">
														<div class="input-group-append">
															<span class="input-group-text"><i class="mdi mdi-calendar"></i></span>
														</div>
													</div>
												</div>
											</div>
										</div>

									</div>
								</div>
								<div class="bd-callout bd-callout-info" style="margin-top:0;position:relative">
									<h1 class="text-info">3. อาการ</h1>
									<div class="form-row">
										<div class="col-xs-12 col-sm-12 col-md-6 col-lg-2 col-xl-2 mb-3">
											<div class="form-group">
												<label for="temperature">อุณหภูมิร่างกาย</label>
												<div class="input-group">
													<input type="text" name="temperatureInput" value="" class="form-control">
													<div class="input-group-append">
														<span class="input-group-text">C&#176;</span>
													</div>
												</div>
											</div>
										</div>
									</div>
									<div class="form-row">
										@foreach ($symptoms as $key => $val)
											@if ($val->id != 21)
												<div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 col-xl-3 mb-3">
													<div class="form-check form-check-inline">
														<input type="checkbox" name="symptom{{ $val->id }}" class="custom-control-input form-check-input">
														<label for="symptom" class="custom-control-label">&nbsp;{{ $val->symptom_name_th }}</label>
													</div>
												</div>
											@else
												<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 mb-3">
													<div class="form-check form-check-inline">
														<input type="checkbox" name="symptom{{ $val->id }}" class="custom-control-input form-check-input">
														<label for="symptom" class="custom-control-label">&nbsp;{{ $val->symptom_name_th }}</label>
													</div>
													<input type="text" name="other_symptom_input" class="form-control" id="symptom_other" disabled>
												</div>
											@endif
										@endforeach
									</div>
									<div class="form-row">
										<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 mb-3">
											<label for="rapidTestResult">ผลการตรวจ Rapid test</label>
											<div>
												<div class="custom-control custom-checkbox custom-control-inline">
													<input type="checkbox" name="rapidTestResultInput" value="nagative" class="custom-control-input influRapidRs" id="rapidTestNagative">
													<label for="rapidTestNagative" class="custom-control-label normal-label">Nagative</label>
												</div>
												<div class="custom-control custom-checkbox custom-control-inline">
													<input type="checkbox" name="rapidTestResultInput" value="positive-flu-a" class="custom-control-input influRapidRs" id="rapidTestPositiveFluA">
													<label for="rapidTestPositiveFluA" class="custom-control-label normal-label">Positive Flu A</label>
												</div>
												<div class="custom-control custom-checkbox custom-control-inline">
													<input type="checkbox" name="rapidTestResultInput" value="positive-flu-b" class="custom-control-input influRapidRs" id="rapidTestPositiveFluB">
													<label for="rapidTestPositiveFluB" class="custom-control-label normal-label">Positive Flu B</label>
												</div>
											</div>
										</div>
									</div>



								</div>





							</div>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection
@section('bottom-script')
<script src="{{ URL::asset('assets/libs/datatables-1.10.18/DataTables-1.10.18/js/jquery.dataTables.min.js') }}"></script>
<script src="{{ URL::asset('assets/libs/datatables-1.10.18/Responsive-2.2.2/js/responsive.bootstrap.min.js') }}"></script>
<script src="{{ URL::asset('assets/libs/bootstrap-select-1.13.9/dist/js/bootstrap-select.min.js') }}"></script>
<script src="{{ URL::asset('assets/libs/bootstrap-validate-2.2.0/dist/bootstrap-validate.js') }}"></script>
<script>
$(document).ready(function() {
	/* ajax request */
	$.ajaxSetup({
		headers: {
			'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
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
			$('#select_hospital').append('<option val="0">-- เลือกโรงพยาบาล --</option>');
			$('#select_hospital').prop('disabled', true);
			$('#select_hospital').selectpicker("refresh");
		}
	});
});
</script>
@endsection
