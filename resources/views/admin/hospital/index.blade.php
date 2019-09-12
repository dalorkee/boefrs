@extends('layouts.index')
@section('topScript')
@endsection
@section('contents')
<div class="page-breadcrumb bg-light">
	<div class="row">
		<div class="col-12 d-flex no-block align-items-center">
			<h4 class="page-title"><span style="display:none;">Print</span></h4>
			<div class="ml-auto text-right">
				<nav aria-label="breadcrumb">
					<ol class="breadcrumb">
						<li class="breadcrumb-item"><a href="#">Home</a></li>
						<li class="breadcrumb-item active" aria-current="page">Print</li>
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
							<div class="card-body border-top">
								<div class="form-row">
									<div class="col-md-6 col-lg-2 col-xlg-3">
										<div class="card card-hover">
											<div class="box bg-danger text-center">
												<h1 class="font-light text-white"><i class="mdi mdi-printer"></i></h1>
												<h4 class="text-white"><a href="{{ route('code') }}" class="link-color-white">สร้างรหัสแบบฟอร์ม</a></h4>
											</div>
										</div>
									</div>
									<div class="col-md-6 col-lg-2 col-xlg-3">
										<div class="card card-hover">
											<div class="box bg-success text-center">
												<h1 class="font-light text-white"><i class="mdi mdi-content-save"></i></h1>
												<h4 class="text-white"><a href="{{ route('hospital') }}" class="link-color-white">บันทึกข้อมูลเข้าสู่ระบบ</a></h4>
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
@section('script')
<script>
$(document).ready(function() {


});

</script>
@endsection
