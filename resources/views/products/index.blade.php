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
						<li class="breadcrumb-item active" aria-current="page">Manage</li>
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
							<h4 class="card-title">Products</h4>
							<h5 class="card-subtitle">ID Flu-BOE</h5>
						</div>
					</div>
					<div class="my-4">
						@can('product-create')
							<a class="btn btn-success" href="{{ route('products.create') }}"> Create New Product</a>
						@endcan
					</div>
					@if ($message = Session::get('success'))
						<div class="alert alert-success">
							<p>{{ $message }}</p>
						</div>
					@endif
					<table class="table table-bordered">
						<tr>
							<th>No</th>
							<th>Name</th>
							<th>Details</th>
							<th width="280px">Action</th>
						</tr>
						@foreach ($products as $product)
							<tr>
								<td>{{ ++$i }}</td>
								<td>{{ $product->name }}</td>
								<td>{{ $product->detail }}</td>
								<td>
									<form action="{{ route('products.destroy',$product->id) }}" method="POST">
										<a class="btn btn-info" href="{{ route('products.show',$product->id) }}">Show</a>
										@can('product-edit')
											<a class="btn btn-primary" href="{{ route('products.edit',$product->id) }}">Edit</a>
										@endcan
										@csrf
										@method('DELETE')
										@can('product-delete')
											<button type="submit" class="btn btn-danger">Delete</button>
										@endcan
									</form>
								</td>
							</tr>
						@endforeach
					</table>
					{!! $products->links() !!}
				</div>
			</div>
		</div>
	</div>
</div>
@endsection
