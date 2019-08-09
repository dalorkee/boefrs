@extends('layouts.index')
@section('topScript')
@endsection
@section('contents')
<div class="page-breadcrumb" style="padding-bottom:5px;background-color:#ffffff;">
	<div class="row">
		<div class="col-12 d-flex no-block align-items-center">
			<h4 class="page-title"><span style="display:none;">Lab</span></h4>
			<div class="ml-auto text-right">
				<nav aria-label="breadcrumb">
					<ol class="breadcrumb">
						<li class="breadcrumb-item"><a href="#">Home</a></li>
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
					<div class="d-md-flex align-items-center">
						<div>
							<h4 class="card-title">แบบเก็บข้อมูลโครงการเฝ้าระวังเชื้อไวรัสก่อโรคระบบทางเดินหายใจ</h4>
							<h5 class="card-subtitle">ID Flu-BOE</h5>
						</div>
					</div>
					<Form action="#" method="POST" class="needs-validation custom-form-legend" novalidate>
						<div class="bd-callout bd-callout-custom-3">
							<h1>1. ข้อมูลทั่วไปของผู้ป่วย</h1>
							<div class="form-row">
								<div class="col-xs-12 col-sm-12 col-md-6 col-lg-4 col-xl-4 mb-3">
									{{ csrf_field() }}
									<label for="firstNameInput">ชื่อ</label>
									<input type="text" name="firstNameInput" class="form-control" id="first_name_input" placeholder="First name" required>
									<div class="valid-feedback">Looks good!</div>
								</div>
								<div class="col-xs-12 col-sm-12 col-md-6 col-lg-4 col-xl-4 mb-3">
									<label for="lastNameInput">นามสกุล</label>
									<input type="text" name="lastNameInput" class="form-control" id="last_name_input" placeholder="Last name" required>
									<div class="valid-feedback">Looks good!</div>
								</div>
							</div>
							<div class="form-row">
								<div class="col-xs-12 col-sm-12 col-md-4 col-lg-2 col-xl-2 mb-3">
									<label for="hnInput">HN</label>
									<input type="text" name="hnInput" class="form-control" id="hn_input" placeholder="HN" required>
									<div class="valid-feedback">Looks good!</div>
								</div>
								<div class="col-xs-12 col-sm-12 col-md-4 col-lg-2 col-xl-2 mb-3">
									<label for="anInput">AN</label>
									<input type="text" name="anInput" class="form-control" id="an_input" placeholder="AN">
									<div class="valid-feedback">Looks good!</div>
								</div>
							</div>
							<div class="form-row">
								<div class="col-xs-12 col-sm-12 col-md-6 col-lg-2 col-xl-2 mb-3">
									<label for="sexInput">เพศ</label>
									<select name="sexInput" class="custom-select">
										<option value="null">-- โปรดเลือก --</option>
										<option value="male">ชาย</option>
										<option value="female">หญิง</option>
									</select>
								</div>
								<div class="col-xs-12 col-sm-12 col-md-6 col-lg-2 col-xl-2 mb-3">
									<label for="birthDateInput">ว/ด/ป เกิด</label>
									<div class="input-group date" data-provide="datepicke" id="birthDateInput">
										<div class="input-group">
											<input type="text" name="birthDateInput" class="form-control" required>
											<div class="input-group-append">
												<span class="input-group-text"><i class="mdi mdi-calendar"></i></span>
											</div>
										</div>
									</div>
								</div>
									<div class="col-xs-12 col-sm-12 col-md-4 col-lg-1 col-xl-1 mb-3">
										<label for="ageYearInput">อายุ/ปี</label>
										<input type="text" name="ageYearInput" class="form-control" id="ageYearInput" value="0" required>
									</div>
									<div class="col-xs-12 col-sm-12 col-md-4 col-lg-1 col-xl-1 mb-3">
										<label for="ageMonthInput">อายุ/เดือน</label>
										<input type="text" name="ageMonthInput" class="form-control" id="ageMonthInput" value="0" required>
									</div>
								</div>
								<div class="form-row">
									<div class="col-xs-12 col-sm-12 col-md-6 col-lg-2 col-xl-2 mb-3">
										<label for="nationalityInput">สัญชาติ</label>
										<select name="nationalityInput" class="custom-select">
											<option value="null">-- โปรดเลือก --</option>
											<option value="Thai">ไทย</option>
											<option value="Burmese">พม่า</option>
											<option value="Laotian/Lao">ลาว</option>
											<option value="Cambodian">กัมพูชา</option>
											<option value="Vietnamese">เวียดนาม</option>
											<option value="Bruneian">บรูไน ดารุสซาลาม</option>
											<option value="Indonesian">อินโดนีเซีย</option>
											<option value="Malaysia">มาเลเซีย</option>
											<option value="Filipino">ฟิลิปปินส์</option>
											<option value="Singaporean">สิงคโปร์</option>
											<option value="Other">อื่นๆ ระบุ'</option>
										</select>
									</div>
									<div class="col-xs-12 col-sm-12 col-md-4 col-lg-2 col-xl-2 mb-3">
										<label for="otherNationalityInput">สัญชาติ อื่นๆ ระบุ</label>
										<input type="text" name="otherNationalityInput" class="form-control" id="otherNationality_input" placeholder="สัญชาติอื่นๆ" disabled>
									</div>
								</div>
								<div class="form-row">
									<div class="col-xs-12 col-sm-12 col-md-6 col-lg-4 col-xl-4 mb-3">
										<label for="hospitalInput">โรงพยาบาล</label>
										<input type="text" name="hospitalInput" class="form-control" placeholder="โรงพยาบาล">
									</div>
								</div>
								<div class="form-row">
									<div class="col-xs-12 col-sm-12 col-md-6 col-lg-2 col-xl-2 mb-3">
										<label for="houseNoInput">ที่อยู่ปัจจุบัน/ขณะป่วย เลขที่</label>
										<input type="text" name="houseNoInput" class="form-control" placeholder="บ้านเลขที่">
									</div>
									<div class="col-xs-12 col-sm-12 col-md-6 col-lg-1 col-xl-1 mb-3">
										<label for="villageNoInput">หมู่ที่</label>
										<input type="text" name="villageNoInput" class="form-control" placeholder="หมู่ที่">
									</div>
									<div class="col-xs-12 col-sm-12 col-md-6 col-lg-3 col-xl-3 mb-3">
										<label for="villageInput">หมู่บ้าน</label>
										<input type="text" name="villageInput" class="form-control" placeholder="หมู่บ้าน">
									</div>
									<div class="col-xs-12 col-sm-12 col-md-6 col-lg-3 col-xl-3 mb-3">
										<label for="laneInput">ซอย</label>
										<input type="text" name="laneInput" class="form-control" placeholder="ซอย">
									</div>
								</div>
								<div class="form-row">
									<div class="col-xs-12 col-sm-12 col-md-6 col-lg-2 col-xl-2 mb-3">
										<label for="subDistrictInput">ตำบล</label>
										<select name="subDistrictInput" class="custom-select">
											<option value="null">-- โปรดเลือก --</option>
										</select>
									</div>
									<div class="col-xs-12 col-sm-12 col-md-6 col-lg-2 col-xl-2 mb-3">
										<label for="districtInput">อำเภอ</label>
										<select name="districtInput" class="custom-select">
											<option value="null">-- โปรดเลือก --</option>
										</select>
									</div>
									<div class="col-xs-12 col-sm-12 col-md-6 col-lg-2 col-xl-2 mb-3">
										<label for="provinceInput">จังหวัด</label>
										<select name="provinceInput" class="custom-select">
											<option value="null">-- โปรดเลือก --</option>
										</select>
									</div>
								</div>
								<div class="form-row">
									<div class="col-xs-12 col-sm-12 col-md-4 col-lg-2 col-xl-2 mb-3">
										<label for="occupationInput">อาชีพ</label>
										<select name="occupationInput" class="custom-select">
											<option value="null">-- โปรดเลือก --</option>
											<option value="-1">อื่นๆ ระบุ</option>
										</select>
									</div>
									<div class="col-xs-12 col-sm-12 col-md-4 col-lg-4 col-xl-4 mb-3">
										<label for="occupationOtherInput">อาชีพ อื่นๆ ระบุ</label>
										<input type="text" name="occupationOtherInput" class="form-control" placeholder="อาชีพ อื่นๆ" disabled>
									</div>
								</div>
						</div>
						<div class="bd-callout bd-callout-info">
							<h1>2. ข้อมูลทางคลินิก</h1>
							<div class="form-row">
									<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 mb-3">
										<label for="patientInput">ผู้ป่วย</label>
										<div>
											<div class="custom-control custom-checkbox custom-control-inline">
												<input type="checkbox" name="patientCheckbox" class="custom-control-input" id="opdCheckbox">
												<label for="opdCheckbox" class="custom-control-label custom-label">ผู้ป่วยนอก (OPD)/ILI</label>
											</div>
											<div class="custom-control custom-checkbox custom-control-inline">
												<input type="checkbox" name="patientCheckbox" class="custom-control-input" id="ipdCheckbox">
												<label for="ipdCheckbox" class="custom-control-label custom-label">ผู้ป่วยใน (IPD)/SARI</label>
											</div>
											<div class="custom-control custom-checkbox custom-control-inline">
												<input type="checkbox" name="patientCheckbox" class="custom-control-input" id="icuCheckbox">
												<label for="icuCheckbox" class="custom-control-label custom-label">ผู้ป่วยหนัก/ICU</label>
											</div>
										</div>
									</div>
								</div>
								<div class="form-row">
									<div class="col-xs-12 col-sm-12 col-md-6 col-lg-2 col-xl-2 mb-3">
										<label for="sickDateInput">วันที่เริ่มป่วย</label>
										<div class="input-group date" data-provide="datepicke" id="sickDate">
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
										<div class="input-group date" data-provide="datepicke" id="treatDate">
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
										<div class="input-group date" data-provide="datepicke" id="admitDate">
											<div class="input-group">
												<input type="admitDateInput" class="form-control" required>
												<div class="input-group-append">
													<span class="input-group-text"><i class="mdi mdi-calendar"></i></span>
												</div>
											</div>
										</div>
									</div>
								</div>
								<div class="form-row">
									<div class="col-xs-12 col-sm-12 col-md-6 col-lg-2 col-xl-2 mb-3">
										<label for="sickDateInput">อุณหภูมิร่างกายแรกรับ</label>
										<div class="input-group">
											<input type="text" name="sickDateInput" class="form-control" required>
											<div class="input-group-append">
												<span class="input-group-text">&#176;</span>
											</div>
										</div>
									</div>
								</div>
								<div class="form-row">
									<div class="col-xs-12 col-sm-12 col-md-6 col-lg-12 col-xl-12 mb-3">
										<label for="sickDateInput">อาการและอาการแสดง</label>
										<div class="table-responsive">
											<table class="table" id="symptoms_table">
												<thead>
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
																$other_symptom = "<input type=\"text\" name=\"symptom_other\" class=\"form-control\" id=\"symptom_other\" disabled>";
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
												<input type="checkbox" name="lungXrayInput" class="custom-control-input" id="lungXrayNo">
												<label for="lungXrayNo" class="custom-control-label custom-label">ไม่ได้ทำ</label>
											</div>
											<div class="custom-control custom-checkbox custom-control-inline">
												<input type="checkbox" name="lungXrayInput" class="custom-control-input" id="lungXrayYes">
												<label for="lungXrayYes" class="custom-control-label custom-label">ทำ</label>
											</div>
										</div>
									</div>
									<div class="col-xs-12 col-sm-12 col-md-6 col-lg-2 col-xl-2 mb-3">
										<label for="xRayDateInput">ระบุวันที่</label>
										<div class="input-group date" data-provide="datepicke" id="xRayDateInput">
											<div class="input-group">
												<input type="text" name="xRayDateInput" class="form-control">
												<div class="input-group-append">
													<span class="input-group-text"><i class="mdi mdi-calendar"></i></span>
												</div>
											</div>
										</div>
									</div>
									<div class="col-xs-12 col-sm-12 col-md-6 col-lg-8 col-xl-8 mb-2">
										<label for="sickDateInput">ระบุผล</label>
										<input type="text" name="sickDateInput" class="form-control">
									</div>
								</div>
								<div class="form-row">
									<div class="col-xs-12 col-sm-12 col-md-6 col-lg-2 col-xl-2 mb-3">
										<label for="cbcInput">CBC (ครั้งแรก): วันที่</label>
										<div class="input-group date" data-provide="datepicke" id="cbcDateInput">
											<div class="input-group">
												<input type="text" name="cbcDateInput" class="form-control">
												<div class="input-group-append">
													<span class="input-group-text"><i class="mdi mdi-calendar"></i></span>
												</div>
											</div>
										</div>
									</div>
									<div class="col-xs-12 col-sm-12 col-md-6 col-lg-2 col-xl-2 mb-2">
										<label for="hbInput">ผล Hb</label>
										<div class="input-group">
											<input type="text" name="hbInput" class="form-control">
											<div class="input-group-append">
												<span class="input-group-text">mg%</span>
											</div>
										</div>
									</div>
									<div class="col-xs-12 col-sm-12 col-md-6 col-lg-2 col-xl-2 mb-2">
										<label for="htcInput">Hct</label>
										<div class="input-group">
											<input type="text" name="htcInput" class="form-control">
											<div class="input-group-append">
												<span class="input-group-text">%</span>
											</div>
										</div>
									</div>
									<div class="col-xs-12 col-sm-12 col-md-6 col-lg-2 col-xl-2 mb-2">
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
									<div class="col-xs-12 col-sm-12 col-md-6 col-lg-2 col-xl-2 mb-2">
										<label for="wbcInput">WBC</label>
										<input type="text" name="wbcInput" class="form-control">
									</div>
									<div class="col-xs-12 col-sm-12 col-md-6 col-lg-2 col-xl-2 mb-2">
										<label for="nInput">N</label>
										<div class="input-group">
											<input type="text" name="nInput" class="form-control">
											<div class="input-group-append">
												<span class="input-group-text">%</span>
											</div>
										</div>
									</div>
									<div class="col-xs-12 col-sm-12 col-md-6 col-lg-2 col-xl-2 mb-2">
										<label for="lInput">L</label>
										<div class="input-group">
											<input type="text" name="lInput" class="form-control">
											<div class="input-group-append">
												<span class="input-group-text">%</span>
											</div>
										</div>
									</div>
									<div class="col-xs-12 col-sm-12 col-md-6 col-lg-2 col-xl-2 mb-2">
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
									<div class="col-xs-12 col-sm-12 col-md-6 col-lg-2 col-xl-2 mb-2">
										<label for="monoInput">Mono</label>
										<div class="input-group">
											<input type="text" name="monoInput" class="form-control">
											<div class="input-group-append">
												<span class="input-group-text">%</span>
											</div>
										</div>
									</div>
									<div class="col-xs-12 col-sm-12 col-md-6 col-lg-2 col-xl-2 mb-2">
										<label for="basoInput">Baso</label>
										<div class="input-group">
											<input type="text" name="basoInput" class="form-control">
											<div class="input-group-append">
												<span class="input-group-text">%</span>
											</div>
										</div>
									</div>
									<div class="col-xs-12 col-sm-12 col-md-6 col-lg-2 col-xl-2 mb-2">
										<label for="eoInput">Eo</label>
										<div class="input-group">
											<input type="text" name="eoInput" class="form-control">
											<div class="input-group-append">
												<span class="input-group-text">%</span>
											</div>
										</div>
									</div>
									<div class="col-xs-12 col-sm-12 col-md-6 col-lg-2 col-xl-2 mb-2">
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
										<label for="firstDiagnosisInput">การวินิจฉัยเบื้องต้น</label>
										<input type="text" name="firstDiagnosisInput" class="form-control" placeholder="การวินิจฉัยเบื้องต้น">
									</div>
								</div>
								<div class="form-row">
									<div class="col-xs-12 col-sm-12 col-md-6 col-lg-2 col-xl-2 mb-3">
										<label for="influenzaRapidInput">มีการตรวจ Influenza rapid test</label>
										<div>
											<div class="custom-control custom-checkbox custom-control-inline">
												<input type="checkbox" name="influenzaRapidCheckbox" class="custom-control-input" id="influRapidCheckboxNo">
												<label for="influRapidCheckboxNo" class="custom-control-label custom-label">ไม่ตรวจ</label>
											</div>
											<div class="custom-control custom-checkbox custom-control-inline">
												<input type="checkbox" name="influenzaRapidCheckbox" class="custom-control-input" id="influRapidCheckboxYes">
												<label for="influRapidCheckboxYes" class="custom-control-label custom-label">ตรวจ</label>
											</div>
										</div>
									</div>
									<div class="col-xs-12 col-sm-12 col-md-6 col-lg-4 col-xl-4 mb-2">
										<label for="testNameInput">ระบุชื่อ test</label>
										<input type="text" name="testNameInput" class="form-control" placeholder="ระบุชื่อ test" disabled>
									</div>
								</div>
								<div class="form-row">
									<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 mb-3">
										<label for="rapidTestResult">ผล Rapid test</label>
										<div>
											<div class="custom-control custom-checkbox custom-control-inline">
												<input type="checkbox" name="rapidTestResultCheckbox" class="custom-control-input" id="rapidTestNagative">
												<label for="rapidTestNagative" class="custom-control-label custom-label">Nagative</label>
											</div>
											<div class="custom-control custom-checkbox custom-control-inline">
												<input type="checkbox" name="rapidTestResultCheckbox" class="custom-control-input" id="rapidTestPositiveFluA">
												<label for="rapidTestPositiveFluA" class="custom-control-label custom-label">Positive Flu A</label>
											</div>
											<div class="custom-control custom-checkbox custom-control-inline">
												<input type="checkbox" name="rapidTestResultCheckbox" class="custom-control-input" id="rapidTestPositiveFluB">
												<label for="rapidTestPositiveFluB" class="custom-control-label custom-label">Positive Flu B</label>
											</div>
										</div>
									</div>
								</div>
								<div class="form-row">
									<div class="col-xs-12 col-sm-12 col-md-6 col-lg-2 col-xl-2 mb-3">
										<label for="influenzaVaccine">ผู้ป่วยเคยได้รับวัคซีนไข้หวัดใหญ่หรือไม่</label>
										<div>
											<div class="custom-control custom-checkbox custom-control-inline">
												<input type="checkbox" name="influenzaVaccine" class="custom-control-input" id="influenzaVaccNo">
												<label for="influenzaVaccNo" class="custom-control-label custom-label">ไม่เคย</label>
											</div>
											<div class="custom-control custom-checkbox custom-control-inline">
												<input type="checkbox" name="influenzaVaccine" class="custom-control-input" id="influenzaVaccYes">
												<label for="influenzaVaccYes" class="custom-control-label custom-label">เคย</label>
											</div>
										</div>
									</div>
									<div class="col-xs-12 col-sm-12 col-md-6 col-lg-2 col-xl-2 mb-2">
										<label for="influenzaVaccineReceive">เคยได้รับเมื่อ</label>
										<div class="input-group date" data-provide="datepicke" id="birthDateInput">
											<div class="input-group">
												<input type="text" name="influenzaVaccineReceive" class="form-control" disabled>
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
												<input type="checkbox" name="virusMedicine" class="custom-control-input" id="virusMedicineNo">
												<label for="virusMedicineNo" class="custom-control-label custom-label">ไม่ให้</label>
											</div>
											<div class="custom-control custom-checkbox custom-control-inline">
												<input type="checkbox" name="virusMedicine" class="custom-control-input" id="virusMedicineYes">
												<label for="virusMedicineYes" class="custom-control-label custom-label">ให้</label>
											</div>
										</div>
									</div>
									<div class="col-xs-12 col-sm-12 col-md-6 col-lg-4 col-xl-4 mb-2">
										<label for="medicineName">ชื่อยา</label>
										<input type="text" name="medicineNameInput" class="form-control" placeholder="ชื่อยา" disabled>
									</div>
									<div class="col-xs-12 col-sm-12 col-md-6 col-lg-2 col-xl-2 mb-2">
										<label for="medicineGiveDate">วันที่เริ่มให้ยา</label>
										<div class="input-group date" data-provide="datepicke" id="medicineGive">
											<div class="input-group">
												<input type="text" name="medicineGiveDate" class="form-control" disabled>
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
											@include('admin.lab.component-health-tbl')
										</div>
									</div>
								</div>
							</div>

						<button class="btn btn-primary mt-3" type="submit">Submit form</button>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection
@section('script')
<script>
$(document).ready(function() {
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

	$('#xx').click(function(){alert('ok เลย')});

});
</script>
<script>
$('#birthDateInput').datepicker({
	format: 'dd/mm/yyyy',
	todayHighlight: true,
	todayBtn: true
});

</script>
@endsection
