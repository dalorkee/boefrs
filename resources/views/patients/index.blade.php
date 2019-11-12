@extends('layouts.index')
@section('custom-style')
<link rel="stylesheet" type="text/css" href="{{ URL::asset('assets/libs/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css') }}">
<link rel="stylesheet" type="text/css" href="{{ URL::asset('assets/libs/bootstrap-select-1.13.9/dist/css/bootstrap-select.min.css') }}">
<link rel="stylesheet" type="text/css" href="{{ URL::asset('assets/libs/toastr/build/toastr.min.css') }}">
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
						<li class="breadcrumb-item active" aria-current="page">Patient</li>
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
					<Form action="{{ route('addPatient') }}" method="POST" class="needs-validation custom-form-legend" novalidate>
						<div class="card">
							<div class="card-body">
								<div class="bd-callout bd-callout-info" style="margin-top:0;position:relative">
									<div style="position:absolute; top:2px; right:2px;">
										<img src="{{ URL::asset('qrcode/qr'.$patient[0]->lab_code.'.png') }}" />
									</div>
									<h1 class="text-info">1. ข้อมูลทั่วไปของผู้ป่วย</h1>
									<div class="form-row">
										<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 mb-3">
											<label for="formCode">รหัสแบบฟอร์ม</label>
											<div class="input-group-append">
												<span class="btn btn-primary btn-sm">{{ $patient[0]->lab_code }}</span>
												{{ csrf_field() }}
												<input type="hidden" name="pid" value="{{ $patient[0]->id }}">
												<input type="hidden" name="formIndexInput" value="{{ $patient[0]->lab_code }}">
											</div>
										</div>
									</div>
									<div class="form-row">
										<div class="col-xs-12 col-sm-12 col-md-6 col-lg-4 col-xl-4 mb-3">
											<div class="form-group {{ $errors->has('titleNameInput') ? 'has-error' : '' }}">
												<label for="titleName">คำนำหน้าชื่อ</label>
												<input type="hidden" name="title_name_cache" value="{{ $patient[0]->title_name }}">
												<select name="titleNameInput" class="form-control selectpicker show-tick select-title-name" id="title_name_input">
												@php
													if ($patient[0]->title_name == 6) {
														$cache_title_name = array( -6, $patient[0]->title_name_other);
													} else {
														$cache_title_name = array($patient[0]->title_name, $titleName[$patient[0]->title_name]->title_name);
													}
												@endphp
													<option value="{{ $cache_title_name[0] }}">{{ $cache_title_name[1] }}</option>
													<option value="0">-- โปรดเลือก --</option>
													@php
														$titleName->each(function ($item, $key) {
															echo "<option value=\"".$item->id."\">".$item->title_name."</option>";
														});
													@endphp
												</select>
												<span class="text-danger">{{ $errors->first('titleNameInput') }}</span>
											</div>
										</div>
										<div class="col-xs-12 col-sm-12 col-md-6 col-lg-4 col-xl-4 mb-3">
											<div class="form-group">
												<label for="otherTitleName">คำนำหน้าชื่ออื่นๆ ระบุ</label>
												@php
													if ($patient[0]->title_name == 6) {
														$title_name_oth_txt = $patient[0]->title_name_other;
														$disbled = null;
													} else {
														$title_name_oth_txt = null;
														$disbled = "disabled";
													}
												@endphp
												<input type="text" name="otherTitleNameInput" class="form-control" id="other_title_name_input" placeholder="คำนำหน้าชื่ออื่นๆ" value="{{ $title_name_oth_txt }}" {{ $disbled }}>
											</div>
										</div>
									</div>
									<div class="form-row">
										<div class="col-xs-12 col-sm-12 col-md-6 col-lg-4 col-xl-4 mb-3">
											<div class="form-group {{ $errors->has('firstNameInput') ? 'has-error' : '' }}">
												<label for="firstName">ชื่อจริง</label>
												<input type="text" name="firstNameInput" class="form-control" id="first_name_input" placeholder="ชื่อ" value="{{ $patient[0]->first_name }}" required>
											</div>
											<span class="text-danger">{{ $errors->first('firstNameInput') }}</span>
										</div>
										<div class="col-xs-12 col-sm-12 col-md-6 col-lg-4 col-xl-4 mb-3">
											<div class="form-group {{ $errors->has('lastNameInput') ? 'has-error' : '' }}">
												<label for="lastName">นามสกุล</label>
												<input type="text" name="lastNameInput" class="form-control" id="last_name_input" placeholder="นามสกุล" value="{{ $patient[0]->last_name }}" required>
											</div>
											<span class="text-danger">{{ $errors->first('lastNameInput') }}</span>
										</div>
									</div>
									<div class="form-row">
										<div class="col-xs-12 col-sm-12 col-md-6 col-lg-2 col-xl-2 mb-3">
											<div class="form-group {{ $errors->has('hnInput') ? 'has-error' : '' }}">
												<label for="HN">HN</label>
												<input type="text" name="hnInput" class="form-control" id="hn_input" placeholder="HN" value="{{ $patient[0]->hn }}" required>
											</div>
											<span class="text-danger">{{ $errors->first('hnInput') }}</span>
										</div>
										<div class="col-xs-12 col-sm-12 col-md-6 col-lg-2 col-xl-2 mb-3">
											<div class="form-group">
												<label for="AN">AN</label>
												<input type="text" name="anInput" class="form-control" id="an_input" placeholder="AN" value="{{ $patient[0]->an }}">
											</div>
										</div>
									</div>
									<div class="form-row">
										<div class="col-xs-12 col-sm-12 col-md-6 col-lg-2 col-xl-2 mb-3">
											<div class="form-group {{ $errors->has('sexInput') ? 'has-error' : '' }}">
												<label for="sex">เพศ</label>
												<select name="sexInput" class="form-control selectpicker show-tick">
													<option value="">-- โปรดเลือก --</option>
													<option value="male">ชาย</option>
													<option value="female">หญิง</option>
												</select>
											</div>
											<span class="text-danger">{{ $errors->first('sexInput') }}</span>
										</div>
										<div class="col-xs-12 col-sm-12 col-md-6 col-lg-2 col-xl-2 mb-3">
											<div class="form-group">
												<label for="birthDate">ว/ด/ป เกิด</label>
												<div class="input-group date" data-provide="datepicker" id="birthDayInput">
													<input  type="text" name="birthDayInput" class="form-control {{ $errors->has('birthDayInput') ? 'border-danger' : '' }}">
													<div class="input-group-append">
														<span class="input-group-text"><i class="mdi mdi-calendar"></i></span>
													</div>
												</div>
											</div>
											<div class="text-danger">{{ $errors->first('birthDayInput') }}</div>
										</div>
										<div class="col-xs-12 col-sm-12 col-md-4 col-lg-1 col-xl-1 mb-3">
											<div class="form-group">
												<label for="ageYear">อายุ/ปี</label>
												<input type="text" name="ageYearInput" class="form-control" id="age_year_input" value="0" required readonly>
											</div>
										</div>
										<div class="col-xs-12 col-sm-12 col-md-4 col-lg-1 col-xl-1 mb-3">
											<div class="form-group">
												<label for="ageMonth">อายุ/เดือน</label>
												<input type="text" name="ageMonthInput" class="form-control" id="age_month_input" value="0" required readonly>
											</div>
										</div>
										<div class="col-xs-12 col-sm-12 col-md-4 col-lg-1 col-xl-1 mb-3">
											<div class="form-group">
												<label for="ageMonth">อายุ/วัน</label>
												<input type="text" name="ageDayInput" class="form-control" id="age_day_input" value="0" required readonly>
											</div>
										</div>
									</div>
									<div class="form-row">
										<div class="col-xs-12 col-sm-12 col-md-6 col-lg-2 col-xl-2 mb-3">
											<div class="form-group">
												<label for="nationality">สัญชาติ</label>
												<select name="nationalityInput" class="form-control selectpicker show-tick" id="select_nationality">
													<option value="0">-- โปรดเลือก --</option>
													@foreach ($nationality as $key => $value)
														<option value="{{ $value->id }}">{{ $value->name_th }}</option>
													@endforeach
												</select>
											</div>
										</div>
										<div class="col-xs-12 col-sm-12 col-md-4 col-lg-2 col-xl-2 mb-3">
											<div class="form-group">
												<label for="otherNationality">สัญชาติ อื่นๆ ระบุ</label>
												<input type="text" name="otherNationalityInput" class="form-control" id="other_nationality_input" placeholder="สัญชาติอื่นๆ" disabled>
											</div>
										</div>
									</div>
									<div class="form-row">
										<div class="col-xs-12 col-sm-12 col-md-6 col-lg-3 col-xl-3 mb-3">
											<div class="form-group {{ $errors->has('hospitalInput') ? 'has-error' : '' }}">
												<label for="hospital">โรงพยาบาล</label>
												<select name="hospitalInput" class="form-control selectpicker show-tick" id="select_hospital" data-live-search="true">
													@role('admin')
														<option value="">-- เลือกโรงพยาบาล --</option>
														@foreach ($hospital as $key => $val)
															<option value="{{ $val->hospcode }}">{{ $val->hosp_name }}</option>
														@endforeach
													@endrole
													@role('hospital|lab')
														<option value="{{ $user_hospital[0]->hospcode }}">{{ $user_hospital[0]->hosp_name }}</option>
													@endrole
												</select>
											</div>
											<span class="text-danger">{{ $errors->first('hospitalInput') }}</span>
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
										<div class="col-xs-12 col-sm-12 col-md-6 col-lg-3 col-xl-3 mb-3">
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
											<span class="text-danger">{{ $errors->first('provinceInput') }}</span>
										</div>
										<div class="col-xs-12 col-sm-12 col-md-6 col-lg-2 col-xl-2 mb-3">
											<div class="form-group {{ $errors->has('districtInput') ? 'has-error' : '' }}">
												<label for="district">อำเภอ</label>
												<select name="districtInput" class="form-control selectpicker show-tick" id="select_district">
													<option value="">-- โปรดเลือก --</option>
												</select>
											</div>
											<span class="text-danger">{{ $errors->first('districtInput') }}</span>
										</div>
										<div class="col-xs-12 col-sm-12 col-md-6 col-lg-2 col-xl-2 mb-3">
											<div class="form-group {{ $errors->has('subDistrictInput') ? 'has-error' : '' }}">
												<label for="subDistrict">ตำบล</label>
												<select name="subDistrictInput" class="form-control selectpicker show-tick" id="select_sub_district">
													<option value="">-- โปรดเลือก --</option>
												</select>
											</div>
											<span class="text-danger">{{ $errors->first('subDistrictInput') }}</span>
										</div>
									</div>
									<div class="form-row">
										<div class="col-xs-12 col-sm-12 col-md-4 col-lg-2 col-xl-2 mb-3">
											<label for="occupation">อาชีพ</label>
											<select name="occupationInput" class="form-control selectpicker show-tick" id="select_occupation">
												<option value="0">-- โปรดเลือก --</option>
												@foreach ($occupation as $key => $val)
													<option value="{{ $val->id }}">{{ $val->occu_name_th }}</option>
												@endforeach
											</select>
										</div>
										<div class="col-xs-12 col-sm-12 col-md-4 col-lg-4 col-xl-4 mb-3">
											<label for="occupationOtherInput">อาชีพ อื่นๆ ระบุ</label>
											<input type="text" name="occupationOtherInput" class="form-control" id="occupation_other_input" placeholder="อาชีพ อื่นๆ" disabled>
										</div>
									</div>
								</div><!-- bd-callout -->
							</div><!-- card body -->
						</div><!-- card -->
						<div class="card">
							<div class="card-body">
								<div class="bd-callout bd-callout-custom-7">
									<h1 class="text-color-custom-1">2. ข้อมูลทางคลินิก</h1>
									<div class="form-row">
										<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 mb-3 {{ $errors->has('patientType') ? 'border-danger' : '' }}">
											<div class="form-group">
												<label for="patient">ผู้ป่วย</label>
												<div>
													<div class="custom-control custom-checkbox custom-control-inline">
														<input type="checkbox" name="patientType" value="opd" class="custom-control-input pt-type" id="opdCheckbox">
														<label for="opdCheckbox" class="custom-control-label normal-label">ผู้ป่วยนอก (OPD)/ILI</label>
													</div>
													<div class="custom-control custom-checkbox custom-control-inline">
														<input type="checkbox" name="patientType" value="ipd" class="custom-control-input pt-type" id="ipdCheckbox">
														<label for="ipdCheckbox" class="custom-control-label normal-label">ผู้ป่วยใน (IPD)/SARI</label>
													</div>
													<div class="custom-control custom-checkbox custom-control-inline">
														<input type="checkbox" name="patientType" value="icu" class="custom-control-input pt-type" id="icuCheckbox">
														<label for="icuCheckbox" class="custom-control-label normal-label">ผู้ป่วยหนัก/ICU</label>
													</div>
												</div>
											</div>
											<span class="text-danger">{{ $errors->first('patientType') }}</span>
										</div>
									</div>
									<div class="form-row">
										<div class="col-xs-12 col-sm-12 col-md-6 col-lg-2 col-xl-2 mb-3">
											<div class="form-group">
												<label for="sickDateInput">วันที่เริ่มป่วย</label>
												<div class="input-group date" data-provide="datepicke" id="sickDateInput">
													<div class="input-group">
														<input type="text" name="sickDateInput" class="form-control {{ $errors->has('sickDateInput') ? 'border-danger' : '' }}" required>
														<div class="input-group-append">
															<span class="input-group-text"><i class="mdi mdi-calendar"></i></span>
														</div>
													</div>
												</div>
											</div>
											<span class="text-danger">{{ $errors->first('sickDateInput') }}</span>
										</div>
										<div class="col-xs-12 col-sm-12 col-md-6 col-lg-2 col-xl-2 mb-3">
											<div class="form-group">
												<label for="treatDateInput">วันที่รักษาครั้งแรก</label>
												<div class="input-group date" data-provide="datepicke" id="treatDateInput">
													<div class="input-group">
														<input type="text" name="treatDateInput" class="form-control {{ $errors->has('treatDateInput') ? 'border-danger' : '' }}" required>
														<div class="input-group-append">
															<span class="input-group-text"><i class="mdi mdi-calendar"></i></span>
														</div>
													</div>
												</div>
											</div>
											<span class="text-danger">{{ $errors->first('treatDateInput') }}</span>
										</div>
										<div class="col-xs-12 col-sm-12 col-md-6 col-lg-2 col-xl-2 mb-3">
											<div class="form-group">
												<label for="admitDateInput">วันที่นอนโรงพยาบาล</label>
												<div class="input-group date" data-provide="datepicke" id="admitDateInput">
													<div class="input-group">
														<input type="text" name="admitDateInput" class="form-control" required>
														<div class="input-group-append">
															<span class="input-group-text"><i class="mdi mdi-calendar"></i></span>
														</div>
													</div>
												</div>
											</div>
										</div>
										<div class="col-xs-12 col-sm-12 col-md-6 col-lg-2 col-xl-2 mb-3">
											<div class="form-group">
												<label for="sickDateInput">อุณหภูมิร่างกายแรกรับ</label>
												<div class="input-group">
													<input type="number" name="temperatureInput" value="0" class="form-control" max="50" min="0" required>
													<div class="input-group-append">
														<span class="input-group-text">C&#176;</span>
													</div>
												</div>
											</div>
										</div>
									</div>
									<div class="form-row">
										<div class="col-xs-12 col-sm-12 col-md-6 col-lg-12 col-xl-12 mb-3">
											<label for="sickDateInput">อาการและอาการแสดง</label>
											<div class="table-responsive">
												<table class="table" id="symptoms_table">
													<thead class="bg-custom-1 text-light">
														<tr>
															<th scope="col">อาการ</th>
															<th scope="col">มี</th>
															<th scope="col">ไม่มี</th>
															<th scope="col">ไม่ทราบ</th>
														</tr>
													</thead>
													<tbody>
													@php
													$symptoms->each(function ($item, $key) {
														if ($item->id == 21) {
															$other_symptom = "<input type=\"text\" name=\"other_symptom_input\" class=\"form-control\" id=\"symptom_other\" disabled>";
														} else {
															$other_symptom = null;
														}
														echo "<tr id=\"symptoms_table_tr".$item->id."\">";
															echo "<td>".$item->symptom_name_th." (".$item->symptom_name_en.") ".$other_symptom."</td>";
															echo "<td>";
																echo "<div class=\"custom-control custom-checkbox\">";
																	echo "<input type=\"checkbox\" name=\"symptom_".$item->id."_Input\" value=\"y\" class=\"custom-control-input symptom-".$item->id."\" id=\"symptom_".$item->id."_yes\">";
																	echo "<label for=\"symptom_".$item->id."_yes\" class=\"custom-control-label\">&nbsp;</label>";
																echo "</div>";
															echo "</td>";
															echo "<td>";
																echo "<div class=\"custom-control custom-checkbox\">";
																	echo "<input type=\"checkbox\" name=\"symptom_".$item->id."_Input\" value=\"n\" class=\"custom-control-input symptom-".$item->id."\" id=\"symptom_".$item->id."_no\">";
																	echo "<label for=\"symptom_".$item->id."_no\" class=\"custom-control-label\"></label>";
																echo "</div>";
															echo "</td>";
															echo "<td>";
																echo "<div class=\"custom-control custom-checkbox\">";
																	echo "<input type=\"checkbox\" name=\"symptom_".$item->id."_Input\" value=\"u\" class=\"custom-control-input symptom-".$item->id."\" id=\"symptom_".$item->id."_un\">";
																	echo "<label for=\"symptom_".$item->id."_un\" class=\"custom-control-label\"></label>";
																echo "</div>";
															echo "</td>";
														echo "</tr>\n";
													})
													@endphp
													</tbody>
												</table>
											</div>
										</div>
									</div>
									<div class="form-row">
										<div class="col-xs-12 col-sm-12 col-md-6 col-lg-2 col-xl-2 mb-3">
											<label for="firstXrayInput">เอกซเรย์ปอด (ครั้งแรก)</label>
											<div>
												<div class="custom-control custom-checkbox custom-control-inline">
													<input type="checkbox" name="lungXrayInput" value="n" class="custom-control-input lungXray" id="lungXrayNo">
													<label for="lungXrayNo" class="custom-control-label normal-label">ไม่ได้ทำ</label>
												</div>
												<div class="custom-control custom-checkbox custom-control-inline">
													<input type="checkbox" name="lungXrayInput" value="y" class="custom-control-input lungXray" id="lungXrayYes">
													<label for="lungXrayYes" class="custom-control-label normal-label">ทำ</label>
												</div>
											</div>
										</div>
										<div class="col-xs-12 col-sm-12 col-md-6 col-lg-2 col-xl-2 mb-3">
											<label for="xRayDateInput">ระบุวันที่</label>
											<div class="input-group date" data-provide="datepicke" id="xRayDateInput">
												<div class="input-group">
													<input type="text" name="xRayDateInput" class="form-control" id="xRayDate" disabled>
													<div class="input-group-append">
														<span class="input-group-text"><i class="mdi mdi-calendar"></i></span>
													</div>
												</div>
											</div>
										</div>
										<div class="col-xs-12 col-sm-12 col-md-6 col-lg-8 col-xl-8 mb-3">
											<label for="xRayResult">ระบุผล</label>
											<input type="text" name="xRayResultInput" class="form-control" id="xRayRs" disabled>
										</div>
									</div>
									<div class="form-row">
										<div class="col-xs-12 col-sm-12 col-md-6 col-lg-2 col-xl-2 mb-3">
											<label for="cbcDateInput">CBC (ครั้งแรก): วันที่</label>
											<div class="input-group date" data-provide="datepicke" id="cbcDateInput">
												<div class="input-group">
													<input type="text" name="cbcDateInput" class="form-control">
													<div class="input-group-append">
														<span class="input-group-text"><i class="mdi mdi-calendar"></i></span>
													</div>
												</div>
											</div>
										</div>
										<div class="col-xs-12 col-sm-12 col-md-6 col-lg-2 col-xl-2 mb-3">
											<label for="hbInput">ผล Hb</label>
											<div class="input-group">
												<input type="text" name="hbInput" class="form-control">
												<div class="input-group-append">
													<span class="input-group-text">mg%</span>
												</div>
											</div>
										</div>
										<div class="col-xs-12 col-sm-12 col-md-6 col-lg-2 col-xl-2 mb-3">
											<label for="htcInput">Hct</label>
											<div class="input-group">
												<input type="text" name="htcInput" class="form-control">
												<div class="input-group-append">
													<span class="input-group-text">%</span>
												</div>
											</div>
										</div>
										<div class="col-xs-12 col-sm-12 col-md-6 col-lg-2 col-xl-2 mb-3">
											<label for="plateletCountInput">Plate count</label>
											<div class="input-group">
												<input type="text" name="plateletInput" class="form-control">
												<div class="input-group-append">
													<span class="input-group-text">x10<sup>3</sup></span>
												</div>
											</div>
										</div>
									</div>
									<div class="form-row">
										<div class="col-xs-12 col-sm-12 col-md-6 col-lg-2 col-xl-2 mb-3">
											<label for="wbcInput">WBC</label>
											<input type="text" name="wbcInput" class="form-control">
										</div>
										<div class="col-xs-12 col-sm-12 col-md-6 col-lg-2 col-xl-2 mb-3">
											<label for="nInput">N</label>
											<div class="input-group">
												<input type="text" name="nInput" class="form-control">
												<div class="input-group-append">
													<span class="input-group-text">%</span>
												</div>
											</div>
										</div>
										<div class="col-xs-12 col-sm-12 col-md-6 col-lg-2 col-xl-2 mb-3">
											<label for="lInput">L</label>
											<div class="input-group">
												<input type="text" name="lInput" class="form-control">
												<div class="input-group-append">
													<span class="input-group-text">%</span>
												</div>
											</div>
										</div>
										<div class="col-xs-12 col-sm-12 col-md-6 col-lg-2 col-xl-2 mb-3">
											<label for="atypLymphInput">Atyp lymph</label>
											<div class="input-group">
												<input type="text" name="atypLymphInput" class="form-control">
												<div class="input-group-append">
													<span class="input-group-text">%</span>
												</div>
											</div>
										</div>
									</div>
									<div class="form-row">
										<div class="col-xs-12 col-sm-12 col-md-6 col-lg-2 col-xl-2 mb-3">
											<label for="monoInput">Mono</label>
											<div class="input-group">
												<input type="text" name="monoInput" class="form-control">
												<div class="input-group-append">
													<span class="input-group-text">%</span>
												</div>
											</div>
										</div>
										<div class="col-xs-12 col-sm-12 col-md-6 col-lg-2 col-xl-2 mb-3">
											<label for="basoInput">Baso</label>
											<div class="input-group">
												<input type="text" name="basoInput" class="form-control">
												<div class="input-group-append">
													<span class="input-group-text">%</span>
												</div>
											</div>
										</div>
										<div class="col-xs-12 col-sm-12 col-md-6 col-lg-2 col-xl-2 mb-3">
											<label for="eoInput">Eo</label>
											<div class="input-group">
												<input type="text" name="eoInput" class="form-control">
												<div class="input-group-append">
													<span class="input-group-text">%</span>
												</div>
											</div>
										</div>
										<div class="col-xs-12 col-sm-12 col-md-6 col-lg-2 col-xl-2 mb-3">
											<label for="bandInput">Band</label>
											<div class="input-group">
												<input type="text" name="bandInput" class="form-control">
												<div class="input-group-append">
													<span class="input-group-text">%</span>
												</div>
											</div>
										</div>
									</div>
									<div class="form-row">
										<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 mb-3">
											<label for="firstDiagnosis">การวินิจฉัยเบื้องต้น</label>
											<input type="text" name="firstDiagnosisInput" class="form-control" placeholder="การวินิจฉัยเบื้องต้น">
										</div>
									</div>
									<div class="form-row">
										<div class="col-xs-12 col-sm-12 col-md-6 col-lg-2 col-xl-2 mb-3">
											<label for="influenzaRapid">มีการตรวจ Influenza rapid test</label>
											<div>
												<div class="custom-control custom-checkbox custom-control-inline">
													<input type="checkbox" name="influRapidInput" value="n" class="custom-control-input influRapid" id="influRapidUnChecked">
													<label for="influRapidUnChecked" class="custom-control-label normal-label">ไม่ตรวจ</label>
												</div>
												<div class="custom-control custom-checkbox custom-control-inline">
													<input type="checkbox" name="influRapidInput" value="y" class="custom-control-input influRapid" id="influRaidCheckd">
													<label for="influRaidCheckd" class="custom-control-label normal-label">ตรวจ</label>
												</div>
											</div>
										</div>
										<div class="col-xs-12 col-sm-12 col-md-6 col-lg-4 col-xl-4 mb-2">
											<label for="influTestName">ระบุชื่อ test</label>
											<input type="text" name="influRapidtestName" class="form-control" placeholder="ระบุชื่อ test" id="influRapidTestName" disabled>
										</div>
									</div>
									<div class="form-row">
										<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 mb-3">
											<label for="rapidTestResult">ผล Rapid test</label>
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
									<div class="form-row">
										<div class="col-xs-12 col-sm-12 col-md-6 col-lg-2 col-xl-2 mb-3">
											<label for="influVaccineReceive">ผู้ป่วยเคยได้รับวัคซีนไข้หวัดใหญ่หรือไม่</label>
											<div>
												<div class="custom-control custom-checkbox custom-control-inline">
													<input type="checkbox" name="influVaccineInput" value="n" class="custom-control-input influVaccineRc" id="influVaccineNo">
													<label for="influVaccineNo" class="custom-control-label normal-label">ไม่เคย</label>
												</div>
												<div class="custom-control custom-checkbox custom-control-inline">
													<input type="checkbox" name="influVaccineInput" value="y" class="custom-control-input influVaccineRc" id="influVaccineYes">
													<label for="influVaccineYes" class="custom-control-label normal-label">เคย</label>
												</div>
											</div>
										</div>
										<div class="col-xs-12 col-sm-12 col-md-6 col-lg-2 col-xl-2 mb-3">
											<label for="influVaccineDate">เคยได้รับเมื่อ</label>
											<div class="input-group date" data-provide="datepicke" id="influVaccineDateInput">
												<div class="input-group">
													<input type="text" name="influVaccineDateInput" class="form-control" id="influVaccineDate" disabled>
													<div class="input-group-append">
														<span class="input-group-text"><i class="mdi mdi-calendar"></i></span>
													</div>
												</div>
											</div>
										</div>
									</div>
									<div class="form-row">
										<div class="col-xs-12 col-sm-12 col-md-6 col-lg-2 col-xl-2 mb-3">
											<label for="virusMedicine">การให้ยาต้านไวรัส</label>
											<div>
												<div class="custom-control custom-checkbox custom-control-inline">
													<input type="checkbox" name="virusMedicineInput" value="n" class="custom-control-input virusMedic" id="virusMedicineNo">
													<label for="virusMedicineNo" class="custom-control-label normal-label">ไม่ให้</label>
												</div>
												<div class="custom-control custom-checkbox custom-control-inline">
													<input type="checkbox" name="virusMedicineInput" value="y" class="custom-control-input virusMedic" id="virusMedicineYes">
													<label for="virusMedicineYes" class="custom-control-label normal-label">ให้</label>
												</div>
											</div>
										</div>
										<div class="col-xs-12 col-sm-12 col-md-6 col-lg-4 col-xl-4 mb-3">
											<label for="medicineName">ชื่อยา</label>
											<input type="text" name="medicineNameInput" class="form-control" id="medicineName" placeholder="ชื่อยา" disabled>
										</div>
										<div class="col-xs-12 col-sm-12 col-md-6 col-lg-2 col-xl-2 mb-3">
											<label for="medicineGiveDateInput">วันที่เริ่มให้ยา</label>
											<div class="input-group date" data-provide="datepicke" id="medicineGiveDateInput">
												<div class="input-group">
													<input type="text" name="medicineGiveDateInput" class="form-control" id="medicineDate" disabled>
													<div class="input-group-append">
														<span class="input-group-text"><i class="mdi mdi-calendar"></i></span>
													</div>
												</div>
											</div>
										</div>
									</div>
									<div class="form-row">
										<div class="col-xs-12 col-sm-12 col-md-6 col-lg-12 col-xl-12 mb-3">
											<label for="sickDateInput">ภาวะสุขภาพ หรือ โรคประจำตัว</label>
											<div class="table-responsive">
												<table class="table" id="health_table">
													<thead class="bg-info text-light">
														<tr>
															<th scope="col">โรคประจำตัว</th>
															<th scope="col">มี</th>
															<th scope="col">ไม่มี</th>
															<th scope="col">ไม่ทราบ</th>
														</tr>
													</thead>
													<tfoot>
														<tr>
															<th colspan="4"><div data-class="bg-danger"><i class="fa fa-circle text-danger m-r-10"></i><strong>หมายเหตุ</strong> ภาวะทุพโภชการ/ขาดสารอาหาร ต้องมีการวินิจฉัยโดยแพทย์ ไม่ประเมินด้วยสายตา</div></th>
														</tr>
													</tfoot>
													<tbody>
														<tr id="health_table_tr1">
															<td>
																<div class="form-group row">
																	<label for="pregnant" class="mt-2 font-normal">หญิงตั้งครรภ์ ระบุ อายุครรภ์</label>
																	<div class="col-xs-6 col-sm-6 col-md-4 col-lg-3 col-xl-3">
																		<div class="input-group">
																			<input type="number" name="pregnantWeekInput" class="form-control" value="0" min="0" max="52" id="pregnant_age_week" disabled>
																			<div class="input-group-append">
																				<span class="input-group-text">สัปดาห์</span>
																			</div>
																		</div>
																	</div>
																</div>
															</td>
															<td>
																<div class="custom-control custom-checkbox">
																	<input type="checkbox" name="pregnantInput" value="y" class="custom-control-input health-1" id="pregnant_age_y">
																	<label for="pregnant_age_y" class="custom-control-label">&nbsp;</label>
																</div>
															</td>
															<td>
																<div class="custom-control custom-checkbox">
																	<input type="checkbox" name="pregnantInput" value="n" class="custom-control-input health-1" id="pregnant_age_n">
																	<label for="pregnant_age_n" class="custom-control-label">&nbsp;</label>
																</div>
															</td>
															<td>
																<div class="custom-control custom-checkbox">
																	<input type="checkbox" name="pregnantInput" value="u" class="custom-control-input health-1" id="pregnant_age_u">
																	<label for="pregnant_age_u" class="custom-control-label">&nbsp;</label>
																</div>
															</td>
														</tr>
														<tr id="health_table_tr2">
															<td>
																<div class="form-group row">
																	<label for="give_birth" class="mt-2 font-normal">หญิงหลังคลอด ในช่วง 2 สัปดาห์แรก</label>
																</div>
															</td>
															<td>
																<div class="custom-control custom-checkbox">
																	<input type="checkbox" name="postPregnantInput" value="y" class="custom-control-input health-2" id="after_give_birth_y">
																	<label for="after_give_birth_y" class="custom-control-label">&nbsp;</label>
																</div>
															</td>
															<td>
																<div class="custom-control custom-checkbox">
																	<input type="checkbox" name="postPregnantInput" value="n" class="custom-control-input health-2" id="after_give_birth_n">
																	<label for="after_give_birth_n" class="custom-control-label">&nbsp;</label>
																</div>
															</td>
															<td>
																<div class="custom-control custom-checkbox">
																	<input type="checkbox" name="postPregnantInput" value="u" class="custom-control-input health-2" id="after_give_birth_u">
																	<label for="after_give_birth_u" class="custom-control-label">&nbsp;</label>
																</div>
															</td>
														</tr>
														<tr id="health_table_tr3">
															<td>
																<div class="form-group row">
																	<label for="fat" class="mt-2 font-normal">อ้วน ระบุส่วนสูง</label>
																	<div class="col-xs-6 col-sm-6 col-md-4 col-lg-3 col-xl-3">
																		<div class="input-group">
																			<input type="number" name="fatHeightInput" class="form-control" min="0" max="250" value="0" id="fat-height-input" disabled>
																			<div class="input-group-append">
																				<span class="input-group-text">cm</span>
																			</div>
																		</div>
																	</div>
																	<label for="fat_weight" class="mt-2 font-normal">น้ำหนัก</label>
																	<div class="col-xs-6 col-sm-6 col-md-4 col-lg-3 col-xl-3">
																		<div class="input-group">
																			<input type="number" name="fatWeightInput" class="form-control" min="0" max="200" value="0" id="fat-weight-input" disabled>
																			<div class="input-group-append">
																				<span class="input-group-text">kg</span>
																			</div>
																		</div>
																	</div>
																</div>
															</td>
															<td>
																<div class="custom-control custom-checkbox">
																	<input type="checkbox" name="fatInput" value="y" class="custom-control-input health-3" id="fat-input-y">
																	<label for="fat-input-y" class="custom-control-label">&nbsp;</label>
																</div>
															</td>
															<td>
																<div class="custom-control custom-checkbox">
																	<input type="checkbox" name="fatInput" value="n" class="custom-control-input health-3" id="fat-input-n">
																	<label for="fat-input-n" class="custom-control-label">&nbsp;</label>
																</div>
															</td>
															<td>
																<div class="custom-control custom-checkbox">
																	<input type="checkbox" name="fatInput" value="u" class="custom-control-input health-3" id="fat-input-u">
																	<label for="fat-input-u" class="custom-control-label">&nbsp;</label>
																</div>
															</td>
														</tr>
														<tr id="health_table_tr4">
															<td>
																<div class="form-group row">
																	<label for="diabetes" class="mt-2 font-normal">เบาหวาน</label>
																</div>
															</td>
															<td>
																<div class="custom-control custom-checkbox">
																	<input type="checkbox" name="diabetesInput" value="y" class="custom-control-input health-4" id="diabetes-y">
																	<label for="diabetes-y" class="custom-control-label">&nbsp;</label>
																</div>
															</td>
															<td>
																<div class="custom-control custom-checkbox">
																	<input type="checkbox" name="diabetesInput" value="n" class="custom-control-input health-4" id="diabetes-n">
																	<label for="diabetes-n" class="custom-control-label">&nbsp;</label>
																</div>
															</td>
															<td>
																<div class="custom-control custom-checkbox">
																	<input type="checkbox" name="diabetesInput" value="u" class="custom-control-input health-4" id="diabetes-u">
																	<label for="diabetes-u" class="custom-control-label">&nbsp;</label>
																</div>
															</td>
														</tr>
														<tr id="health_table_tr5">
															<td>
																<div class="form-group row">
																	<label for="immune" class="mt-2 font-normal">ภูมิคุ้มกันบกพร่อง ระบุ</label>
																	<div class="col-xs-6 col-sm-6 col-md-4 col-lg-3 col-xl-3">
																		<div class="input-group">
																			<input type="text" name="immuneSpecifyInput" class="form-control" id="immune_specify" disabled>
																		</div>
																	</div>

																</div>
															</td>
															<td>
																<div class="custom-control custom-checkbox">
																	<input type="checkbox" name="immuneInput" value="y" class="custom-control-input health-5" id="immune-y">
																	<label for="immune-y" class="custom-control-label">&nbsp;</label>
																</div>
															</td>
															<td>
																<div class="custom-control custom-checkbox">
																	<input type="checkbox" name="immuneInput" value="n" class="custom-control-input health-5" id="immune-n">
																	<label for="immune-n" class="custom-control-label">&nbsp;</label>
																</div>
															</td>
															<td>
																<div class="custom-control custom-checkbox">
																	<input type="checkbox" name="immuneInput" value="u" class="custom-control-input health-5" id="immune-u">
																	<label for="immune-u" class="custom-control-label">&nbsp;</label>
																</div>
															</td>
														</tr>
														<tr id="health_table_tr6">
															<td>
																<div class="form-group row">
																	<label for="preterm_infant" class="mt-2 font-normal">คลอดก่อนกำหนด อายุครรภ์</label>
																	<div class="col-xs-6 col-sm-6 col-md-4 col-lg-3 col-xl-3">
																		<div class="input-group">
																			<input type="number" name="earlyBirthWeekInput" value="0" min="0" max="52" class="form-control" id="preterm-infant-week">
																			<div class="input-group-append">
																				<span class="input-group-text">สัปดาห์</span>
																			</div>
																		</div>
																	</div>
																</div>
															</td>
															<td>
																<div class="custom-control custom-checkbox">
																	<input type="checkbox" name="earlyBirthInput" value="y" class="custom-control-input health-6" id="preterm-infant-y">
																	<label for="preterm-infant-y" class="custom-control-label">&nbsp;</label>
																</div>
															</td>
															<td>
																<div class="custom-control custom-checkbox">
																	<input type="checkbox" name="earlyBirthInput" value="n" class="custom-control-input health-6" id="preterm-infant-n">
																	<label for="preterm-infant-n" class="custom-control-label">&nbsp;</label>
																</div>
															</td>
															<td>
																<div class="custom-control custom-checkbox">
																	<input type="checkbox" name="earlyBirthInput" value="u" class="custom-control-input health-6" id="preterm-infant-u">
																	<label for="preterm-infant-u" class="custom-control-label">&nbsp;</label>
																</div>
															</td>
														</tr>
														<tr id="health_table_tr7">
															<td>
																<div class="form-group row">
																	<label for="malnutrition" class="mt-2 font-normal">ภาวะทุพโภชนาการ/ขาดสารอาหาร</label>
																</div>
															</td>
															<td>
																<div class="custom-control custom-checkbox">
																	<input type="checkbox" name="malnutritionInput" value="y" class="custom-control-input health-7" id="malnutrition-y">
																	<label for="malnutrition-y" class="custom-control-label">&nbsp;</label>
																</div>
															</td>
															<td>
																<div class="custom-control custom-checkbox">
																	<input type="checkbox" name="malnutritionInput" value="n" class="custom-control-input health-7" id="malnutrition-n">
																	<label for="malnutrition-n" class="custom-control-label">&nbsp;</label>
																</div>
															</td>
															<td>
																<div class="custom-control custom-checkbox">
																	<input type="checkbox" name="malnutritionInput" value="u" class="custom-control-input health-7" id="malnutrition-u">
																	<label for="malnutrition-u" class="custom-control-label">&nbsp;</label>
																</div>
															</td>
														</tr>
														<tr id="health_table_tr8">
															<td>
																<div class="form-group row">
																	<label for="copd" class="mt-2 font-normal">โรคปอดเรื้อัง (COPD)</label>
																</div>
															</td>
															<td>
																<div class="custom-control custom-checkbox">
																	<input type="checkbox" name="copdInput" value="y" class="custom-control-input health-8" id="copd-y">
																	<label for="copd-y" class="custom-control-label">&nbsp;</label>
																</div>
															</td>
															<td>
																<div class="custom-control custom-checkbox">
																	<input type="checkbox" name="copdInput" value="n" class="custom-control-input health-8" id="copd-n">
																	<label for="copd-n" class="custom-control-label">&nbsp;</label>
																</div>
															</td>
															<td>
																<div class="custom-control custom-checkbox">
																	<input type="checkbox" name="copdInput" value="u" class="custom-control-input health-8" id="copd-u">
																	<label for="copd-u" class="custom-control-label">&nbsp;</label>
																</div>
															</td>
														</tr>
														<tr id="health_table_tr9">
															<td>
																<div class="form-group row">
																	<label for="asthma" class="mt-2 font-normal">หอบหืด</label>
																</div>
															</td>
															<td>
																<div class="custom-control custom-checkbox">
																	<input type="checkbox" name="asthmaInput" value="y" class="custom-control-input health-9" id="asthma-y">
																	<label for="asthma-y" class="custom-control-label">&nbsp;</label>
																</div>
															</td>
															<td>
																<div class="custom-control custom-checkbox">
																	<input type="checkbox" name="asthmaInput" value="n" class="custom-control-input health-9" id="asthma-n">
																	<label for="asthma-n" class="custom-control-label">&nbsp;</label>
																</div>
															</td>
															<td>
																<div class="custom-control custom-checkbox">
																	<input type="checkbox" name="asthmaInput" value="u" class="custom-control-input health-9" id="asthma-u">
																	<label for="asthma-u" class="custom-control-label">&nbsp;</label>
																</div>
															</td>
														</tr>
														<tr id="health_table_tr10">
															<td>
																<div class="form-group row">
																	<label for="heart_disease" class="mt-2 font-normal">โรคหัวใจ</label>
																</div>
															</td>
															<td>
																<div class="custom-control custom-checkbox">
																	<input type="checkbox" name="heartDiseaseInput" value="y" class="custom-control-input health-10" id="heart-disease-y">
																	<label for="heart-disease-y" class="custom-control-label">&nbsp;</label>
																</div>
															</td>
															<td>
																<div class="custom-control custom-checkbox">
																	<input type="checkbox" name="heartDiseaseInput" value="n" class="custom-control-input health-10" id="heart-disease-n">
																	<label for="heart-disease-n" class="custom-control-label">&nbsp;</label>
																</div>
															</td>
															<td>
																<div class="custom-control custom-checkbox">
																	<input type="checkbox" name="heartDiseaseInput" value="u" class="custom-control-input health-10" id="heart-disease-u">
																	<label for="heart-disease-u" class="custom-control-label">&nbsp;</label>
																</div>
															</td>
														</tr>
														<tr id="health_table_tr11">
															<td>
																<div class="form-group row">
																	<label for="stroke" class="mt-2 font-normal">โรคหลอดเลือกสมอง</label>
																</div>
															</td>
															<td>
																<div class="custom-control custom-checkbox">
																	<input type="checkbox" name="cerebralInput" value="y" class="custom-control-input health-11" id="stroke-y">
																	<label for="stroke-y" class="custom-control-label">&nbsp;</label>
																</div>
															</td>
															<td>
																<div class="custom-control custom-checkbox">
																	<input type="checkbox" name="cerebralInput" value="n" class="custom-control-input health-11" id="stroke-n">
																	<label for="stroke-n" class="custom-control-label">&nbsp;</label>
																</div>
															</td>
															<td>
																<div class="custom-control custom-checkbox">
																	<input type="checkbox" name="cerebralInput" value="u" class="custom-control-input health-11" id="stroke-u">
																	<label for="stroke-u" class="custom-control-label">&nbsp;</label>
																</div>
															</td>
														</tr>
														<tr id="health_table_tr12">
															<td>
																<div class="form-group row">
																	<label for="kidney_disease" class="mt-2 font-normal">โรคไตวาย</label>
																</div>
															</td>
															<td>
																<div class="custom-control custom-checkbox">
																	<input type="checkbox" name="kidneyFailInput" value="y" class="custom-control-input health-12" id="kidney-disease-y">
																	<label for="kidney-disease-y" class="custom-control-label">&nbsp;</label>
																</div>
															</td>
															<td>
																<div class="custom-control custom-checkbox">
																	<input type="checkbox" name="kidneyFailInput" value="n" class="custom-control-input health-12" id="kidney-disease-n">
																	<label for="kidney-disease-n" class="custom-control-label">&nbsp;</label>
																</div>
															</td>
															<td>
																<div class="custom-control custom-checkbox">
																	<input type="checkbox" name="kidneyFailInput" value="u" class="custom-control-input health-12" id="kidney-disease-u">
																	<label for="kidney-disease-u" class="custom-control-label">&nbsp;</label>
																</div>
															</td>
														</tr>
														<tr id="health_table_tr13">
															<td>
																<div class="form-group row">
																	<label for="cancer" class="mt-2 font-normal">มะเร็ง ระบุ</label>
																	<div class="col-xs-6 col-sm-6 col-md-4 col-lg-4 col-xl-4">
																		<div class="input-group">
																			<input type="text" name="cancerSpecifyInput" class="form-control" id="cancer-input" disabled>
																		</div>
																	</div>
																</div>
															</td>
															<td>
																<div class="custom-control custom-checkbox">
																	<input type="checkbox" name="cancerInput" value="y" class="custom-control-input health-13" id="cancer-y">
																	<label for="cancer-y" class="custom-control-label">&nbsp;</label>
																</div>
															</td>
															<td>
																<div class="custom-control custom-checkbox">
																	<input type="checkbox" name="cancerInput" value="n" class="custom-control-input health-13" id="cancer-n">
																	<label for="cancer-n" class="custom-control-label">&nbsp;</label>
																</div>
															</td>
															<td>
																<div class="custom-control custom-checkbox">
																	<input type="checkbox" name="cancerInput" value="u" class="custom-control-input health-13" id="cancer-u">
																	<label for="cancer-u" class="custom-control-label">&nbsp;</label>
																</div>
															</td>
														</tr>
														<tr id="health_table_tr14">
															<td>
																<div class="form-group row">
																	<label for="other_disease" class="mt-2 font-normal">อื่นๆ ระบุ</label>
																	<div class="col-xs-6 col-sm-6 col-md-4 col-lg-4 col-xl-4">
																		<div class="input-group">
																			<input type="text" name="otherCongenitalSpecifyInput" class="form-control" id="other-disease-input" disabled>
																		</div>
																	</div>
																</div>
															</td>
															<td>
																<div class="custom-control custom-checkbox">
																	<input type="checkbox" name="otherCongenitalInput" value="y" class="custom-control-input health-14" id="other-disease-y">
																	<label for="other-disease-y" class="custom-control-label">&nbsp;</label>
																</div>
															</td>
															<td>
																<div class="custom-control custom-checkbox">
																	<input type="checkbox" name="otherCongenitalInput" value="n" class="custom-control-input health-14" id="other-disease-n">
																	<label for="other-disease-n" class="custom-control-label">&nbsp;</label>
																</div>
															</td>
															<td>
																<div class="custom-control custom-checkbox">
																	<input type="checkbox" name="otherCongenitalInput" value="u" class="custom-control-input health-14" id="other-disease-u">
																	<label for="other-disease-u" class="custom-control-label">&nbsp;</label>
																</div>
															</td>
														</tr>
													</tbody>
												</table>
											</div>
										</div>
									</div>
								</div><!-- bd-callout -->
							</div><!-- card body -->
						</div><!-- card -->
						<div class="card">
							<div class="card-body">
								<div class="bd-callout bd-callout-custom-5">
									<h1>3. ประวัติเสี่ยง</h1>
									<div class="form-row">
										<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 mb-3">
											<table class="table">
												<thead class="bg-warning text-light">
													<tr>
														<th scope="col">รายการ</th>
														<th scope="col">#</th>
														<th scope="col">#</th>
													</tr>
												</thead>
												<tfoot>
													<tr><td colspan="3">&nbsp;</td></tr>
												</tfoot>
												<tbody>
													<tr id="risk_table_tr1">
														<td>ช่วง 7 วันก่อนป่วยได้สัมผัสสัตว์ปีกป่วย/ตายโดยตรง</td>
														<td class="text-danger">
															<div class="custom-control custom-checkbox">
																<input type="checkbox" name="contactPoultry7Input" value="n" class="custom-control-input risk-1" id="pet_touch_n">
																<label for="pet_touch_n" class="custom-control-label normal-label">ไม่ใช่</label>
															</div>
														</td>
														<td class="text-success">
															<div class="custom-control custom-checkbox">
																<input type="checkbox" name="contactPoultry7Input" value="y" class="custom-control-input risk-1" id="pet_touch_y">
																<label for="pet_touch_y" class="custom-control-label normal-label">ใช่</label>
															</div>
														</td>
													</tr>
													<tr id="risk_table_tr2">
														<td>
															<div class="form-group row mt-0 mb-0">
																<div class="col-xs-10 col-sm-10 col-md-10 col-lg-10 col-xl-10">
																	<div class="input-group">
																		<label for="pet_touch_range" class="font-normal">ช่วง 14 วันก่อนป่วยได้สัมผัสสัตว์ป่วยโดยตรงหรือไม่ ระบุชนิดสัตว์</label>
																		<input type="text" name="contactPoultry14SpecifyInput" class="form-control form-control-sm ml-2" id="pet_touch_name" disabled>
																	</div>
																</div>
															</div>
														</td>
														<td class="text-danger">
															<div class="custom-control custom-checkbox">
																<input type="checkbox" name="contactPoultry14Input" value="n" class="custom-control-input risk-2" id="pet_touch_direct_n">
																<label for="pet_touch_direct_n" class="custom-control-label normal-label">ไม่ใช่</label>
															</div>
														</td>
														<td class="text-success">
															<div class="custom-control custom-checkbox">
																<input type="checkbox" name="contactPoultry14Input" value="y" class="custom-control-input risk-2" id="pet_touch_direct_y">
																<label for="pet_touch_direct_y" class="custom-control-label normal-label">ใช่</label>
															</div>
														</td>
													</tr>
													<tr id="risk_table_tr3">
														<td>ช่วง 14 วันก่อนป่วยได้พักอาศัยอยู่ในพื้นที่ที่มีสัตว์ปีกป่วย/ตายผิดปกติ</td>
														<td class="text-danger">
															<div class="custom-control custom-checkbox">
																<input type="checkbox" name="stayPoultry14Input" value="n" class="custom-control-input risk-3" id="stay_pet_death_n">
																<label for="stay_pet_death_n" class="custom-control-label normal-label">ไม่ใช่</label>
															</div>
														</td>
														<td class="text-success">
															<div class="custom-control custom-checkbox">
																<input type="checkbox" name="stayPoultry14Input" value="y" class="custom-control-input risk-3" id="stay_pet_death_y">
																<label for="stay_pet_death_y" class="custom-control-label normal-label">ใช่</label>
															</div>
														</td>
													</tr>
													<tr id="risk_table_tr4">
														<td>
															<div class="form-group row mt-0 mb-0">
																<div class="col-xs-10 col-sm-10 col-md-10 col-lg-10 col-xl-10">
																	<div class="input-group">
																		<label for="stay_outbreak" class="font-normal">ช่วง 14 วันก่อนป่วยได้พักอาศัยอยู่หรือเดินทางมาจากพื้นที่ที่ไข้หวัดใหญ่/ปอดอักเสบระบาด <span class="text-info">ระบุพื้นที่</span></label>
																		<input type="text" name="stayFlu14PlaceSpecifyInput" class="form-control form-control-sm ml-2" id="stay_outbreak_input" disabled>
																	</div>
																</div>
															</div>
														</td>
														<td class="text-danger">
															<div class="custom-control custom-checkbox">
																<input type="checkbox" name="stayFlu14Input" value="n" class="custom-control-input risk-4" id="stay_outbreak_n">
																<label for="stay_outbreak_n" class="custom-control-label normal-label">ไม่ใช่</label>
															</div>
														</td>
														<td class="text-success">
															<div class="custom-control custom-checkbox">
																<input type="checkbox" name="stayFlu14Input" value="y" class="custom-control-input risk-4" id="stay_outbreak_y">
																<label for="stay_outbreak_y" class="custom-control-label normal-label">ใช่</label>
															</div>
														</td>
													</tr>
													<tr id="risk_table_tr5">
														<td>ช่วง 14 วันก่อนป่วยได้ดูแลหรือสัมผัสใกล้ชิดกับผู้ป่วยอาการคล้ายไข้หวัดใหญ่/ปอดอักเสบ</td>
														<td class="text-danger">
															<div class="custom-control custom-checkbox">
																<input type="checkbox" name="contactFlu14Input" value="n" class="custom-control-input risk-5" id="close_up_n">
																<label for="close_up_n" class="custom-control-label normal-label">ไม่ใช่</label>
															</div>
														</td>
														<td class="text-success">
															<div class="custom-control custom-checkbox">
																<input type="checkbox" name="contactFlu14Input" value="y" class="custom-control-input risk-5" id="close_up_y">
																<label for="close_up_y" class="custom-control-label normal-label">ใช่</label>
															</div>
														</td>
													</tr>
													<tr id="risk_table_tr6">
														<td>ช่วง 14 วันก่อนป่วยไปเยี่ยมผู้ป่วยไข้หวัดใหญ่/ปอดอักเสบ</td>
														<td class="text-danger">
															<div class="custom-control custom-checkbox">
																<input type="checkbox" name="visitFlu14Input" value="n" class="custom-control-input risk-6" id="patient_visit_n">
																<label for="patient_visit_n" class="custom-control-label normal-label">ไม่ใช่</label>
															</div>
														</td>
														<td class="text-success">
															<div class="custom-control custom-checkbox">
																<input type="checkbox" name="visitFlu14Input" value="y" class="custom-control-input risk-6" id="patient_visit_y">
																<label for="patient_visit_y" class="custom-control-label normal-label">ใช่</label>
															</div>
														</td>
													</tr>
													<tr id="risk_table_tr7">
														<td>เป็นบุคลากรทางการแพทย์และสาธารณสุขหรือเจ้าหน้าที่ห้องปฏิบัติการ</td>
														<td class="text-danger">
															<div class="custom-control custom-checkbox">
																<input type="checkbox" name="healthcareWorkerInput" value="n" class="custom-control-input risk-7" id="healthcare_n">
																<label for="healthcare_n" class="custom-control-label normal-label">ไม่ใช่</label>
															</div>
														</td>
														<td class="text-success">
															<div class="custom-control custom-checkbox">
																<input type="checkbox" name="healthcareWorkerInput" value="y" class="custom-control-input risk-7" id="healthcare_y">
																<label for="healthcare_y" class="custom-control-label normal-label">ใช่</label>
															</div>
														</td>
													</tr>
													<tr id="risk_table_tr8">
														<td>เป็นผู้ป่วยสงสัยไข้หวัดใหญ่/ปอดอักเสบ ที่เข้ารับการรักษาเป็นกลุ่มก้อน</td>
														<td class="text-danger">
															<div class="custom-control custom-checkbox">
																<input type="checkbox" name="suspectFluInput" value="n" class="custom-control-input risk-8" id="suspect_patient_n">
																<label for="suspect_patient_n" class="custom-control-label normal-label">ไม่ใช่</label>
															</div>
														</td>
														<td class="text-success">
															<div class="custom-control custom-checkbox">
																<input type="checkbox" name="suspectFluInput" value="y" class="custom-control-input risk-8" id="suspect_patient_y">
																<label for="suspect_patient_y" class="custom-control-label normal-label">ใช่</label>
															</div>
														</td>
													</tr>
													<tr id="risk_table_tr9">
														<td>
															<div class="form-group row mt-0 mb-0">
																<div class="col-xs-10 col-sm-10 col-md-10 col-lg-10 col-xl-10">
																	<div class="input-group">
																		<label for="other_risk" class="font-normal">อื่นๆ ระบุ</label>
																		<input type="text" name="otherRiskInputSpecify" class="form-control form-control-sm ml-2" id="other_risk_input" disabled style="width:400px;">
																	</div>
																</div>
															</div>
														</td>
														<td class="text-danger">
															<div class="custom-control custom-checkbox">
																<input type="checkbox" name="otherRiskInput" value="n" class="custom-control-input risk-9" id="other_risk_n">
																<label for="other_risk_n" class="custom-control-label normal-label">ไม่ใช่</label>
															</div>
														</td>
														<td class="text-success">
															<div class="custom-control custom-checkbox">
																<input type="checkbox" name="otherRiskInput" value="y" class="custom-control-input risk-9" id="other_risk_y">
																<label for="other_risk_y" class="custom-control-label normal-label">ใช่</label>
															</div>
														</td>
													</tr>
												</tbody>
											</table>
										</div>
									</div>
									<div class="row">
										<div class="form-row">
											<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 mb-3">
												<label for="treatment">ผลการรักษา</label>
												<div>
													<div class="custom-control custom-checkbox custom-control-inline">
														<input type="checkbox" name="resultCliInput" value="cured" class="custom-control-input treatment-1" id="treatment_cured">
														<label for="treatment_cured" class="custom-control-label normal-label">หาย</label>
													</div>
													<div class="custom-control custom-checkbox custom-control-inline">
														<input type="checkbox" name="resultCliInput" value="treat" class="custom-control-input treatment-1" id="treatment_treat">
														<label for="treatment_treat" class="custom-control-label normal-label">อยู่ระหว่างการรักษา</label>
													</div>
													<div class="custom-control custom-checkbox custom-control-inline" style="width:340px">
														<input type="checkbox" name="resultCliInput" value="refer" class="custom-control-input treatment-1" id="treatment_refer">
														<label for="treatment_refer" class="custom-control-label normal-label">ส่งต่อไปรักษาที่</label>
														<input type="text" name="resultCliReferInput" class="form-control form-control-sm ml-2" disabled id="treatment_refer_at" style="width:200px">
													</div>
													<div class="custom-control custom-checkbox custom-control-inline">
														<input type="checkbox" name="resultCliInput" value="dead" class="custom-control-input treatment-1" id="treatment_dead">
														<label for="treatment_dead" class="custom-control-label normal-label">เสียชีวิต</label>
													</div>
													<div class="custom-control custom-checkbox custom-control-inline">
														<input type="checkbox" name="resultCliInput" value="unknown" class="custom-control-input treatment-1" id="treatment_unknown">
														<label for="treatment_unknown" class="custom-control-label normal-label">ไม่ทราบ</label>
													</div>
												</div>
											</div>
										</div>
									</div>
								</div><!-- bd-callout -->
							</div><!-- card body -->
						</div><!-- card -->
						<div class="card">
							<div class="card-body border-top">
								<div>
									<div class="form-row">
										<div class="col-xs-12 col-sm-12 col-md-6 col-lg-2 col-xl-2 mb-3">
											<label for="report_date">วันที่รายงาน</label>
											<div class="input-group date" data-provide="datepicke" id="report_date">
												<div class="input-group">
													<input type="text" name="reportDateInput" class="form-control" required>
													<div class="input-group-append">
														<span class="input-group-text"><i class="mdi mdi-calendar"></i></span>
													</div>
												</div>
											</div>
										</div>
										<div class="col-xs-12 col-sm-12 col-md-6 col-lg-4 col-xl-4 mb-3">
											<label for="user_hospital">หน่วยงาน/โรงพยาบาล</label>
											@role('admin')
												<input type="text" name="userHospitalInput" value="{{ $patient[0]->ref_user_hospcode }}" class="form-control" readonly>
											@endrole
											@role('hospital|lab')
												<input type="text" name="userHospitalInput" value="{{ $patient[0]->ref_user_hospcode }}" class="form-control" readonly>
											@endrole
										</div>
									</div>
									<div class="form-row">
										<div class="col-xs-12 col-sm-12 col-md-6 col-lg-4 col-xl-4 mb-3">
											<label for="firstNameInput">ผู้รายงาน</label>
											<input type="hidden" name="userIdInput" value="{{ auth()->user()->id }}">
											<input type="text" name="userInput" value="{{ auth()->user()->name . ' ' . auth()->user()->lastname }}" class="form-control" id="first_name_input" readonly>
										</div>
										<div class="col-xs-12 col-sm-12 col-md-6 col-lg-4 col-xl-4 mb-3">
											<label for="user_phone">โทรศัพท์</label>
											<input type="text" name="userPhoneInput" class="form-control" placeholder="Phone" readonly>
										</div>
									</div>
								</div>
							</div><!-- card body -->
						</div><!-- card -->
						<div class="border-top">
							<div class="card-body">
								<button type="submit" class="btn btn-primary">Save</button>
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
<script src="{{ URL::asset('assets/libs/jquery-blockUI/jquery.blockUI.js') }}"></script>
<script src="{{ URL::asset('assets/libs/bootstrap-select-1.13.9/dist/js/bootstrap-select.min.js') }}"></script>
<script src="{{ URL::asset('assets/libs/bootstrap-validate-2.2.0/dist/bootstrap-validate.js') }}"></script>
<script src="{{ URL::asset('assets/libs/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js') }}"></script>
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
		var id = $('#title_name_input').val();
		if (id === '6') {
			$('#other_title_name_input').val('');
			$('#other_title_name_input').prop('disabled', false);
		} else if (id === '-6') {
			$('#other_title_name_input').val('{{ $cache_title_name[1] }}');

			$('#other_title_name_input').prop('disabled', false);
		} else {
			$('#other_title_name_input').val('');
			$('#other_title_name_input').prop('disabled', true);
		}
	});

	/* date of birth */
	$('#birthDayInput').datepicker({
		format: 'dd/mm/yyyy',
		endDate: '+1d',
		datesDisabled: '+1d',
		todayHighlight: true,
		todayBtn: true,
		autoclose: true
	});

	/* calc age year */
	$('#birthDayInput').datepicker().on('changeDate', function(e){
		var
			getDay = new Date(e.date).getDate(),
			getMonth = new Date(e.date).getMonth() + 1,
			getYear = String(e.date).split(" ")[3];
			date = getYear + '-' + getMonth + '-' + getDay,
			birthday = new Date(date),
			today = new Date(),
			ageInMilliseconds = new Date(today - birthday),
			years = ageInMilliseconds / (24 * 60 * 60 * 1000 * 365.25 ),
			months = 12 * (years % 1),
			days = Math.floor(30 * (months % 1));
			$('#age_year_input').val(Math.floor(years));
			$('#age_month_input').val(Math.floor(months));
			$('#age_day_input').val(Math.floor(days));
	});

	/* nationallity */
	$('#select_nationality').change(function() {
		var id = $('#select_nationality').val();
		if (id === '11') {
			$('#other_nationality_input').prop('disabled', false);
		} else {
			$('#other_nationality_input').val('');
			$('#other_nationality_input').prop('disabled', true);
		}
	});

	/* district */
	$('#select_province').change(function() {
		if ($(this).val() != '') {
			var id = $(this).val();
			$.ajax({
				method: "POST",
				url: "{{ route('districtFetch') }}",
				dataType: "HTML",
				data: {id:id},
				success: function(response) {
					$('#select_district').html(response);
					$('#select_district').selectpicker("refresh");
				},
				error: function(jqXhr, textStatus, errorMessage){
					alert('Error code: ' + jqXhr.status + errorMessage);
				}
			});
		}
	});

	/* sub district */
	$('#select_district').change(function() {
		if ($(this).val() != '') {
			var id = $(this).val();
			$.ajax({
				method: "POST",
				url: "{{ route('subDistrictFetch') }}",
				dataType: "HTML",
				data: {id:id},
				success: function(response) {
					$('#select_sub_district').html(response);
					$('#select_sub_district').selectpicker("refresh");
				},
				error: function(jqXhr, textStatus, errorMessage){
					alert('Error code: ' + jqXhr.status + errorMessage);
				}
			});
		}
	});

	/* select occupation */
	$('#select_occupation').change(function() {
		var id = $('#select_occupation').val();
		if (id === '14') {
			$('#occupation_other_input').prop('disabled', false);
		} else {
			$('#occupation_other_input').val('');
			$('#occupation_other_input').prop('disabled', true);
		}
	});

	/* *************** Clinical ***************** */
	/* patient type */
	$('.pt-type').click(function() {
		$('.pt-type').not(this).prop('checked', false);
	});

	/* sick date input */
	$('#sickDateInput').datepicker({
		format: 'dd/mm/yyyy',
		todayHighlight: true,
		todayBtn: true,
		autoclose: true
	});

	/* treat date input */
	$('#treatDateInput').datepicker({
		format: 'dd/mm/yyyy',
		todayHighlight: true,
		todayBtn: true,
		autoclose: true
	});


	/* admit date input */
	$('#admitDateInput').datepicker({
		format: 'dd/mm/yyyy',
		todayHighlight: true,
		todayBtn: true,
		autoclose: true
	});

	/* symptoms */
	@php
	$symptoms->each(function ($item, $key) {
		echo "
			$('.symptom-".$item->id."').click(function() {
				$('.symptom-".$item->id."').not(this).prop('checked', false);
				var number = $('.symptom-".$item->id."').filter(':checked').length;
				var symp = $('.symptom-".$item->id."').filter(':checked').val();
				if (number === 1) {
					var hasClass = $('#symptoms_table_tr".$item->id."').hasClass('highlight');
					if (!hasClass) {
						$('#symptoms_table_tr".$item->id."').addClass('highlight');
					}
				} else {
					$('#symptoms_table_tr".$item->id."').removeClass('highlight');
				}
				if (symp === 'y') {
					$('#symptom_other').prop('disabled', false);
				} else {
					$('#symptom_other').prop('disabled', true);
				}
			});
		\n";
	});
	@endphp


	/* xrayh check */
	$('input.lungXray').on('change', function() {
		$('input.lungXray').not(this).prop('checked', false);
		$('#xRayDate').val('');
		$('#xRayRs').val('');
		if ($('#lungXrayYes').prop('checked') == true) {
			$('#xRayDate').prop('disabled', false);
			$('#xRayRs').prop('disabled', false);
		} else {
			$('#xRayDate').prop('disabled', true);
			$('#xRayRs').prop('disabled', true);
		}
	});

	/* xray date input */
	$('#xRayDateInput').datepicker({
		format: 'dd/mm/yyyy',
		todayHighlight: true,
		todayBtn: true,
		autoclose: true
	});

	/* cbc date input */
	$('#cbcDateInput').datepicker({
		format: 'dd/mm/yyyy',
		todayHighlight: true,
		todayBtn: true,
		autoclose: true
	});

	/* influ Rapid test */
	$('.influRapid').on('change', function() {
		$('.influRapid').not(this).prop('checked', false);
		$('#influRapidTestName').val('');
		if ($('#influRaidCheckd').prop('checked') == true) {
			$('#influRapidTestName').prop('disabled', false);
		} else {
			$('#influRapidTestName').prop('disabled', true);
		}
	});

	/* influ Rapid Result */
	$('input.influRapidRs').on('change', function() {
		$('input.influRapidRs').not(this).prop('checked', false);
	});

	/* influ Vaccine */
	$('.influVaccineRc').on('change', function() {
		$('.influVaccineRc').not(this).prop('checked', false);
		$('#influVaccineDate').val('');
		if ($('#influVaccineYes').prop('checked') == true) {
			$('#influVaccineDate').prop('disabled', false);
		} else {
			$('#influVaccineDate').prop('disabled', true);
		}
	});

	/* vaccine receive date input */
	$('#influVaccineDateInput').datepicker({
		format: 'dd/mm/yyyy',
		todayHighlight: true,
		todayBtn: true,
		autoclose: true
	});

	/* influ Rapid Result */
	$('input.virusMedic').on('change', function() {
		$('input.virusMedic').not(this).prop('checked', false);
		$('#medicineName').val('');
		$('#medicineDate').val('');
		if ($('#virusMedicineYes').prop('checked') == true) {
			$('#medicineName').prop('disabled', false);
			$('#medicineDate').prop('disabled', false);
		} else {
			$('#medicineName').prop('disabled', true);
			$('#medicineDate').prop('disabled', true);
		}
	});

	/* medicine date input */
	$('#medicineGiveDateInput').datepicker({
		format: 'dd/mm/yyyy',
		todayHighlight: true,
		todayBtn: true,
		autoclose: true
	});

	/* health tbl */

	$('.health-1').click(function() {
		$('.health-1').not(this).prop('checked', false);
		let number = $('.health-1').filter(':checked').length;
		if (number == 1) {
			let hasClass = $('#health_table_tr1').hasClass('highlight');
			if (!hasClass) {
				$('#health_table_tr1').addClass('highlight');
			}
		} else {
			$('#health_table_tr1').removeClass('highlight');
		}
		if ($('#pregnant_age_y').prop('checked') == true) {
			$('#pregnant_age_week').prop('disabled', false);
		} else {
			$('#pregnant_age_week').val('0');
			$('#pregnant_age_week').prop('disabled', true);
		}
	});

	$('.health-2').click(function() {
		$('.health-2').not(this).prop('checked', false);
		let number = $('.health-2').filter(':checked').length;
		if (number == 1) {
			let hasClass = $('#health_table_tr2').hasClass('highlight');
			if (!hasClass) {
				$('#health_table_tr2').addClass('highlight');
			}
		} else {
			$('#health_table_tr2').removeClass('highlight');
		}
	});

	$('.health-3').click(function() {
		$('.health-3').not(this).prop('checked', false);
		let number = $('.health-3').filter(':checked').length;
		if (number == 1) {
			let hasClass = $('#health_table_tr3').hasClass('highlight');
			if (!hasClass) {
				$('#health_table_tr3').addClass('highlight');
			}
		} else {
			$('#health_table_tr3').removeClass('highlight');
		}
		if ($('#fat-input-y').prop('checked') == true) {
			$('#fat-height-input').prop('disabled', false);
			$('#fat-weight-input').prop('disabled', false);
		} else {
			$('#fat-height-input').val('0');
			$('#fat-weight-input').val('0');
			$('#fat-height-input').prop('disabled', true);
			$('#fat-weight-input').prop('disabled', true);
		}
	});

	$('.health-4').click(function() {
		$('.health-4').not(this).prop('checked', false);
		let number = $('.health-4').filter(':checked').length;
		if (number == 1) {
			let hasClass = $('#health_table_tr4').hasClass('highlight');
			if (!hasClass) {
				$('#health_table_tr4').addClass('highlight');
			}
		} else {
			$('#health_table_tr4').removeClass('highlight');
		}
	});

	$('.health-5').click(function() {
		$('.health-5').not(this).prop('checked', false);
		let number = $('.health-5').filter(':checked').length;
		if (number == 1) {
			let hasClass = $('#health_table_tr5').hasClass('highlight');
			if (!hasClass) {
				$('#health_table_tr5').addClass('highlight');
			}
		} else {
			$('#health_table_tr5').removeClass('highlight');
		}
		if ($('#immune-y').prop('checked') == true) {
			$('#immune_specify').prop('disabled', false);
		} else {
			$('#immune_specify').val('');
			$('#immune_specify').prop('disabled', true);
		}
	});

	$('.health-6').click(function() {
		$('.health-6').not(this).prop('checked', false);
		let number = $('.health-6').filter(':checked').length;
		if (number == 1) {
			let hasClass = $('#health_table_tr6').hasClass('highlight');
			if (!hasClass) {
				$('#health_table_tr6').addClass('highlight');
			}
		} else {
			$('#health_table_tr6').removeClass('highlight');
		}
		if ($('#preterm-infant-y').prop('checked') == true) {
			$('#preterm-infant-week').prop('disabled', false);
		} else {
			$('#preterm-infant-week').val('0');
			$('#preterm-infant-week').prop('disabled', true);
		}
	});

	$('.health-7').click(function() {
		$('.health-7').not(this).prop('checked', false);
		let number = $('.health-7').filter(':checked').length;
		if (number == 1) {
			let hasClass = $('#health_table_tr7').hasClass('highlight');
			if (!hasClass) {
				$('#health_table_tr7').addClass('highlight');
			}
		} else {
			$('#health_table_tr7').removeClass('highlight');
		}
	});

	$('.health-8').click(function() {
		$('.health-8').not(this).prop('checked', false);
		let number = $('.health-8').filter(':checked').length;
		if (number == 1) {
			let hasClass = $('#health_table_tr8').hasClass('highlight');
			if (!hasClass) {
				$('#health_table_tr8').addClass('highlight');
			}
		} else {
			$('#health_table_tr8').removeClass('highlight');
		}
	});

	$('.health-9').click(function() {
		$('.health-9').not(this).prop('checked', false);
		let number = $('.health-9').filter(':checked').length;
		if (number == 1) {
			let hasClass = $('#health_table_tr9').hasClass('highlight');
			if (!hasClass) {
				$('#health_table_tr9').addClass('highlight');
			}
		} else {
			$('#health_table_tr9').removeClass('highlight');
		}
	});

	$('.health-10').click(function() {
		$('.health-10').not(this).prop('checked', false);
		let number = $('.health-10').filter(':checked').length;
		if (number == 1) {
			let hasClass = $('#health_table_tr10').hasClass('highlight');
			if (!hasClass) {
				$('#health_table_tr10').addClass('highlight');
			}
		} else {
			$('#health_table_tr10').removeClass('highlight');
		}
	});

	$('.health-11').click(function() {
		$('.health-11').not(this).prop('checked', false);
		let number = $('.health-11').filter(':checked').length;
		if (number == 1) {
			let hasClass = $('#health_table_tr11').hasClass('highlight');
			if (!hasClass) {
				$('#health_table_tr11').addClass('highlight');
			}
		} else {
			$('#health_table_tr11').removeClass('highlight');
		}
	});

	$('.health-12').click(function() {
		$('.health-12').not(this).prop('checked', false);
		let number = $('.health-12').filter(':checked').length;
		if (number == 1) {
			let hasClass = $('#health_table_tr12').hasClass('highlight');
			if (!hasClass) {
				$('#health_table_tr12').addClass('highlight');
			}
		} else {
			$('#health_table_tr12').removeClass('highlight');
		}
	});

	$('.health-13').click(function() {
		$('.health-13').not(this).prop('checked', false);
		let number = $('.health-13').filter(':checked').length;
		if (number == 1) {
			let hasClass = $('#health_table_tr13').hasClass('highlight');
			if (!hasClass) {
				$('#health_table_tr13').addClass('highlight');
			}
		} else {
			$('#health_table_tr13').removeClass('highlight');
		}
		if ($('#cancer-y').prop('checked') == true) {
			$('#cancer-input').prop('disabled', false);
		} else {
			$('#cancer-input').val('');
			$('#cancer-input').prop('disabled', true);
		}
	});

	$('.health-14').click(function() {
		$('.health-14').not(this).prop('checked', false);
		let number = $('.health-14').filter(':checked').length;
		if (number == 1) {
			let hasClass = $('#health_table_tr14').hasClass('highlight');
			if (!hasClass) {
				$('#health_table_tr14').addClass('highlight');
			}
		} else {
			$('#health_table_tr14').removeClass('highlight');
		}
		if ($('#other-disease-y').prop('checked') == true) {
			$('#other-disease-input').prop('disabled', false);
		} else {
			$('#other-disease-input').val('');
			$('#other-disease-input').prop('disabled', true);
		}
	});

	/* risk-hostory */
	$('.risk-1').click(function() {
		$('.risk-1').not(this).prop('checked', false);
		let number = $('.risk-1').filter(':checked').length;
		if (number == 1) {
			let hasClass = $('#risk_table_tr1').hasClass('highlight');
			if (!hasClass) {
				$('#risk_table_tr1').addClass('highlight');
			}
		} else {
			$('#risk_table_tr1').removeClass('highlight');
		}
	});

	$('.risk-2').click(function() {
		$('.risk-2').not(this).prop('checked', false);
		let number = $('.risk-2').filter(':checked').length;
		if (number == 1) {
			let hasClass = $('#risk_table_tr2').hasClass('highlight');
			if (!hasClass) {
				$('#risk_table_tr2').addClass('highlight');
			}
		} else {
			$('#risk_table_tr2').removeClass('highlight');
		}
		if ($('#pet_touch_direct_y').prop('checked') == true) {
			$('#pet_touch_name').prop('disabled', false);
		} else {
			$('#pet_touch_name').val('');
			$('#pet_touch_name').prop('disabled', true);
		}
	});

	$('.risk-3').click(function() {
		$('.risk-3').not(this).prop('checked', false);
		let number = $('.risk-3').filter(':checked').length;
		if (number == 1) {
			let hasClass = $('#risk_table_tr3').hasClass('highlight');
			if (!hasClass) {
				$('#risk_table_tr3').addClass('highlight');
			}
		} else {
			$('#risk_table_tr3').removeClass('highlight');
		}
	});

	$('.risk-4').click(function() {
		$('.risk-4').not(this).prop('checked', false);
		let number = $('.risk-4').filter(':checked').length;
		if (number == 1) {
			let hasClass = $('#risk_table_tr4').hasClass('highlight');
			if (!hasClass) {
				$('#risk_table_tr4').addClass('highlight');
			}
		} else {
			$('#risk_table_tr4').removeClass('highlight');
		}
		if ($('#stay_outbreak_y').prop('checked') == true) {
			$('#stay_outbreak_input').prop('disabled', false);
		} else {
			$('#stay_outbreak_input').val('');
			$('#stay_outbreak_input').prop('disabled', true);
		}
	});

	$('.risk-5').click(function() {
		$('.risk-5').not(this).prop('checked', false);
		let number = $('.risk-5').filter(':checked').length;
		if (number == 1) {
			let hasClass = $('#risk_table_tr5').hasClass('highlight');
			if (!hasClass) {
				$('#risk_table_tr5').addClass('highlight');
			}
		} else {
			$('#risk_table_tr5').removeClass('highlight');
		}
	});

	$('.risk-6').click(function() {
		$('.risk-6').not(this).prop('checked', false);
		let number = $('.risk-6').filter(':checked').length;
		if (number == 1) {
			let hasClass = $('#risk_table_tr6').hasClass('highlight');
			if (!hasClass) {
				$('#risk_table_tr6').addClass('highlight');
			}
		} else {
			$('#risk_table_tr6').removeClass('highlight');
		}
	});

	$('.risk-7').click(function() {
		$('.risk-7').not(this).prop('checked', false);
		let number = $('.risk-7').filter(':checked').length;
		if (number == 1) {
			let hasClass = $('#risk_table_tr7').hasClass('highlight');
			if (!hasClass) {
				$('#risk_table_tr7').addClass('highlight');
			}
		} else {
			$('#risk_table_tr7').removeClass('highlight');
		}
	});

	$('.risk-8').click(function() {
		$('.risk-8').not(this).prop('checked', false);
		let number = $('.risk-8').filter(':checked').length;
		if (number == 1) {
			let hasClass = $('#risk_table_tr8').hasClass('highlight');
			if (!hasClass) {
				$('#risk_table_tr8').addClass('highlight');
			}
		} else {
			$('#risk_table_tr8').removeClass('highlight');
		}
	});

	$('.risk-9').click(function() {
		$('.risk-9').not(this).prop('checked', false);
		let number = $('.risk-9').filter(':checked').length;
		if (number == 1) {
			let hasClass = $('#risk_table_tr9').hasClass('highlight');
			if (!hasClass) {
				$('#risk_table_tr9').addClass('highlight');
			}
		} else {
			$('#risk_table_tr9').removeClass('highlight');
		}
		if ($('#other_risk_y').prop('checked') == true) {
			$('#other_risk_input').prop('disabled', false);
		} else {
			$('#other_risk_input').val('');
			$('#other_risk_input').prop('disabled', true);
		}
	});

	/* treatment */
	$('.treatment-1').click(function() {
		$('.treatment-1').not(this).prop('checked', false);
		if ($('#treatment_refer').prop('checked') == true) {
			$('#treatment_refer_at').prop('disabled', false);
		} else {
			$('#treatment_refer_at').val('');
			$('#treatment_refer_at').prop('disabled', true);
		}
	});

	/* report date input */
	$('#report_date').datepicker({
		format: 'dd/mm/yyyy',
		todayHighlight: true,
		todayBtn: true,
		autoclose: true
	});
	$('#report_date').datepicker('update', new Date());
});
</script>
@endsection
