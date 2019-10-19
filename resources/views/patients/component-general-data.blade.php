<h1 class="text-info">1. ข้อมูลทั่วไปของผู้ป่วย</h1>
<div class="form-row">
	<div class="col-xs-12 col-sm-12 col-md-4 col-lg-4 col-xl-4 mb-3">
		<label for="formIndexInput">รหัสแบบฟอร์ม</label>
		<div class="input-group-append">
			<input type="text" name="formIndexInput" class="form-control" id="form_index_input" value="{{ $patient[0]->lab_code }}" readonly required>
		</div>
	</div>
</div>
<div class="form-row">
	<div class="col-xs-12 col-sm-12 col-md-6 col-lg-4 col-xl-4 mb-3">
		<label for="titleName">คำนำหน้าชื่อ</label>
		<select name="titleNameInput" class="form-control selectpicker show-tick select-title-name" id="title_name_input">
			<option value="">{{ $patient[0]->title_name }}</option>
			<option value="0">-- โปรดเลือก --</option>
			@php
				$titleName->each(function ($item, $key) {
					echo "<option value=\"".$item->id."\">".$item->title_name."</option>";
				});
			@endphp
		</select>
	</div>
	<div class="col-xs-12 col-sm-12 col-md-6 col-lg-4 col-xl-4 mb-3">
		<label for="otherTitleNameInput">คำนำหน้าชื่ออื่นๆ ระบุ</label>
		<input type="text" name="otherTitleNameInput" class="form-control" id="other_title_name_input" placeholder="คำนำหน้าชื่ออื่นๆ" disabled>
	</div>
</div>
<div class="form-row">
	<div class="col-xs-12 col-sm-12 col-md-6 col-lg-4 col-xl-4 mb-3">
		<label for="firstNameInput">ชื่อจริง</label>
		<input type="text" name="firstNameInput" class="form-control" id="first_name_input" placeholder="ชื่อ" required>
		<div class="valid-feedback">Looks good!</div>
	</div>
	<div class="col-xs-12 col-sm-12 col-md-6 col-lg-4 col-xl-4 mb-3">
		<label for="lastNameInput">นามสกุล</label>
		<input type="text" name="lastNameInput" class="form-control" id="last_name_input" placeholder="นามสกุล" required>
		<div class="valid-feedback">Looks good!</div>
	</div>
</div>
<div class="form-row">
	<div class="col-xs-12 col-sm-12 col-md-6 col-lg-2 col-xl-2 mb-3">
		<label for="hnInput">HN</label>
		<input type="text" name="hnInput" class="form-control" id="hn_input" placeholder="HN" required>
		<div class="valid-feedback">Looks good!</div>
	</div>
	<div class="col-xs-12 col-sm-12 col-md-6 col-lg-2 col-xl-2 mb-3">
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
		<input type="number" name="ageYearInput" class="form-control" id="age_year_input" value="0" min="0" max="120" required>
	</div>
	<div class="col-xs-12 col-sm-12 col-md-4 col-lg-1 col-xl-1 mb-3">
		<label for="ageMonthInput">อายุ/เดือน</label>
		<input type="number" name="ageMonthInput" class="form-control" id="age_month_input" value="0" min="0" max="12" required>
	</div>
</div>
<div class="form-row">
	<div class="col-xs-12 col-sm-12 col-md-6 col-lg-2 col-xl-2 mb-3">
		<label for="nationalityInput">สัญชาติ</label>
		<select name="nationalityInput" class="custom-select" id="nationallity_input">
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
			<option value="Other">อื่นๆ ระบุ</option>
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
