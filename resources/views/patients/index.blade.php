@extends('layouts.index')
@section('topScript')
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
								<div class="bd-callout bd-callout-info" style="margin-top:0;">
									@include('patients.component-general-data')
								</div><!-- bd-callout -->
							</div><!-- card body -->
						</div><!-- card -->
						<div class="card">
							<div class="card-body">
								<div class="bd-callout bd-callout-danger">
									@include('patients.component-clinical-data')
								</div><!-- bd-callout -->
							</div><!-- card body -->
						</div><!-- card -->
						<div class="card">
							<div class="card-body">
								<div class="bd-callout bd-callout-custom-5">
									@include('patients.component-risk-history-tbl')
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
$(document).ready(function() {
	/* title name */
	$('#title_name_input').change(function() {
		if ($('select#title_name_input').val() === 'other') {
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
	$('#nationallity_input').change(function() {
		if ($('select#nationallity_input').val() === 'other') {
			$('#otherNationality_input').prop('disabled', false);
		} else {
			$('#otherNationality_input').val('');
			$('#otherNationality_input').prop('disabled', true);
		}
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

});

</script>
@endsection
