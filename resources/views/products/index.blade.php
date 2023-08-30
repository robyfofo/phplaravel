@extends('layouts.app')

@section('content')

<div class="row mb-3">
	<div class="col-md-3 new">
		<a href="{{ route('products.create') }}" title="Inserisci un nuovo prodotto" class="btn btn-sm btn-primary">Nuovo Prodotto</a>
	</div>
	<div class="col-md-7 help-small-list"></div>
	<div class="col-md-2 help text-right"></div>
</div>

<div class="card">
	<div class="card-body">

		<form name="searchForm" id="searchFormID" role="form" method="GET" action="{{ route('products.index') }}">
			@csrf
			<div class="form-group row">

				<div class="col-sm-12 col-md-3 col-lg-3 col-xl-3">
					<div class="row">
						<div class="col-sm-12 col-md-3 col-lg-4 col-xl-4">
							<select name="itemsforpage" id="itemsforpage" class="form-select form-select-sm" onchange="this.form.submit();">
								<option @if (request()->session()->get('products itemsforpage') ==1) selected @endif value="1">1</option>
								<option @if (request()->session()->get('products itemsforpage')==5) selected @endif value="5">5</option>
								<option @if (request()->session()->get('products itemsforpage')==10) selected @endif value="10">10</option>
								<option @if (request()->session()->get('products itemsforpage')==25) selected @endif value="25">25</option>
								<option @if (request()->session()->get('products itemsforpage')==50) selected @endif value="50">50</option>
								<option @if (request()->session()->get('products itemsforpage')==100) selected @endif value="100">100</option>
							</select>
						</div>
						<label for="itemsforpageID" class="col-sm-12 col-md-6 col-lg-6 col-xl-6 col-form-label col-form-label-sm">Voci per pagina</label>
					</div>
				</div>

				<div class="col-sm-12 col-md-5 col-lg-6 col-xl-6">
					<div class="row">

				

						{{ Form::label('categories_id', 'Categoria', ['class'=>'col-sm-12 col-md-3 col-lg-3 col-xl-3 col-form-label col-form-label-sm responsive-text-right']) }}
						<div class="col-sm-12 col-md-9 col-lg-9 col-xl-9">
								@php
									$level = 0;
									$levelstr = '';
									$selected = Request()->session()->get('products categories_id');
								@endphp
							<select name="categories_id" id="category_id" class="form-select form-select-sm" onchange="this.form.submit();">
								<option value=""></option>
									@foreach ($categories as $category)
										@include('layouts.subcategoriesselect', [
										'cat' => $category,
										'level' => $level,
										'levelstr' => $levelstr,
										'selected' => $selected
										])
									@endforeach
							</select>
						</div>
					</div>
				</div>

				<div class="col-sm-12 col-md-4 col-lg-3 col-xl-3">
					<div class="row text-right">
						<label for="searchfromtableID" class="col-sm-12 col-md-3 col-lg-6 col-xl-6 col-form-label col-form-label-sm responsive-text-right">Cerca</label>
						<div class="col-sm-12 col-md-9 col-lg-6 col-xl-6">
							<input type="search" name="searchfromtable" id="searchfromtableID" class="form-control form-control-sm" value="{{ request()->session()->get('products searchfromtable') }}" onchange="this.form.submit();">
						</div>
					</div>
				</div>

			</div>
		</form>

		<div class="table-responsive text-nowrap my-2">
			<table class="table table-sm table-bordered listData">
				<thead>
					<tr>
						<th>id</th>
						<th>Categoria</th>
						<th>Titolo</th>
						<th>Contenuto</th>
						<th>Prezzo U.tà</th>
						<th>Action</th>
					</tr>
				</thead>
				<tbody>
					@foreach($products as $product)
					<tr>
						<td>{{ $product->id }}</td>
						<td>{{ $product->category }} (<small>{{ $product->categories_id }}</small>)</td>
						<td>{{ $product->title }}</td>
						<td>{{ $product->content }}</td>
						<td>{{ $product->price_unity }}</td>

						<td class="actions text-end">
							<a href="javascript:void(0);" data-id="{{ $product->id }}" data-table="products" data-label="Prodotto" data-labelsex="o" data-token="{{ csrf_token() }}" class="setactive" title=""><i class="bx bx-{{ $product->active == 1 ? 'lock-open-alt' : 'lock-alt' }}{{ $product->active == 1 ? ' text-success' : ' text-danger' }}"></i></a><a class="" href="{{ route('products.edit', [$product->id]) }}" title="Modifica Prodotto"><i class='bx bx-edit'></i></a>
							{!! Form::open(['style'=>'','class'=>'float-end','method' => 'DELETE','route' => ['products.destroy', $product->id]]) !!}
							<a class="deleteitemformbutton" href="#" title="Cancella prodotto"><i class='bx bx-trash'></i></a>
							{!! Form::close() !!}
						</td>
					</tr>

					@endforeach
				</tbody>
			</table>
		</div>

		{!! $products->links('pagination::bootstrap-5') !!}

	</div>
</div>
@stop