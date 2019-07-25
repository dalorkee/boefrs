@extends('layouts.index')
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
					{{ Form::open(['class'=>'needs-validation custom-form-legend', 'novalidate'=>'novalidate']) }}
						<fieldset>
							<legend>1. ข้อมูลทั่วไปของผู้ป่วย</legend>
							<div class="bd-callout">
								<div class="form-row">
									<div class="col-xs-12 col-sm-12 col-md-6 col-lg-4 col-xl-4 mb-3">
										{{ Form::label('firstNameInput', 'ชื่อ') }}
										{{ Form::text('firstNameInput', null, [
											'class'=>'form-control',
											'id'=>'first_name_input',
											'placeholder'=>'First name',
											'required'=>'required'])
										}}
										<div class="valid-feedback">Looks good!</div>
									</div>
									<div class="col-xs-12 col-sm-12 col-md-6 col-lg-4 col-xl-4 mb-3">
										{{ Form::label('lastNameInput', 'นามสกุล') }}
										{{ Form::text('lastNameInput', null, [
											'class'=>'form-control',
											'id'=>'last_name_input',
											'placeholder'=>'Last name',
											'required'=>'required'])
										}}
										<div class="valid-feedback">Looks good!</div>
									</div>
								</div>
								<div class="form-row">
									<div class="col-xs-12 col-sm-12 col-md-4 col-lg-2 col-xl-2 mb-3">
										{{ Form::label('hnInput', 'HN') }}
										{{ Form::text('hnInput', null, [
											'class'=>'form-control',
											'id'=>'hn_input',
											'placeholder'=>'HN',
											'required'=>'required'])
										}}
										<div class="valid-feedback">Looks good!</div>
									</div>
									<div class="col-xs-12 col-sm-12 col-md-4 col-lg-2 col-xl-2 mb-3">
										{{ Form::label('anInput', 'AN') }}
										{{ Form::text('anInput', null, [
											'class'=>'form-control',
											'id'=>'an_input',
											'placeholder'=>'AN',
											'required'=>'required'])
										}}
										<div class="valid-feedback">Looks good!</div>
									</div>
								</div>
								<!--
								<div class="form-row">
									<div class="col-xs-12 col-sm-12 col-md-6 col-lg-3 col-xl-3 mb-3">
										{ Form::label('sexInput', 'เพศ') }}
										<div class="form-group">
											<div class="custom-control custom-checkbox custom-control-inline">
												{ Form::checkbox('sexCheckbox', 'male', false, ['class'=>'custom-control-input', 'id'=>'maleCheckbox']) }}
												{ Form::label('maleCheckbox', 'ชาย', ['class'=>'custom-control-label']) }}
											</div>
											<div class="custom-control custom-checkbox custom-control-inline">
												{ Form::checkbox('sexCheckbox', 'female', false, ['class'=>'custom-control-input', 'id'=>'femaleCheckbox']) }}
												{ Form::label('femaleCheckbox', 'หญิง', ['class'=>'custom-control-label']) }}
											</div>
										</div>
									</div>
								</div>
								-->
								<div class="form-row">
									<div class="col-xs-12 col-sm-12 col-md-6 col-lg-1 col-xl-1 mb-3">
										{{ Form::label('sexInput', 'เพศ') }}
										<div class="form-group">
											{{ Form::select('sexInput', [
												'null'=>'-- โปรดเลือก --',
												'male'=>'ชาย',
												'female'=>'หญิง'],
												null,
												['class'=>'custom-select'])
											}}
										</div>
									</div>
									<div class="col-xs-12 col-sm-12 col-md-6 col-lg-1 col-xl-1 mb-3">
										{{ Form::label('birthDateInput', 'ว/ด/ป เกิด') }}
										{{ Form::text('birthDateInput', null, [
											'class'=>'form-control',
											'id'=>'birthDateInput',
											'placeholder'=>'dateOfBirth',
											'required'=>'required'])
										}}
									</div>
									<div class="col-xs-12 col-sm-12 col-md-4 col-lg-1 col-xl-1 mb-3">
										{{ Form::label('ageYearInput', 'อายุ/ปี') }}
										{{ Form::number('ageYearInput', 0, [
											'class'=>'form-control',
											'id'=>'ageInput',
											'placeholder'=>'Year',
											'required'=>'required'])
										}}
										<div class="valid-feedback">Looks good!</div>
									</div>
									<div class="col-xs-12 col-sm-12 col-md-4 col-lg-1 col-xl-1 mb-3">
										{{ Form::label('ageMonthInput', 'อายุ/เดือน') }}
										{{ Form::number('ageMonthInput', 0, [
											'class'=>'form-control',
											'id'=>'ageInput',
											'placeholder'=>'Month',
											'required'=>'required'])
										}}
									</div>
								</div>
								<div class="form-row">
									<div class="col-xs-12 col-sm-12 col-md-6 col-lg-2 col-xl-2 mb-3">
										{{ Form::label('nationalityInput', 'สัญชาติ') }}
										<div class="form-group">
											{{ Form::select('nationalityInput', [
												'null'=>'-- โปรดเลือก --',
												'Thai'=>'ไทย',
												'Burmese'=>'พม่า',
												'Laotian/Lao'=>'ลาว',
												'Cambodian'=>'กัมพูชา',
												'Vietnamese'=>'เวียดนาม',
												'Bruneian'=>'บรูไน ดารุสซาลาม',
												'Indonesian'=>'อินโดนีเซีย',
												'Malaysia'=>'มาเลเซีย',
												'Filipino'=>'ฟิลิปปินส์',
												'Singaporean'=>'สิงคโปร์',
												'Other'=>'อื่นๆ ระบุ'
												],
												null,
												['class'=>'custom-select'])
											}}
										</div>
										<div class="valid-feedback">Looks good!</div>
									</div>
									<div class="col-xs-12 col-sm-12 col-md-4 col-lg-2 col-xl-2 mb-3">
										{{ Form::label('otherNationalityInput', 'สัญชาติ อื่นๆ ระบุ ') }}
										{{ Form::text('otherNationalityInput', null, [
											'class'=>'form-control',
											'id'=>'otherNationality_input',
											'placeholder'=>'สัญชาติอื่นๆ'])
										}}
									</div>
								</div>
								<div class="form-row">
									<div class="col-xs-12 col-sm-12 col-md-6 col-lg-4 col-xl-4 mb-3">
										{{ Form::label('hospitalInput', 'โรงพยาบาล') }}
										{{ Form::text('hospitalInput', null, [
											'class'=>'form-control',
											'id'=>'hospital_input',
											'placeholder'=>'โรงพยาบาล'])
										}}
									</div>
								</div>
								<div class="form-row">
									<div class="col-xs-12 col-sm-12 col-md-6 col-lg-2 col-xl-2 mb-3">
										{{ Form::label('houseNoInput', 'ที่อยู่ปัจจุบัน/ขณะป่วย เลขที่') }}
										{{ Form::text('houseNoInput', null, [
											'class'=>'form-control',
											'id'=>'houseNo_input',
											'placeholder'=>'บ้านเลขที่'])
										}}
									</div>
									<div class="col-xs-12 col-sm-12 col-md-6 col-lg-1 col-xl-1 mb-3">
										{{ Form::label('villageNoInput', 'หมู่ที่') }}
										{{ Form::text('villageNoInput', null, [
											'class'=>'form-control',
											'id'=>'villageNo_input',
											'placeholder'=>'หมู่ที่'])
										}}
									</div>
									<div class="col-xs-12 col-sm-12 col-md-6 col-lg-3 col-xl-3 mb-3">
										{{ Form::label('villageInput', 'หมู่บ้าน') }}
										{{ Form::text('villageInput', null, [
											'class'=>'form-control',
											'id'=>'village_input',
											'placeholder'=>'หมู่บ้าน'])
										}}
									</div>
									<div class="col-xs-12 col-sm-12 col-md-6 col-lg-3 col-xl-3 mb-3">
										{{ Form::label('laneInput', 'ซอย') }}
										{{ Form::text('laneInput', null, [
											'class'=>'form-control',
											'id'=>'lane_input',
											'placeholder'=>'ซอย'])
										}}
									</div>
								</div>
								<div class="form-row">
									<div class="col-xs-12 col-sm-12 col-md-6 col-lg-2 col-xl-2 mb-3">
										{{ Form::label('subDistrictInput', 'ตำบล') }}
										<div class="form-group">
											{{ Form::select('subDistrictInput', [
												'null'=>'-- โปรดเลือก --'
												],
												null,
												['class'=>'custom-select'])
											}}
										</div>
									</div>
									<div class="col-xs-12 col-sm-12 col-md-6 col-lg-2 col-xl-2 mb-3">
										{{ Form::label('districtInput', 'อำเภอ') }}
										<div class="form-group">
											{{ Form::select('districtInput', [
												'null'=>'-- โปรดเลือก --'
												],
												null,
												['class'=>'custom-select'])
											}}
										</div>
									</div>
									<div class="col-xs-12 col-sm-12 col-md-6 col-lg-2 col-xl-2 mb-3">
										{{ Form::label('provinceInput', 'จังหวัด') }}
										<div class="form-group">
											{{ Form::select('provinceInput', [
												'null'=>'-- โปรดเลือก --'
												],
												null,
												['class'=>'custom-select'])
											}}
										</div>
									</div>
								</div>

								<div class="form-row">
									<div class="col-xs-12 col-sm-12 col-md-4 col-lg-2 col-xl-2 mb-3">
										{{ Form::label('occupationInput', 'อาชีพ') }}
										<div class="form-group">
											{{ Form::select('occupationInput', [
												'null'=>'-- โปรดเลือก --',
												'-1'=>'อื่นๆ ระบุ'
												],
												null,
												['class'=>'custom-select'])
											}}
										</div>
									</div>
									<div class="col-xs-12 col-sm-12 col-md-4 col-lg-4 col-xl-4 mb-3">
										{{ Form::label('occupationOtherInput', 'อาชีพ อื่นๆ ระบุ') }}
										{{ Form::text('occupationOtherInput', null, [
											'class'=>'form-control',
											'id'=>'occ_input',
											'placeholder'=>'อาชีพ อื่นๆ'])
										}}
									</div>
								</div>
							</div>
						</fieldset>
						<fieldset>
							<legend>2. ข้อมูลทางคลินิก</legend>
							<div class="bd-callout">
								<div class="form-row">
									<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 mb-3">
										{{ Form::label('patientInput', 'ผู้ป่วย') }}
										<div class="form-group">
											<div class="custom-control custom-checkbox custom-control-inline">
												{{ Form::checkbox('patientCheckbox', 'opd', false, ['class'=>'custom-control-input', 'id'=>'opdCheckbox']) }}
												{{ Form::label('opdCheckbox', 'ผู้ป่วยนอก (OPD)/ILI', ['class'=>'custom-control-label custom-label']) }}
											</div>
											<div class="custom-control custom-checkbox custom-control-inline">
												{{ Form::checkbox('patientCheckbox', 'ipd', false, ['class'=>'custom-control-input', 'id'=>'ipdCheckbox']) }}
												{{ Form::label('ipdCheckbox', 'ผู้ป่วยใน (IPD)/SARI', ['class'=>'custom-control-label custom-label']) }}
											</div>
											<div class="custom-control custom-checkbox custom-control-inline">
												{{ Form::checkbox('patientCheckbox', 'icu', false, ['class'=>'custom-control-input', 'id'=>'icuCheckbox']) }}
												{{ Form::label('icuCheckbox', 'ผู้ป่วยหนัก/ICU', ['class'=>'custom-control-label custom-label']) }}
											</div>
										</div>
									</div>
								</div>
								<div class="form-row">
									<div class="col-xs-12 col-sm-12 col-md-6 col-lg-2 col-xl-2 mb-3">
										{{ Form::label('sickDateInput', 'วันที่เริ่มป่วย') }}
										{{ Form::text('sickDateInput', null, [
											'class'=>'form-control',
											'id'=>'sickDateInput',
											'required'=>'required'])
										}}
									</div>
									<div class="col-xs-12 col-sm-12 col-md-6 col-lg-2 col-xl-2 mb-3">
										{{ Form::label('sickDateInput', 'วันที่รักษาครั้งแรก') }}
										{{ Form::text('sickDateInput', null, [
											'class'=>'form-control',
											'id'=>'sickDateInput',
											'required'=>'required'])
										}}
									</div>
									<div class="col-xs-12 col-sm-12 col-md-6 col-lg-2 col-xl-2 mb-3">
										{{ Form::label('sickDateInput', 'วันที่นอนโรงพยาบาล') }}
										{{ Form::text('sickDateInput', null, [
											'class'=>'form-control',
											'id'=>'sickDateInput',
											'required'=>'required'])
										}}
									</div>
								</div>
								<div class="form-row">
									<div class="col-xs-12 col-sm-12 col-md-6 col-lg-2 col-xl-2 mb-3">
										{{ Form::label('sickDateInput', 'อุณหภูมิร่างกายแรกรับ') }}
										{{ Form::text('sickDateInput', null, [
											'class'=>'form-control',
											'id'=>'sickDateInput',
											'required'=>'required'])
										}}
									</div>
								</div>
								<div class="form-row">
									<div class="col-xs-12 col-sm-12 col-md-6 col-lg-12 col-xl-12 mb-3">
										{{ Form::label('sickDateInput', 'อาการและอาการแสดง') }}
										<div class="table-responsive">
											<table class="table">
												<thead>
													<tr>
														<th scope="col">อาการ</th>
														<th scope="col">มี</th>
														<th scope="col">ไม่มี</th>
														<th scope="col">ไม่ทราบ</th>
													</tr>
												</thead>
												<tbody>
													<tr>
														<td>ไข้</td>
														<td>
															<div class="custom-control custom-checkbox">
																{{ Form::checkbox('feverishCheckbox', 'N', false, ['class'=>'custom-control-input feverishInput', 'id'=>'feverishYes']) }}
																{{ Form::label('feverishYes', '&nbsp;', ['class'=>'custom-control-label']) }}
															</div>
														</td>
														<td>
															<div class="custom-control custom-checkbox">
																{{ Form::checkbox('feverishCheckbox', 'N', false, ['class'=>'custom-control-input feverishInput', 'id'=>'feverishNo']) }}
																{{ Form::label('feverishNo', '&nbsp;', ['class'=>'custom-control-label']) }}
															</div>
														</td>
														<td>
															<div class="custom-control custom-checkbox">
																{{ Form::checkbox('feverishCheckbox', 'N', false, ['class'=>'custom-control-input feverishInput', 'id'=>'feverishUnknown']) }}
																{{ Form::label('feverishUnknown', '&nbsp;', ['class'=>'custom-control-label']) }}
															</div>
														</td>
													</tr>
													<tr>
														<td>ไอ (cough)</td>
														<td>
															<div class="custom-control custom-checkbox">
																{{ Form::checkbox('coughCheckbox', 'N', false, ['class'=>'custom-control-input coughInput', 'id'=>'coughYes']) }}
																{{ Form::label('coughYes', '&nbsp;', ['class'=>'custom-control-label']) }}
															</div>
														</td>
														<td>
															<div class="custom-control custom-checkbox">
																{{ Form::checkbox('coughCheckbox', 'N', false, ['class'=>'custom-control-input coughInput', 'id'=>'coughNo']) }}
																{{ Form::label('coughNo', '&nbsp;', ['class'=>'custom-control-label']) }}
															</div>
														</td>
														<td>
															<div class="custom-control custom-checkbox">
																{{ Form::checkbox('coughCheckbox', 'N', false, ['class'=>'custom-control-input coughInput', 'id'=>'coughUnknown']) }}
																{{ Form::label('coughUnknown', '&nbsp;', ['class'=>'custom-control-label']) }}
															</div>
														</td>
													</tr>
													<tr>
														<td>เจ็บคอ (sore throat)</td>
														<td>
															<div class="custom-control custom-checkbox">
																{{ Form::checkbox('soreThroatCheckbox', 'N', false, ['class'=>'custom-control-input soreThroatInput', 'id'=>'soreThroatYes']) }}
																{{ Form::label('soreThroatYes', '&nbsp;', ['class'=>'custom-control-label']) }}
															</div>
														</td>
														<td>
															<div class="custom-control custom-checkbox">
																{{ Form::checkbox('coughCheckbox', 'N', false, ['class'=>'custom-control-input soreThroatInput', 'id'=>'soreThroatNo']) }}
																{{ Form::label('soreThroatNo', '&nbsp;', ['class'=>'custom-control-label']) }}
															</div>
														</td>
														<td>
															<div class="custom-control custom-checkbox">
																{{ Form::checkbox('soreThroatCheckbox', 'N', false, ['class'=>'custom-control-input soreThroatInput', 'id'=>'soreThroatUnknown']) }}
																{{ Form::label('soreThroatUnknown', '&nbsp;', ['class'=>'custom-control-label']) }}
															</div>
														</td>
													</tr>
												</tbody>
											</table>
										</div>
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
	$(document).ready(function(){
		$('.feverishInput').click(function() {
			$('.feverishInput').not(this).prop('checked', false);
		});
		$('.coughInput').click(function() {
			$('.coughInput').not(this).prop('checked', false);
		});
		$('.soreThroatInput').click(function() {
			$('.soreThroatInput').not(this).prop('checked', false);
		});
	});
	</script>
<script>
	// Example starter JavaScript for disabling form submissions if there are invalid fields
	(function() {
		'use strict';
		window.addEventListener('load', function() {
			// Fetch all the forms we want to apply custom Bootstrap validation styles to
			var forms = document.getElementsByClassName('needs-validation');
			// Loop over them and prevent submission
			var validation = Array.prototype.filter.call(forms, function(form) {
				form.addEventListener('submit', function(event) {
					if (form.checkValidity() === false) {
						event.preventDefault();
						event.stopPropagation();
					}
					form.classList.add('was-validated');
				}, false);
			});
		}, false);
		})();
</script>
@endsection
