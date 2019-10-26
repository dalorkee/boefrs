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
