@extends('layouts.index')
@section('topScript')

@endsection
@section('contents')
<div class="page-breadcrumb">
	<div class="row">
		<div class="col-12 d-flex no-block align-items-center">
			<h4 class="page-title">Lab</h4>
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
<div class="container-fluid page-wrapper-custom">
	<div class="row">
		<div class="col-md-12">
			<div class="card">
				<div class="card-body">
					<Form action="#" method="POST" class="needs-validation custom-form-legend" novalidate>
						<fieldset>
							<legend>1. ข้อมูลทั่วไปของผู้ป่วย</legend>
							<div class="bd-callout">
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
										<div class="form-group">
											<select name="sexInput" class="custom-select">
												<option value="null">-- โปรดเลือก --</option>
												<option value="male">ชาย</option>
												<option value="female">หญิง</option>
											</select>
										</div>
									</div>
									<div class="col-xs-12 col-sm-12 col-md-6 col-lg-2 col-xl-2 mb-3">
										<label for="birthDateInput">ว/ด/ป เกิด</label>
										<div class="form-group">
											<div class="input-group date" data-provide="datepicke" id="birthDateInput">
												<input type="text" name="birthDateInput" class="form-control" required>
												<div class="input-group-addon">
													<span class=""></span>
												</div>
											</div>
										</div>
									</div>
									<div class="col-xs-12 col-sm-12 col-md-4 col-lg-1 col-xl-1 mb-3">
										<label for="ageYearInput">อายุ/ปี</label>
										<input type="number" name="ageYearInput" class="form-control" id="ageYearInput" value="0" required>
										<div class="valid-feedback">Looks good!</div>
									</div>
									<div class="col-xs-12 col-sm-12 col-md-4 col-lg-1 col-xl-1 mb-3">
										<label for="ageMonthInput">อายุ/เดือน</label>
										<input type="number" name="ageMonthInput" class="form-control" id="ageMonthInput" value="0" required>
										<div class="valid-feedback">Looks good!</div>
									</div>
								</div>
								<div class="form-row">
									<div class="col-xs-12 col-sm-12 col-md-6 col-lg-2 col-xl-2 mb-3">
										<label for="nationalityInput">สัญชาติ</label>
										<div class="form-group">
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
										<div class="valid-feedback">Looks good!</div>
									</div>
									<div class="col-xs-12 col-sm-12 col-md-4 col-lg-2 col-xl-2 mb-3">
										<label for="otherNationalityInput">สัญชาติ อื่นๆ ระบุ</label>
										<input type="text" name="otherNationalityInput" class="form-control" id="otherNationality_input" placeholder="สัญชาติอื่นๆ">
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
										<label for="villageNoInput">หมู่ที่></label>
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
										<div class="form-group">
											<select name="subDistrictInput" class="custom-select">
												<option value="null">-- โปรดเลือก --</option>
											</select>
										</div>
									</div>
									<div class="col-xs-12 col-sm-12 col-md-6 col-lg-2 col-xl-2 mb-3">
										<label for="districtInput">อำเภอ</label>
										<div class="form-group">
											<select name="districtInput" class="custom-select">
												<option value="null">-- โปรดเลือก --</option>
											</select>
										</div>
									</div>
									<div class="col-xs-12 col-sm-12 col-md-6 col-lg-2 col-xl-2 mb-3">
										<label for="provinceInput">จังหวัด</label>
										<div class="form-group">
											<select name="provinceInput" class="custom-select">
												<option value="null">-- โปรดเลือก --</option>
											</select>
										</div>
									</div>
								</div>
								<div class="form-row">
									<div class="col-xs-12 col-sm-12 col-md-4 col-lg-2 col-xl-2 mb-3">
										<label for="occupationInput">อาชีพ</label>
										<div class="form-group">
											<select name="occupationInput" class="custom-select">
												<option value="null">-- โปรดเลือก --</option>
												<option value="-1">อื่นๆ ระบุ</option>
											</select>
										</div>
									</div>
									<div class="col-xs-12 col-sm-12 col-md-4 col-lg-4 col-xl-4 mb-3">
										<label for="occupationOtherInput">อาชีพ อื่นๆ ระบุ</label>
										<input type="text" name="occupationOtherInput" class="form-control" placeholder="อาชีพ อื่นๆ">
									</div>
								</div>
							</div>
						</fieldset>
						<fieldset>
							<legend>2. ข้อมูลทางคลินิก</legend>
							<div class="bd-callout">
								<div class="form-row">
									<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 mb-3">
										<label for="patientInput">ผู้ป่วย</label>
										<div class="form-group">
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
										<input type="text" name="sickDateInput" class="form-control" required>
									</div>
									<div class="col-xs-12 col-sm-12 col-md-6 col-lg-2 col-xl-2 mb-3">
										<label for="sickDateInput">วันที่รักษาครั้งแรก</label>
										<input type="text" name="sickDateInput" class="form-control" required>
									</div>
									<div class="col-xs-12 col-sm-12 col-md-6 col-lg-2 col-xl-2 mb-3">
										<label for="sickDateInput">วันที่นอนโรงพยาบาล</label>
										<input type="sickDateInput" class="form-control" required>
									</div>
								</div>
								<div class="form-row">
									<div class="col-xs-12 col-sm-12 col-md-6 col-lg-2 col-xl-2 mb-3">
										<label for="sickDateInput">อุณหภูมิร่างกายแรกรับ</label>
										<input type="text" name="sickDateInput" class="form-control" required>
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
																		echo "<input type=\"checkbox\" name=\"symptom_".$item->id."_Input\" value=\"No\" class=\"custom-control-input symptom-".$item->id."\" id=\"symptom_".$item->id."_yes\">";
																		echo "<label for=\"symptom_".$item->id."_yes\" class=\"custom-control-label\">&nbsp;</label>";
																	echo "</div>";
																echo "</td>";
																echo "<td>";
																	echo "<div class=\"custom-control custom-checkbox\">";
																		echo "<input type=\"checkbox\" name=\"symptom_".$item->id."_Input\" value=\"No\" class=\"custom-control-input symptom-".$item->id."\" id=\"symptom_".$item->id."_no\">";
																		echo "<label for=\"symptom_".$item->id."_no\" class=\"custom-control-label\"></label>";
																	echo "</div>";
																echo "</td>";
																echo "<td>";
																	echo "<div class=\"custom-control custom-checkbox\">";
																		echo "<input type=\"checkbox\" name=\"symptom_".$item->id."_Input\" value=\"No\" class=\"custom-control-input symptom-".$item->id."\" id=\"symptom_".$item->id."_unknown\">";
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
										<label for="patientInput">เอกซเรย์ปอด (ครั้งแรก)</label>
										<div class="form-group">
											<div class="custom-control custom-checkbox custom-control-inline">
												<input type="checkbox" name="patientCheckbox" class="custom-control-input" id="opdCheckbox">
												<label for="opdCheckbox" class="custom-control-label custom-label">ไม่ได้ทำ</label>
											</div>
											<div class="custom-control custom-checkbox custom-control-inline">
												<input type="checkbox" name="patientCheckbox" class="custom-control-input" id="ipdCheckbox">
												<label for="ipdCheckbox" class="custom-control-label custom-label">ทำ</label>
											</div>
										</div>
									</div>
									<div class="col-xs-12 col-sm-12 col-md-6 col-lg-2 col-xl-2 mb-3">
										<label for="xRayDateInput">ระบุวันที่</label>
										<div class="form-group">
											<div class="input-group date" data-provide="datepicke" id="xRayDateInput">
												<input type="text" name="xRayDateInput" class="form-control" required>
												<div class="input-group-addon">
													<span class=""></span>
												</div>
											</div>
										</div>
									</div>
									<div class="col-xs-12 col-sm-12 col-md-6 col-lg-8 col-xl-8 mb-2">
										<label for="sickDateInput">ระบุผล</label>
										<input type="text" name="sickDateInput" class="form-control" required>
									</div>
								</div>
								<div class="form-row">
									<div class="col-xs-12 col-sm-12 col-md-6 col-lg-2 col-xl-2 mb-3">
										<label for="patientInput">เอกซเรย์ปอด (ครั้งแรก)</label>
										<div class="form-group">
											<div class="custom-control custom-checkbox custom-control-inline">
												<input type="checkbox" name="patientCheckbox" class="custom-control-input" id="opdCheckbox">
												<label for="opdCheckbox" class="custom-control-label custom-label">ไม่ได้ทำ</label>
											</div>
											<div class="custom-control custom-checkbox custom-control-inline">
												<input type="checkbox" name="patientCheckbox" class="custom-control-input" id="ipdCheckbox">
												<label for="ipdCheckbox" class="custom-control-label custom-label">ทำ</label>
											</div>
										</div>
									</div>
									<div class="col-xs-12 col-sm-12 col-md-6 col-lg-2 col-xl-2 mb-3">
										<label for="xRayDateInput">ระบุวันที่</label>
										<div class="form-group">
											<div class="input-group date" data-provide="datepicke" id="xRayDateInput">
												<input type="text" name="xRayDateInput" class="form-control" required>
												<div class="input-group-addon">
													<span class=""></span>
												</div>
											</div>
										</div>
									</div>
									<div class="col-xs-12 col-sm-12 col-md-6 col-lg-8 col-xl-8 mb-2">
										<label for="sickDateInput">ระบุผล</label>
										<input type="text" name="sickDateInput" class="form-control" required>
									</div>
								</div>


							</div>
						</fieldset>
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
