<h1 class="text-danger">2. ข้อมูลทางคลินิก</h1>
<div class="form-row">
	<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 mb-3">
		<label for="patientInput">ผู้ป่วย</label>
		<div>
			<div class="custom-control custom-checkbox custom-control-inline">
				<input type="checkbox" name="patientCheckbox" class="custom-control-input" id="opdCheckbox">
				<label for="opdCheckbox" class="custom-control-label normal-label">ผู้ป่วยนอก (OPD)/ILI</label>
			</div>
			<div class="custom-control custom-checkbox custom-control-inline">
				<input type="checkbox" name="patientCheckbox" class="custom-control-input" id="ipdCheckbox">
				<label for="ipdCheckbox" class="custom-control-label normal-label">ผู้ป่วยใน (IPD)/SARI</label>
			</div>
			<div class="custom-control custom-checkbox custom-control-inline">
				<input type="checkbox" name="patientCheckbox" class="custom-control-input" id="icuCheckbox">
				<label for="icuCheckbox" class="custom-control-label normal-label">ผู้ป่วยหนัก/ICU</label>
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
				<label for="lungXrayNo" class="custom-control-label normal-label">ไม่ได้ทำ</label>
			</div>
			<div class="custom-control custom-checkbox custom-control-inline">
				<input type="checkbox" name="lungXrayInput" class="custom-control-input" id="lungXrayYes">
				<label for="lungXrayYes" class="custom-control-label normal-label">ทำ</label>
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
				<label for="influRapidCheckboxNo" class="custom-control-label normal-label">ไม่ตรวจ</label>
			</div>
			<div class="custom-control custom-checkbox custom-control-inline">
				<input type="checkbox" name="influenzaRapidCheckbox" class="custom-control-input" id="influRapidCheckboxYes">
				<label for="influRapidCheckboxYes" class="custom-control-label normal-label">ตรวจ</label>
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
				<label for="rapidTestNagative" class="custom-control-label normal-label">Nagative</label>
			</div>
			<div class="custom-control custom-checkbox custom-control-inline">
				<input type="checkbox" name="rapidTestResultCheckbox" class="custom-control-input" id="rapidTestPositiveFluA">
				<label for="rapidTestPositiveFluA" class="custom-control-label normal-label">Positive Flu A</label>
			</div>
			<div class="custom-control custom-checkbox custom-control-inline">
				<input type="checkbox" name="rapidTestResultCheckbox" class="custom-control-input" id="rapidTestPositiveFluB">
				<label for="rapidTestPositiveFluB" class="custom-control-label normal-label">Positive Flu B</label>
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
				<label for="influenzaVaccNo" class="custom-control-label normal-label">ไม่เคย</label>
			</div>
			<div class="custom-control custom-checkbox custom-control-inline">
				<input type="checkbox" name="influenzaVaccine" class="custom-control-input" id="influenzaVaccYes">
				<label for="influenzaVaccYes" class="custom-control-label normal-label">เคย</label>
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
				<label for="virusMedicineNo" class="custom-control-label normal-label">ไม่ให้</label>
			</div>
			<div class="custom-control custom-checkbox custom-control-inline">
				<input type="checkbox" name="virusMedicine" class="custom-control-input" id="virusMedicineYes">
				<label for="virusMedicineYes" class="custom-control-label normal-label">ให้</label>
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
			@include('admin.hospital.component-health-tbl')
		</div>
	</div>
</div>
