@extends('layouts.index')
@section('contents')
<div class="page-breadcrumb bg-light">
	<div class="row">
		<div class="col-12 d-flex no-block align-items-center">
			<h4 class="page-title"><span style="display:none;">Users</span></h4>
			<div class="ml-auto text-right">
				<nav aria-label="breadcrumb">
					<ol class="breadcrumb">
						<li class="breadcrumb-item"><a href="{{ route('products.index') }}">Products</a></li>
						<li class="breadcrumb-item active" aria-current="page">Create</li>
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
					<div class="d-md-flex align-items-center" style="border-bottom:1px solid #EAEAEA">
						<div>
							<h4 class="card-title">Create new product</h4>
							<h5 class="card-subtitle">ID Flu-BOE</h5>
						</div>
					</div>
					<div class="my-4">
						@if ($errors->any())
							<div class="alert alert-danger">
								<strong>Whoops!</strong> There were some problems with your input.<br><br>
								<ul>
									@foreach ($errors->all() as $error)
										<li>{{ $error }}</li>
									@endforeach
								</ul>
							</div>
						@endif
						<form action="{{ route('products.store') }}" method="POST">
							@csrf
							<div class="row">
								<div class="col-xs-12 col-sm-12 col-md-12">
									<div class="form-group">
										<strong>Name:</strong>
										<input type="text" name="name" class="form-control" placeholder="Name">
									</div>
								</div>
								<div class="col-xs-12 col-sm-12 col-md-12">
									<div class="form-group">
										<strong>Detail:</strong>
										<textarea class="form-control" style="height:150px" name="detail" placeholder="Detail"></textarea>
									</div>
								</div>
								<div class="col-xs-12 col-sm-12 col-md-12">
									<button type="submit" class="btn btn-primary">Submit</button>
								</div>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection
