@extends('layouts.index')
@section('custom-style')
<link rel="stylesheet" type="text/css" href="{{ URL::asset('assets/libs/bootstrap-select-1.13.9/dist/css/bootstrap-select.min.css') }}">
@endsection
@section('internal-style')
<style>
.page-wrapper {
	background: #fff !important;
}
</style>
@endsection
@section('top-script')
<script src="{{ URL::asset('assets/libs/jquery/dist/jquery.min.js') }}"></script>
@section('contents')
<div class="page-breadcrumb bg-light pb-2">
	<div class="row">
		<div class="col-12 d-flex no-block align-items-center">
			<h4 class="page-title">Statistics</h4>
			<div class="ml-auto text-right">
				<nav aria-label="breadcrumb">
					<ol class="breadcrumb">
						<li class="breadcrumb-item"><a href="#">Home</a></li>
						<li class="breadcrumb-item active" aria-current="page">Statistics</li>
					</ol>
				</nav>
			</div>
		</div>
	</div>
</div>
<div class="container-fluid">
	<div class="row mb-4">
		<div class="col-lg-12">
			<div class="row">
				<div class="col-3">
					<div class="bg-primary p-10 text-white text-center">
						<i class="mdi mdi-account m-b-5 font-24"></i>
						<h3 class="m-b-0 m-t-5">{{ $counter['cntToday'] }}</h3>
						<h5 class="font-light">Today</h5>
					</div>
				</div>
				<div class="col-3">
					<div class="bg-cyan p-10 text-white text-center">
						<i class="mdi mdi-account m-b-5 font-24"></i>
						<h3 class="m-b-0 m-t-5">{{ $counter['cntYesterday'] }}</h3>
						<h5 class="font-light">Yesterday</h5>
					</div>
				</div>
				<div class="col-3">
					<div class="bg-danger p-10 text-white text-center">
						<i class="mdi mdi-account m-b-5 font-24"></i>
						<h3 class="m-b-0 m-t-5">{{ ((int)$counter['cntThisMonth']+(int)$counter['cntToday']) }}</h3>
						<h5 class="font-light">This Month</h5>
					</div>
				</div>
				<div class="col-3">
					<div class="bg-success p-10 text-white text-center">
						<i class="mdi mdi-account m-b-5 font-24"></i>
						<h3 class="m-b-0 m-t-5">{{ ((int)$counter['cntThisYear']+(int)$counter['cntToday']) }}</h3>
						<h5 class="font-light">This Year</h5>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection
@section('bottom-script')
@endsection
