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
										<img src="{{ URL::asset('qrcode/qr'.$data['patient_lab_code'].'.png') }}" />
									</div>
									<div class="form-row">
										<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 mb-3">
											<div class="input-group-append">
												<span class="btn btn-danger btn-lg" data-toggle="tooltip" data-placement="top" title="โปรดเขียนรหัสนี้ลงบนแบบฟอร์ม">{{ $data['patient_lab_code'] }}</span>
												{{ csrf_field() }}
												<input type="hidden" name="pid" value="{{ $data['patient_id'] }}">
												<input type="hidden" name="lab_code" value="{{ $data['patient_lab_code'] }}">
											</div>
										</div>
									</div>
									<h1 class="text-info">1. ชื่อและที่อยู่ของผู้นำส่งตัวอย่าง</h1>
									<div class="form-row">
										<div class="col-xs-12 col-sm-12 col-md-6 col-lg-3 col-xl-3 mb-3">
											<label for="userNameInput">ชื่อ-สกุล</label>
											<input type="text" name="uFullNameInput" class="form-control" value="{{ $data['user_fullname'] }}" placeholder="ชื่อ-สกุล" readonly>
										</div>
										<div class="col-xs-12 col-sm-12 col-md-6 col-lg-3 col-xl-3 mb-3">
											<label for="userOffice">โรงพยาบาล/หน่วยงาน</label>
											<input type="text" name="uOffice" class="form-control" value="{{ $data['user_office'] }}" placeholder="หน่วยงาน" readonly>
										</div>
									</div>
									<div class="form-row">
										<div class="col-xs-12 col-sm-12 col-md-6 col-lg-3 col-xl-3 mb-3">
											<label for="userProvince">จังหวัด</label>
											<input type="text" name="uProvince" value="{{ $data['user_province'] }}" class="form-control" placeholder="จังหวัด" readonly>
										</div>
										<div class="col-xs-12 col-sm-12 col-md-6 col-lg-3 col-xl-3 mb-3">
											<label for="phoneInput">โทรศัพท์</label>
											<input type="text" name="phoneInput" value="{{ $data['user_phone'] }}" class="form-control" placeholder="โทรศัพท์" readonly>
										</div>
										<div class="col-xs-12 col-sm-12 col-md-6 col-lg-3 col-xl-3 mb-3">
											<label for="faxInput">โทรสาร</label>
											<input type="text" name="faxInput" value="{{ $data['user_fax'] }}" class="form-control" placeholder="โทรสาร" readonly>
										</div>
									</div>
								</div>
								<div class="bd-callout bd-callout-info" style="margin-top:0;position:relative">
									<h1 class="text-info">2. ข้อมูลผู้ป่วย</h1>
									<div class="form-row">
										<div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 col-xl-2 mb-3">
											<label for="patientName">ชื่อ-สกุล</label>
											<input type="text" name="pNameInput" class="form-control" value="{{ $data['patient_fullname'] }}" placeholder="ชื่อ-สกุล" readonly>
										</div>
										<div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 col-xl-2 mb-3">
											<label for="patientGender">เพศ</label>
											<div class="custom-control custom-checkbox">
												<div class="form-check form-check-inline">
													<input type="checkbox" name="cerebralInput" value="male" @if ($data['patient_gender'] == 'male') checked @endif class="custom-control-input form-check-input" readonly>
													<label for="male" class="custom-control-label">&nbsp;ชาย</label>
												</div>
												<div class="form-check form-check-inline">
													<input type="checkbox" name="cerebralInput" value="female" @if ($data['patient_gender'] == 'female') checked @endif class="custom-control-input form-check-input" readonly>
													<label for="female" class="custom-control-label">&nbsp;หญิง</label>
												</div>
											</div>
										</div>
										<div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 col-xl-2 mb-3">
											<label for="HN">HN</label>
											<input type="text" name="hnInput" value="{{ $data['patient_hn'] }}" class="form-control" placeholder="HN" readonly>
										</div>
										<div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 col-xl-2 mb-3">
											<label for="age">อายุ (ปี-เดือน-วัน)</label>
											<input type="text" name="ageInput"  value="{{ $data['patient_age'] }}" class="form-control" placeholder="อายุ" readonly>
										</div>
									</div>
									<div class="form-row">
										<div class="col-xs-12 col-sm-12 col-md-6 col-lg-2 col-xl-2 mb-3">
											<div class="form-group">
												<label for="houseNo">ที่อยู่ปัจจุบัน/ขณะป่วย เลขที่</label>
												<input type="text" name="houseNoInput" value="{{ $data['patient_house_no'] }}" class="form-control" placeholder="บ้านเลขที่" readonly>
											</div>
										</div>
										<div class="col-xs-12 col-sm-12 col-md-6 col-lg-1 col-xl-1 mb-3">
											<div class="form-group">
												<label for="villageNo">หมู่ที่</label>
												<input type="text" name="villageNoInput" value="{{ $data['patient_village_no'] }}" class="form-control" placeholder="หมู่ที่" readonly>
											</div>
										</div>
										<div class="col-xs-12 col-sm-12 col-md-6 col-lg-3 col-xl-3 mb-3">
											<label for="village">หมู่บ้าน</label>
											<input type="text" name="villageInput" value="{{ $data['patient_village'] }}" class="form-control" placeholder="หมู่บ้าน" readonly>
										</div>
										<div class="col-xs-12 col-sm-12 col-md-6 col-lg-3 col-xl-4 mb-3">
											<div class="form-group">
												<label for="lane">ซอย</label>
												<input type="text" name="laneInput" value="{{ $data['patient_lane'] }}" class="form-control" placeholder="ซอย" readonly>
											</div>
										</div>
									</div>
									<div class="form-row">
										<div class="col-xs-12 col-sm-12 col-md-6 col-lg-3 col-xl-3 mb-3">
											<label for="patientProvince">จังหวัด</label>
											<input type="text" name="pProvince" value="{{ $data['patient_province'] }}" class="form-control" placeholder="จังหวัด" readonly>
										</div>
										<div class="col-xs-12 col-sm-12 col-md-6 col-lg-3 col-xl-3 mb-3">
											<label for="patientDistrict">อำเภอ</label>
											<input type="text" name="pDistrict" value="{{ $data['patient_district'] }}" class="form-control" placeholder="อำเภอ" readonly>
										</div>
										<div class="col-xs-12 col-sm-12 col-md-6 col-lg-3 col-xl-3 mb-3">
											<label for="patientSubDistrict">ตำบล</label>
											<input type="text" name="pSubDistrict" value="{{ $data['patient_sub_district'] }}" class="form-control" placeholder="ตำบล" readonly>
										</div>
									</div>
									<div class="form-row">
										<div class="col-xs-12 col-sm-12 col-md-6 col-lg-3 col-xl-3 mb-3">
											<div class="form-group">
												<label for="sickDateInput">วันที่เริ่มป่วย</label>
												<div class="input-group date" data-provide="datepicke" id="sickDateInput">
													<div class="input-group">
														<input type="text" name="sickDateInput" value="{{ $data['patient_sickDate'] }}" class="form-control" readonly>
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
												<input type="text" name="hospitalNoInput" value="{{ $data['patient_hospital'] }}" class="form-control" placeholder="โรงพยาบาล" readonly>
											</div>
										</div>
										<div class="col-xs-12 col-sm-12 col-md-6 col-lg-3 col-xl-3 mb-3">
											<div class="form-group">
												<label for="dateDefine">วันที่เข้ารับการรักษา</label>
												<div class="input-group date" data-provide="datepicke" id="dateDefineInput">
													<div class="input-group">
														<input type="text" name="dateDefineInput" value="{{ $data['patient_dateDefine'] }}" class="form-control" readonly>
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
													<input type="text" name="temperatureInput" value="{{ $data['patient_temperature']}}" class="form-control" readonly>
													<div class="input-group-append">
														<span class="input-group-text">C&#176;</span>
													</div>
												</div>
											</div>
										</div>

										<div class="col-xs-12 col-sm-12 col-md-6 col-lg-2 col-xl-2 mb-3">
											<div class="form-group">
												<label for="feverDay">จำนวนวันที่เป็นไข้</label>
												<div class="input-group">
													<input type="number" name="feverDayInput" value="0" min="0" max="90" class="form-control">
													<div class="input-group-append">
														<span class="input-group-text">วัน</span>
													</div>
												</div>
											</div>
										</div>

									</div>
									<div class="form-row">
										<div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 col-xl-3 mb-3">
											<div class="form-check form-check-inline">
												<input type="checkbox" name="fever_sym" class="custom-control-input form-check-input">
												<label for="symptom" class="custom-control-label">&nbsp;ไข้</label>
											</div>
										</div>
										<div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 col-xl-3 mb-3">
											<div class="form-check form-check-inline">
												<input type="checkbox" name="fever_sym" class="custom-control-input form-check-input">
												<label for="symptom" class="custom-control-label">&nbsp;ไอ (Cough)</label>
											</div>
										</div>
										<div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 col-xl-3 mb-3">
											<div class="form-check form-check-inline">
												<input type="checkbox" name="fever_sym" class="custom-control-input form-check-input">
												<label for="symptom" class="custom-control-label">&nbsp;เจ็บคอ (Sore throat)</label>
											</div>
										</div>
										<div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 col-xl-3 mb-3">
											<div class="form-check form-check-inline">
												<input type="checkbox" name="fever_sym" class="custom-control-input form-check-input">
												<label for="symptom" class="custom-control-label">&nbsp;มีน้ำมูก/คัดจมูก (Runny or stuffy nose)</label>
											</div>
										</div>
									</div>
									<!--
									<div class="form-row">
										foreach ($symptoms as $key => $val)
											if ($val->id != 21)
												<div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 col-xl-3 mb-3">
													<div class="form-check form-check-inline">
														<input type="checkbox" name="symptom{ $val->id }}" class="custom-control-input form-check-input">
														<label for="symptom" class="custom-control-label">&nbsp;{ $val->symptom_name_th }}</label>
													</div>
												</div>
											else
												<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 mb-3">
													<div class="form-check form-check-inline">
														<input type="checkbox" name="symptom{ $val->id }}" class="custom-control-input form-check-input">
														<label for="symptom" class="custom-control-label">&nbsp;{ $val->symptom_name_th }}</label>
													</div>
													<input type="text" name="other_symptom_input" class="form-control" id="symptom_other" disabled>
												</div>
											endif
										endforeach
									</div>
									-->
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
