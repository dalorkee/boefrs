@extends('layouts.index')
@section('custom-style')
<link rel="stylesheet" type="text/css" href="{{ URL::asset('public/assets/libs/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css') }}">
<link rel="stylesheet" type="text/css" href="{{ URL::asset('public/assets/libs/bootstrap-select-1.13.9/dist/css/bootstrap-select.min.css') }}">
<link rel="stylesheet" type="text/css" href="{{ URL::asset('public/assets/libs/toastr/build/toastr.min.css') }}">
@endsection
@section('internal-style')
<style></style>
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
										<img src="{{ URL::asset('public/qrcode/6910U124720191022.png') }}" />
									</div>
									<h1 class="text-info">1. ข้อมูลทั่วไปของผู้ป่วย</h1>
									<div class="form-row">
										<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 mb-3">
											<label for="formCode">รหัสแบบฟอร์ม</label>
											<div class="input-group-append">
												<span class="btn btn-primary btn-sm">{{ $patient[0]->lab_code }}</span>
												{{ csrf_field() }}
												<input type="hidden" name="formIndexInput" class="form-control" id="form_index_input" value="{{ $patient[0]->lab_code }}" readonly required>
											</div>
										</div>
									</div>
									<div class="form-row">
										<div class="col-xs-12 col-sm-12 col-md-6 col-lg-4 col-xl-4 mb-3">
											<label for="titleName">คำนำหน้าชื่อ</label>
											<input type="hidden" name="title_name_cache" value="{{ $patient[0]->title_name }}">
											<select name="titleNameInput" class="form-control selectpicker show-tick select-title-name" id="title_name_input">
											@php
												if ($patient[0]->title_name == 6) {
													$cache_title_name = array( '-6', $patient[0]->title_name_other);
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
										</div>
										<div class="col-xs-12 col-sm-12 col-md-6 col-lg-4 col-xl-4 mb-3">
											<label for="otherTitleName">คำนำหน้าชื่ออื่นๆ ระบุ</label>
											@php
												if ($patient[0]->title_name == 6) {
													$title_name_oth_txt = $patient[0]->title_name_other;
													$disbled = null;
												} else {
													$title_name_oth_txt = null;
													$disbled = 'disbled';
												}
											@endphp
												<input type="text" name="otherTitleNameInput" class="form-control" id="other_title_name_input" placeholder="คำนำหน้าชื่ออื่นๆ" value="{{ $title_name_oth_txt }}" {{ $disbled }}>
										</div>
									</div>
									<div class="form-row">
										<div class="col-xs-12 col-sm-12 col-md-6 col-lg-4 col-xl-4 mb-3">
											<label for="firstName">ชื่อจริง</label>
											<input type="text" name="firstNameInput" class="form-control" id="first_name_input" placeholder="ชื่อ" value="{{ $patient[0]->first_name }}" required>
											<div class="valid-feedback">Looks good!</div>
										</div>
										<div class="col-xs-12 col-sm-12 col-md-6 col-lg-4 col-xl-4 mb-3">
											<label for="lastName">นามสกุล</label>
											<input type="text" name="lastNameInput" class="form-control" id="last_name_input" placeholder="นามสกุล" value="{{ $patient[0]->last_name }}" required>
											<div class="valid-feedback">Looks good!</div>
										</div>
									</div>
									<div class="form-row">
										<div class="col-xs-12 col-sm-12 col-md-6 col-lg-2 col-xl-2 mb-3">
											<label for="HN">HN</label>
											<input type="text" name="hnInput" class="form-control" id="hn_input" placeholder="HN" value="{{ $patient[0]->hn }}" required>
											<div class="valid-feedback">Looks good!</div>
										</div>
										<div class="col-xs-12 col-sm-12 col-md-6 col-lg-2 col-xl-2 mb-3">
											<label for="AN">AN</label>
											<input type="text" name="anInput" class="form-control" id="an_input" placeholder="AN" value="{{ $patient[0]->an }}">
											<div class="valid-feedback">Looks good!</div>
										</div>
									</div>
									<div class="form-row">
										<div class="col-xs-12 col-sm-12 col-md-6 col-lg-2 col-xl-2 mb-3">
											<label for="sex">เพศ</label>
											<select name="sexInput" class="custom-select">
												<option value="null">-- โปรดเลือก --</option>
												<option value="male">ชาย</option>
												<option value="female">หญิง</option>
											</select>
										</div>
										<div class="col-xs-12 col-sm-12 col-md-6 col-lg-2 col-xl-2 mb-3">
											<label for="birthDate">ว/ด/ป เกิด</label>
											<div class="input-group date" data-provide="datepicker" id="birthDateInput">
												<div class="input-group">
													<input type="text" name="birthDateInput" class="form-control" required>
													<div class="input-group-append">
														<span class="input-group-text"><i class="mdi mdi-calendar"></i></span>
													</div>
												</div>
											</div>
										</div>
										<div class="col-xs-12 col-sm-12 col-md-4 col-lg-1 col-xl-1 mb-3">
											<label for="ageYear">อายุ/ปี</label>
											<input type="number" name="ageYearInput" class="form-control" id="age_year_input" value="0" min="0" max="120" required>
										</div>
										<div class="col-xs-12 col-sm-12 col-md-4 col-lg-1 col-xl-1 mb-3">
											<label for="ageMonth">อายุ/เดือน</label>
											<input type="number" name="ageMonthInput" class="form-control" id="age_month_input" value="0" min="0" max="12" required>
										</div>
									</div>
									<div class="form-row">
										<div class="col-xs-12 col-sm-12 col-md-6 col-lg-2 col-xl-2 mb-3">
											<label for="nationality">สัญชาติ</label>
											<select name="nationalityInput" class="custom-select" id="select_nationality">
												<option value="0">-- โปรดเลือก --</option>
												@foreach ($nationality as $key => $value)
													<option value="{{ $value->id }}">{{ $value->name_th }}</option>
												@endforeach
											</select>
										</div>
										<div class="col-xs-12 col-sm-12 col-md-4 col-lg-2 col-xl-2 mb-3">
											<label for="otherNationality">สัญชาติ อื่นๆ ระบุ</label>
											<input type="text" name="otherNationalityInput" class="form-control" id="other_nationality_input" placeholder="สัญชาติอื่นๆ" disabled>
										</div>
									</div>
									<div class="form-row">
										<div class="col-xs-12 col-sm-12 col-md-6 col-lg-4 col-xl-4 mb-3">
											<label for="hospital">โรงพยาบาล</label>
											<input type="text" name="hospitalInput" class="form-control" value="{{ $patient[0]->hospcode }}" placeholder="โรงพยาบาล" required readonly>
										</div>
									</div>
									<div class="form-row">
										<div class="col-xs-12 col-sm-12 col-md-6 col-lg-2 col-xl-2 mb-3">
											<label for="houseNo">ที่อยู่ปัจจุบัน/ขณะป่วย เลขที่</label>
											<input type="text" name="houseNoInput" class="form-control" placeholder="บ้านเลขที่">
										</div>
										<div class="col-xs-12 col-sm-12 col-md-6 col-lg-1 col-xl-1 mb-3">
											<label for="villageNo">หมู่ที่</label>
											<input type="text" name="villageNoInput" class="form-control" placeholder="หมู่ที่">
										</div>
										<div class="col-xs-12 col-sm-12 col-md-6 col-lg-3 col-xl-3 mb-3">
											<label for="village">หมู่บ้าน</label>
											<input type="text" name="villageInput" class="form-control" placeholder="หมู่บ้าน">
										</div>
										<div class="col-xs-12 col-sm-12 col-md-6 col-lg-3 col-xl-3 mb-3">
											<label for="lane">ซอย</label>
											<input type="text" name="laneInput" class="form-control" placeholder="ซอย">
										</div>
									</div>
									<div class="form-row">
										<div class="col-xs-12 col-sm-12 col-md-6 col-lg-2 col-xl-2 mb-3">
											<label for="province">จังหวัด</label>
											<select name="province" class="form-control selectpicker show-tick" id="select_province">
												<option value="0">-- เลือกจังหวัด --</option>
												@php
													$provinces = Session::get('provinces');
													$provinces->each(function ($item, $key) {
														echo "<option value=\"".$item->province_id."\">".$item->province_name."</option>\n";
													});
												@endphp
											</select>
										</div>
										<div class="col-xs-12 col-sm-12 col-md-6 col-lg-2 col-xl-2 mb-3">
											<label for="district">อำเภอ</label>
											<select name="districtInput" class="form-control selectpicker show-tick" id="select_district">
												<option value="0">-- โปรดเลือก --</option>
											</select>
										</div>
										<div class="col-xs-12 col-sm-12 col-md-6 col-lg-2 col-xl-2 mb-3">
											<label for="subDistrict">ตำบล</label>
											<select name="subDistrictInput" class="form-control selectpicker show-tick" id="select_sub_district">
												<option value="0">-- โปรดเลือก --</option>
											</select>
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
										<div class="col-xs-12 col-sm-12 col-md-4 col-lg-4 col-xl-4 mb-3" id="other_occupation_input">
											<label for="occupationOtherInput">อาชีพ อื่นๆ ระบุ</label>
											<input type="text" name="occupationOtherInput" class="form-control" placeholder="อาชีพ อื่นๆ" disabled>
										</div>
									</div>
								</div><!-- bd-callout -->
							</div><!-- card body -->
						</div><!-- card -->
						<div class="card">
							<div class="card-body">
								<div class="bd-callout bd-callout-danger">
									<h1 class="text-danger">2. ข้อมูลทางคลินิก</h1>
									<div class="form-row">
										<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 mb-3">
											<label for="patient">ผู้ป่วย</label>
											<div>
												<div class="custom-control custom-checkbox custom-control-inline">
													<input type="checkbox" name="patientCheckbox" class="custom-control-input ptCheck" id="opdCheckbox">
													<label for="opdCheckbox" class="custom-control-label normal-label">ผู้ป่วยนอก (OPD)/ILI</label>
												</div>
												<div class="custom-control custom-checkbox custom-control-inline">
													<input type="checkbox" name="patientCheckbox" class="custom-control-input ptCheck" id="ipdCheckbox">
													<label for="ipdCheckbox" class="custom-control-label normal-label">ผู้ป่วยใน (IPD)/SARI</label>
												</div>
												<div class="custom-control custom-checkbox custom-control-inline">
													<input type="checkbox" name="patientCheckbox" class="custom-control-input ptCheck" id="icuCheckbox">
													<label for="icuCheckbox" class="custom-control-label normal-label">ผู้ป่วยหนัก/ICU</label>
												</div>
											</div>
										</div>
									</div>
									<div class="form-row">
										<div class="col-xs-12 col-sm-12 col-md-6 col-lg-2 col-xl-2 mb-3">
											<label for="sickDateInput">วันที่เริ่มป่วย</label>
											<div class="input-group date" data-provide="datepicke" id="sickDateInput">
												<div class="input-group">
													<input type="text" name="sickDateInput" class="form-control" required>
													<div class="input-group-append">
														<span class="input-group-text"><i class="mdi mdi-calendar"></i></span>
													</div>
												</div>
											</div>
										</div>
										<div class="col-xs-12 col-sm-12 col-md-6 col-lg-2 col-xl-2 mb-3">
											<label for="treatDateInput">วันที่รักษาครั้งแรก</label>
											<div class="input-group date" data-provide="datepicke" id="treatDateInput">
												<div class="input-group">
													<input type="text" name="treatDateInput" class="form-control" required>
													<div class="input-group-append">
														<span class="input-group-text"><i class="mdi mdi-calendar"></i></span>
													</div>
												</div>
											</div>
										</div>
										<div class="col-xs-12 col-sm-12 col-md-6 col-lg-2 col-xl-2 mb-3">
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
										<div class="col-xs-12 col-sm-12 col-md-6 col-lg-2 col-xl-2 mb-3">
											<label for="sickDateInput">อุณหภูมิร่างกายแรกรับ</label>
											<div class="input-group">
												<input type="number" name="temperatureInput" class="form-control" max="50" min="0" required>
												<div class="input-group-append">
													<span class="input-group-text">C&#176;</span>
												</div>
											</div>
										</div>
									</div>
									<div class="form-row">
										<div class="col-xs-12 col-sm-12 col-md-6 col-lg-12 col-xl-12 mb-3">
											<label for="sickDateInput">อาการและอาการแสดง</label>
											<div class="table-responsive">
												<table class="table" id="symptoms_table">
													<thead class="bg-danger text-light">
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
															if ($item->id == 19) {
																$other_symptom = "<input type=\"text\" name=\"other_symptom\" class=\"form-control\" id=\"symptom_other\" disabled>";
															} else {
																$other_symptom = null;
															}
															echo "<tr id=\"symptoms_table_tr".$item->id."\">";
																echo "<td>".$item->symptom_name_th."&nbsp;&#40;".$item->symptom_name_en."&#41;".$other_symptom."</td>";
																echo "<td>";
																	echo "<div class=\"custom-control custom-checkbox\">";
																		echo "<input type=\"checkbox\" name=\"symptom_".$item->id."_Input\" value=\"N\" class=\"custom-control-input symptom-".$item->id."\" id=\"symptom_".$item->id."_yes\">";
																		echo "<label for=\"symptom_".$item->id."_yes\" class=\"custom-control-label\">&nbsp;</label>";
																	echo "</div>";
																echo "</td>";
																echo "<td>";
																	echo "<div class=\"custom-control custom-checkbox\">";
																		echo "<input type=\"checkbox\" name=\"symptom_".$item->id."_Input\" value=\"N\" class=\"custom-control-input symptom-".$item->id."\" id=\"symptom_".$item->id."_no\">";
																		echo "<label for=\"symptom_".$item->id."_no\" class=\"custom-control-label\"></label>";
																	echo "</div>";
																echo "</td>";
																echo "<td>";
																	echo "<div class=\"custom-control custom-checkbox\">";
																		echo "<input type=\"checkbox\" name=\"symptom_".$item->id."_Input\" value=\"N\" class=\"custom-control-input symptom-".$item->id."\" id=\"symptom_".$item->id."_unknown\">";
																		echo "<label for=\"symptom_".$item->id."_unknown\" class=\"custom-control-label\"></label>";
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
													<input type="checkbox" name="lungXrayInput" class="custom-control-input lungXray" id="lungXrayNo">
													<label for="lungXrayNo" class="custom-control-label normal-label">ไม่ได้ทำ</label>
												</div>
												<div class="custom-control custom-checkbox custom-control-inline">
													<input type="checkbox" name="lungXrayInput" class="custom-control-input lungXray" id="lungXrayYes">
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
													<input type="checkbox" name="influRapidInput" class="custom-control-input influRapid" id="influRapidUnChecked">
													<label for="influRapidUnChecked" class="custom-control-label normal-label">ไม่ตรวจ</label>
												</div>
												<div class="custom-control custom-checkbox custom-control-inline">
													<input type="checkbox" name="influRapidInput" class="custom-control-input influRapid" id="influRaidCheckd">
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
													<input type="checkbox" name="rapidTestResultCheckbox" class="custom-control-input influRapidRs" id="rapidTestNagative">
													<label for="rapidTestNagative" class="custom-control-label normal-label">Nagative</label>
												</div>
												<div class="custom-control custom-checkbox custom-control-inline">
													<input type="checkbox" name="rapidTestResultCheckbox" class="custom-control-input influRapidRs" id="rapidTestPositiveFluA">
													<label for="rapidTestPositiveFluA" class="custom-control-label normal-label">Positive Flu A</label>
												</div>
												<div class="custom-control custom-checkbox custom-control-inline">
													<input type="checkbox" name="rapidTestResultCheckbox" class="custom-control-input influRapidRs" id="rapidTestPositiveFluB">
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
													<input type="checkbox" name="influVaccine" class="custom-control-input influVaccineRc" id="influVaccineNo">
													<label for="influVaccineNo" class="custom-control-label normal-label">ไม่เคย</label>
												</div>
												<div class="custom-control custom-checkbox custom-control-inline">
													<input type="checkbox" name="influVaccine" class="custom-control-input influVaccineRc" id="influVaccineYes">
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
													<input type="checkbox" name="virusMedicine" class="custom-control-input virusMedic" id="virusMedicineNo">
													<label for="virusMedicineNo" class="custom-control-label normal-label">ไม่ให้</label>
												</div>
												<div class="custom-control custom-checkbox custom-control-inline">
													<input type="checkbox" name="virusMedicine" class="custom-control-input virusMedic" id="virusMedicineYes">
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
																			<input type="number" name="pregnant_age" class="form-control" value="0" min="0" max="52" id="pregnant_age_week" disabled>
																			<div class="input-group-append">
																				<span class="input-group-text">สัปดาห์</span>
																			</div>
																		</div>
																	</div>
																</div>
															</td>
															<td>
																<div class="custom-control custom-checkbox">
																	<input type="checkbox" name="pregnant_age_input" value="y" class="custom-control-input health-1" id="pregnant_age_y">
																	<label for="pregnant_age_y" class="custom-control-label">&nbsp;</label>
																</div>
															</td>
															<td>
																<div class="custom-control custom-checkbox">
																	<input type="checkbox" name="pregnant_age_input" value="n" class="custom-control-input health-1" id="pregnant_age_n">
																	<label for="pregnant_age_n" class="custom-control-label">&nbsp;</label>
																</div>
															</td>
															<td>
																<div class="custom-control custom-checkbox">
																	<input type="checkbox" name="pregnant_age_input" value="u" class="custom-control-input health-1" id="pregnant_age_u">
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
																	<input type="checkbox" name="after_give_birth" value="y" class="custom-control-input health-2" id="after_give_birth_y">
																	<label for="after_give_birth_y" class="custom-control-label">&nbsp;</label>
																</div>
															</td>
															<td>
																<div class="custom-control custom-checkbox">
																	<input type="checkbox" name="after_give_birth" value="n" class="custom-control-input health-2" id="after_give_birth_n">
																	<label for="after_give_birth_n" class="custom-control-label">&nbsp;</label>
																</div>
															</td>
															<td>
																<div class="custom-control custom-checkbox">
																	<input type="checkbox" name="after_give_birth" value="u" class="custom-control-input health-2" id="after_give_birth_u">
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
																			<input type="number" name="fat_height_input" class="form-control" min="0" max="250" value="0" id="fat-height-input" disabled>
																			<div class="input-group-append">
																				<span class="input-group-text">cm</span>
																			</div>
																		</div>
																	</div>
																	<label for="fat_weight" class="mt-2 font-normal">น้ำหนัก</label>
																	<div class="col-xs-6 col-sm-6 col-md-4 col-lg-3 col-xl-3">
																		<div class="input-group">
																			<input type="number" name="fat_weight_input" class="form-control" min="0" max="200" value="0" id="fat-weight-input" disabled>
																			<div class="input-group-append">
																				<span class="input-group-text">kg</span>
																			</div>
																		</div>
																	</div>
																</div>
															</td>
															<td>
																<div class="custom-control custom-checkbox">
																	<input type="checkbox" name="fat_input_yes" value="y" class="custom-control-input health-3" id="fat-input-y">
																	<label for="fat-input-y" class="custom-control-label">&nbsp;</label>
																</div>
															</td>
															<td>
																<div class="custom-control custom-checkbox">
																	<input type="checkbox" name="fat_input_no" value="n" class="custom-control-input health-3" id="fat-input-n">
																	<label for="fat-input-n" class="custom-control-label">&nbsp;</label>
																</div>
															</td>
															<td>
																<div class="custom-control custom-checkbox">
																	<input type="checkbox" name="fat_input_un" value="u" class="custom-control-input health-3" id="fat-input-u">
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
																	<input type="checkbox" name="diabetes_yes" value="y" class="custom-control-input health-4" id="diabetes-y">
																	<label for="diabetes-y" class="custom-control-label">&nbsp;</label>
																</div>
															</td>
															<td>
																<div class="custom-control custom-checkbox">
																	<input type="checkbox" name="diabetes_no" value="n" class="custom-control-input health-4" id="diabetes-n">
																	<label for="diabetes-n" class="custom-control-label">&nbsp;</label>
																</div>
															</td>
															<td>
																<div class="custom-control custom-checkbox">
																	<input type="checkbox" name="diabetes_un" value="Y" class="custom-control-input health-4" id="diabetes-u">
																	<label for="diabetes-u" class="custom-control-label">&nbsp;</label>
																</div>
															</td>
														</tr>
														<tr id="health_table_tr5">
															<td>
																<div class="form-group row">
																	<label for="aids" class="mt-2 font-normal">ภูมิคุ้มกันบกพร่อง ระบุ</label>
																</div>
															</td>
															<td>
																<div class="custom-control custom-checkbox">
																	<input type="checkbox" name="aids_yes" value="y" class="custom-control-input health-5" id="aids-y">
																	<label for="aids-y" class="custom-control-label">&nbsp;</label>
																</div>
															</td>
															<td>
																<div class="custom-control custom-checkbox">
																	<input type="checkbox" name="aids_no" value="n" class="custom-control-input health-5" id="aids-n">
																	<label for="aids-n" class="custom-control-label">&nbsp;</label>
																</div>
															</td>
															<td>
																<div class="custom-control custom-checkbox">
																	<input type="checkbox" name="aids_un" value="Y" class="custom-control-input health-5" id="aids-u">
																	<label for="aids-u" class="custom-control-label">&nbsp;</label>
																</div>
															</td>
														</tr>
														<tr id="health_table_tr6">
															<td>
																<div class="form-group row">
																	<label for="preterm_infant" class="mt-2 font-normal">คลอดก่อนกำหนด อายุครรภ์</label>
																	<div class="col-xs-6 col-sm-6 col-md-4 col-lg-3 col-xl-3">
																		<div class="input-group">
																			<input type="number" name="preterm_infant_week" value="0" min="0" max="52" class="form-control" id="preterm-infant-week">
																			<div class="input-group-append">
																				<span class="input-group-text">สัปดาห์</span>
																			</div>
																		</div>
																	</div>
																</div>
															</td>
															<td>
																<div class="custom-control custom-checkbox">
																	<input type="checkbox" name="preterm_infant_yes" value="y" class="custom-control-input health-6" id="preterm-infant-y">
																	<label for="preterm-infant-y" class="custom-control-label">&nbsp;</label>
																</div>
															</td>
															<td>
																<div class="custom-control custom-checkbox">
																	<input type="checkbox" name="preterm_infant_no" value="n" class="custom-control-input health-6" id="preterm-infant-n">
																	<label for="preterm-infant-n" class="custom-control-label">&nbsp;</label>
																</div>
															</td>
															<td>
																<div class="custom-control custom-checkbox">
																	<input type="checkbox" name="preterm_infant_un" value="u" class="custom-control-input health-6" id="preterm-infant-u">
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
																	<input type="checkbox" name="malnutrition_yes" value="y" class="custom-control-input health-7" id="malnutrition-y">
																	<label for="malnutrition-y" class="custom-control-label">&nbsp;</label>
																</div>
															</td>
															<td>
																<div class="custom-control custom-checkbox">
																	<input type="checkbox" name="malnutrition_no" value="n" class="custom-control-input health-7" id="malnutrition-n">
																	<label for="malnutrition-n" class="custom-control-label">&nbsp;</label>
																</div>
															</td>
															<td>
																<div class="custom-control custom-checkbox">
																	<input type="checkbox" name="malnutrition_un" value="u" class="custom-control-input health-7" id="malnutrition-u">
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
																	<input type="checkbox" name="copd_yes" value="y" class="custom-control-input health-8" id="copd-y">
																	<label for="copd-y" class="custom-control-label">&nbsp;</label>
																</div>
															</td>
															<td>
																<div class="custom-control custom-checkbox">
																	<input type="checkbox" name="copd_no" value="n" class="custom-control-input health-8" id="copd-n">
																	<label for="copd-n" class="custom-control-label">&nbsp;</label>
																</div>
															</td>
															<td>
																<div class="custom-control custom-checkbox">
																	<input type="checkbox" name="copd_un" value="u" class="custom-control-input health-8" id="copd-u">
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
																	<input type="checkbox" name="asthma_yes" value="y" class="custom-control-input health-9" id="asthma-y">
																	<label for="asthma-y" class="custom-control-label">&nbsp;</label>
																</div>
															</td>
															<td>
																<div class="custom-control custom-checkbox">
																	<input type="checkbox" name="asthma_no" value="n" class="custom-control-input health-9" id="asthma-n">
																	<label for="asthma-n" class="custom-control-label">&nbsp;</label>
																</div>
															</td>
															<td>
																<div class="custom-control custom-checkbox">
																	<input type="checkbox" name="asthma_un" value="u" class="custom-control-input health-9" id="asthma-u">
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
																	<input type="checkbox" name="heart_disease_yes" value="y" class="custom-control-input health-10" id="heart-disease-y">
																	<label for="heart-disease-y" class="custom-control-label">&nbsp;</label>
																</div>
															</td>
															<td>
																<div class="custom-control custom-checkbox">
																	<input type="checkbox" name="heart_disease_no" value="n" class="custom-control-input health-10" id="heart-disease-n">
																	<label for="heart-disease-n" class="custom-control-label">&nbsp;</label>
																</div>
															</td>
															<td>
																<div class="custom-control custom-checkbox">
																	<input type="checkbox" name="heart_disease_un" value="u" class="custom-control-input health-10" id="heart-disease-u">
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
																	<input type="checkbox" name="stroke_yes" value="y" class="custom-control-input health-11" id="stroke-y">
																	<label for="stroke-y" class="custom-control-label">&nbsp;</label>
																</div>
															</td>
															<td>
																<div class="custom-control custom-checkbox">
																	<input type="checkbox" name="stroke_no" value="n" class="custom-control-input health-11" id="stroke-n">
																	<label for="stroke-n" class="custom-control-label">&nbsp;</label>
																</div>
															</td>
															<td>
																<div class="custom-control custom-checkbox">
																	<input type="checkbox" name="stroke-y" value="u" class="custom-control-input health-11" id="stroke-u">
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
																	<input type="checkbox" name="kidney_disease_yes" value="y" class="custom-control-input health-12" id="kidney-disease-y">
																	<label for="kidney-disease-y" class="custom-control-label">&nbsp;</label>
																</div>
															</td>
															<td>
																<div class="custom-control custom-checkbox">
																	<input type="checkbox" name="kidney_disease_no" value="n" class="custom-control-input health-12" id="kidney-disease-n">
																	<label for="kidney-disease-n" class="custom-control-label">&nbsp;</label>
																</div>
															</td>
															<td>
																<div class="custom-control custom-checkbox">
																	<input type="checkbox" name="kidney_disease_un" value="u" class="custom-control-input health-12" id="kidney-disease-u">
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
																			<input type="text" name="cancer_input" class="form-control" id="cancer-input" disabled>
																		</div>
																	</div>
																</div>
															</td>
															<td>
																<div class="custom-control custom-checkbox">
																	<input type="checkbox" name="cancer_yes" value="y" class="custom-control-input health-13" id="cancer-y">
																	<label for="cancer-y" class="custom-control-label">&nbsp;</label>
																</div>
															</td>
															<td>
																<div class="custom-control custom-checkbox">
																	<input type="checkbox" name="cancer_no" value="n" class="custom-control-input health-13" id="cancer-n">
																	<label for="cancer-n" class="custom-control-label">&nbsp;</label>
																</div>
															</td>
															<td>
																<div class="custom-control custom-checkbox">
																	<input type="checkbox" name="cancer-un" value="u" class="custom-control-input health-13" id="cancer-u">
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
																			<input type="text" name="other_disease_input" class="form-control" id="other-disease-input" disabled>
																		</div>
																	</div>
																</div>
															</td>
															<td>
																<div class="custom-control custom-checkbox">
																	<input type="checkbox" name="other_disease_y" value="y" class="custom-control-input health-14" id="other-disease-y">
																	<label for="other-disease-y" class="custom-control-label">&nbsp;</label>
																</div>
															</td>
															<td>
																<div class="custom-control custom-checkbox">
																	<input type="checkbox" name="other_disease_no" value="n" class="custom-control-input health-14" id="other-disease-n">
																	<label for="other-disease-n" class="custom-control-label">&nbsp;</label>
																</div>
															</td>
															<td>
																<div class="custom-control custom-checkbox">
																	<input type="checkbox" name="other_disease_un" value="u" class="custom-control-input health-14" id="other-disease-u">
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
																<input type="checkbox" name="pet_touch" value="n" class="custom-control-input risk-1" id="pet_touch_n">
																<label for="pet_touch_n" class="custom-control-label normal-label">ไม่ใช่</label>
															</div>
														</td>
														<td class="text-success">
															<div class="custom-control custom-checkbox">
																<input type="checkbox" name="pet_touch" value="y" class="custom-control-input risk-1" id="pet_touch_y">
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
																		<input type="text" name="pet_touch_name" class="form-control form-control-sm ml-2" id="pet_touch_name" disabled>
																	</div>
																</div>
															</div>
														</td>
														<td class="text-danger">
															<div class="custom-control custom-checkbox">
																<input type="checkbox" name="pet_touch_direct" value="n" class="custom-control-input risk-2" id="pet_touch_direct_n">
																<label for="pet_touch_direct_n" class="custom-control-label normal-label">ไม่ใช่</label>
															</div>
														</td>
														<td class="text-success">
															<div class="custom-control custom-checkbox">
																<input type="checkbox" name="pet_touch_direct" value="y" class="custom-control-input risk-2" id="pet_touch_direct_y">
																<label for="pet_touch_direct_y" class="custom-control-label normal-label">ใช่</label>
															</div>
														</td>
													</tr>
													<tr id="risk_table_tr3">
														<td>ช่วง 14 วันก่อนป่วยได้พักอาศัยอยู่ในพื้นที่ที่มีสัตว์ปีกป่วย/ตายผิดปกติ</td>
														<td class="text-danger">
															<div class="custom-control custom-checkbox">
																<input type="checkbox" name="stay_pet_death" value="n" class="custom-control-input risk-3" id="stay_pet_death_n">
																<label for="stay_pet_death_n" class="custom-control-label normal-label">ไม่ใช่</label>
															</div>
														</td>
														<td class="text-success">
															<div class="custom-control custom-checkbox">
																<input type="checkbox" name="stay_pet_death" value="y" class="custom-control-input risk-3" id="stay_pet_death_y">
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
																		<input type="text" name="stay_outbreak_input" class="form-control form-control-sm ml-2" id="stay_outbreak_input" disabled>
																	</div>
																</div>
															</div>
														</td>
														<td class="text-danger">
															<div class="custom-control custom-checkbox">
																<input type="checkbox" name="stay_outbreak" value="n" class="custom-control-input risk-4" id="stay_outbreak_n">
																<label for="stay_outbreak_n" class="custom-control-label normal-label">ไม่ใช่</label>
															</div>
														</td>
														<td class="text-success">
															<div class="custom-control custom-checkbox">
																<input type="checkbox" name="stay_outbreak" value="y" class="custom-control-input risk-4" id="stay_outbreak_y">
																<label for="stay_outbreak_y" class="custom-control-label normal-label">ใช่</label>
															</div>
														</td>
													</tr>







												</tbody>
											</table>
										</div>
									</div>






								</div><!-- bd-callout -->
							</div><!-- card body -->
						</div><!-- card -->
						<div class="card">
							<div class="card-body border-top">
								@include('patients.component-reporter')
							</div><!-- card body -->
						</div><!-- card -->
						<div class="border-top">
							<div class="card-body">
								<button type="submit" class="btn btn-success">Save</button>
								<button type="submit" class="btn btn-primary">Reset</button>
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
<script src="{{ URL::asset('public/assets/libs/bootstrap-select-1.13.9/dist/js/bootstrap-select.min.js') }}"></script>
<script src="{{ URL::asset('public/assets/libs/bootstrap-validate-2.2.0/dist/bootstrap-validate.js') }}"></script>
<script src="{{ URL::asset('public/assets/libs/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js') }}"></script>
<script>
$(document).ready(function() {
	/* ajax request */
	$.ajaxSetup({
		headers: {
			'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
		}
	});

	/* symptoms */
	@php
	$symptoms->each(function ($item, $key) {
		echo "
			$('.symptom-".$item->id."').click(function() {
				$('.symptom-".$item->id."').not(this).prop('checked', false);
				let number = $('.symptom-".$item->id."').filter(':checked').length;
				if (number === 1) {
					let hasClass = $('#symptoms_table_tr".$item->id."').hasClass('highlight');
					if (!hasClass) {
						$('#symptoms_table_tr".$item->id."').addClass('highlight');
					}
					if (".$item->id." == 19) {
						$('#symptom_other').prop('disabled', false);
					}
				} else {
					$('#symptoms_table_tr".$item->id."').removeClass('highlight');
					if (".$item->id." == 19) {
						$('#symptom_other').prop('disabled', true);
					}
				}
			});
		\n";
	});
	@endphp

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
	$('#birthDateInput').datepicker({
		format: 'dd/mm/yyyy',
		todayHighlight: true,
		todayBtn: true
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
	/*
	$('#select_occupation').change(function() {
		var id = $('#select_occupation').val();
		if (id === '14') {
			$('#other_occupation_input').prop('disabled', false);
		} else {
			$('#other_occupation_input').val('');
			$('#other_occupation_input').prop('disabled', true);
		}
	});
	*/
	/* patient opd ipd check */
	$('input.ptCheck').on('change', function() {
		$('input.ptCheck').not(this).prop('checked', false);
	});

	/* sick date input */
	$('#sickDateInput').datepicker({
		format: 'dd/mm/yyyy',
		todayHighlight: true,
		todayBtn: true
	});

	/* treat date input */
	$('#treatDateInput').datepicker({
		format: 'dd/mm/yyyy',
		todayHighlight: true,
		todayBtn: true
	});


	/* admit date input */
	$('#admitDateInput').datepicker({
		format: 'dd/mm/yyyy',
		todayHighlight: true,
		todayBtn: true
	});

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
		todayBtn: true
	});

	/* cbc date input */
	$('#cbcDateInput').datepicker({
		format: 'dd/mm/yyyy',
		todayHighlight: true,
		todayBtn: true
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
		todayBtn: true
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
		todayBtn: true
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






});

</script>

@endsection
