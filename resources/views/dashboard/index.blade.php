@extends('layouts.index')
@section('top-script')
<!-- Charts js Files -->
	{{ Html::script('assets/libs/flot/excanvas.js') }}
	{{ Html::script('assets/libs/flot/jquery.flot.js') }}
	{{ Html::script('assets/libs/flot/jquery.flot.pie.js') }}
	{{ Html::script('assets/libs/flot/jquery.flot.time.js') }}
	{{ Html::script('assets/libs/flot/jquery.flot.stack.js') }}
	{{ Html::script('assets/libs/flot/jquery.flot.crosshair.js') }}
	{{ Html::script('assets/libs/flot.tooltip/js/jquery.flot.tooltip.min.js') }}
	{{ Html::script('dist/js/pages/chart/chart-page-init.js') }}
	{{ Html::script('assets/extra-libs/chart.js/Chart.min.js') }}
	{{ Html::script('assets/extra-libs/chart.js/utils.js') }}
@endsection
@section('contents')
<div class="page-breadcrumb">
	<div class="row">
		<div class="col-12 d-flex no-block align-items-center">
			<h4 class="page-title">Dashboard</h4>
			<div class="ml-auto text-right">
				<nav aria-label="breadcrumb">
					<ol class="breadcrumb">
						<li class="breadcrumb-item"><a href="#">Home</a></li>
						<li class="breadcrumb-item active" aria-current="page">Dashboard</li>
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
					<div class="row">
						<div class="col-lg-12">
							<div class="row">
								<div class="col-3">
									<div class="bg-cyan p-10 text-white text-center">
										<i class="fas fa-flask m-b-5 font-24"></i>
										<h3 class="m-b-0 m-t-5">3,554</h3>
									 	<h5 class="font-light">จำนวนที่ส่งตรวจ</h5>
									</div>
								</div>
								 <div class="col-3">
									<div class="bg-warning p-10 text-white text-center">
										<i class="fab fa-odnoklassniki m-b-5 font-24"></i>
										<h3 class="m-b-0 m-t-5">192</h3>
										<h5 class="font-light">A/H1 2009</h5>
									</div>
								</div>
								<div class="col-3">
									<div class="bg-danger p-10 text-white text-center">
										<i class="fab fa-odnoklassniki m-b-5 font-24"></i>
										<h3 class="m-b-0 m-t-5">311</h3>
										<h5 class="font-light">A/H3</h5>
									</div>
								</div>
								<div class="col-3">
									<div class="bg-orange p-10 text-white text-center">
										<i class="fab fa-odnoklassniki m-b-5 font-24"></i>
										<h3 class="m-b-0 m-t-5">754</h3>
										<h5 class="font-light">A/H3</h5>
									</div>
								</div>

								<div class="col-3 m-t-15">
									<div class="bg-dark p-10 text-white text-center">
									   <h5 class="m-b-0 m-t-5">252</h5>
									   <small class="font-light">ภาคเหนือ</small>
									</div>
								</div>
								<div class="col-3 m-t-15">
									<div class="bg-dark p-10 text-white text-center">
									   <h5 class="m-b-0 m-t-5">1,527</h5>
									   <small class="font-light">ภาคกลาง</small>
									</div>
								</div>
								<div class="col-3 m-t-15">
									<div class="bg-dark p-10 text-white text-center">
									   <h5 class="m-b-0 m-t-5">1,317</h5>
									   <small class="font-light">ภาคตะวันออกเฉียงเหนือ</small>
									</div>
								</div>
								<div class="col-3 m-t-15">
									<div class="bg-dark p-10 text-white text-center">
									   <h5 class="m-b-0 m-t-5">458</h5>
									   <small class="font-light">ภาคใต้</small>
									</div>
								</div>
							</div>
						</div>
						<!-- column -->
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="row">
		<div class="col-md-12">
			<div class="card">
				<div class="card-body">
					@include('dashboard.fluStackChart')
				</div>
			</div>
		</div>
	</div>
</div>
@endsection
