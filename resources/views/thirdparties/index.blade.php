@extends('layouts.app')

@section('content')

<div class="row mb-3">
	<div class="col-md-3 new">
		<a href="{{ route('thirdparties.create') }}" title="Inserisci un nuovo Cliente" class="btn btn-sm btn-primary">Nuovo Cliente</a>
	</div>
	<div class="col-md-7 help-small-list"></div>
	<div class="col-md-2 help text-right"></div>
</div>

<div class="card">
	<div class="card-body">

		<form name="searchForm" id="searchFormID" role="form" method="GET" action="{{ route('thirdparties.index') }}">
			@csrf
			<div class="form-group row">
				<div class="col-md-1">
					<select name="itemsforpage" id="itemsforpage" class="form-select form-select-sm" onchange="this.form.submit();">
						<option @if (request()->session()->get('thirdparties itemsforpage') ==1) selected @endif value="1">1</option>
						<option @if (request()->session()->get('thirdparties itemsforpage')==5) selected @endif value="5">5</option>
						<option @if (request()->session()->get('thirdparties itemsforpage')==10) selected @endif value="10">10</option>
						<option @if (request()->session()->get('thirdparties itemsforpage')==25) selected @endif value="25">25</option>
						<option @if (request()->session()->get('thirdparties itemsforpage')==50) selected @endif value="50">50</option>
						<option @if (request()->session()->get('thirdparties itemsforpage')==100) selected @endif value="100">100</option>
					</select>
				</div>
				<label for="itemsforpageID" class="col-md-2 col-form-label form-control-sm">Voci per pagina</label>
		
				<label for="searchfromtableID" class="offset-md-6 col-md-1 col-form-label form-control-sm" style="text-align:right;">Cerca</label>
				<div class="col-md-2">
					<input type="search" name="searchfromtable" id="searchfromtableID" class="form-control form-control-sm" value="{{ request()->session()->get('thirdparties searchfromtable') }}" onchange="this.form.submit();">
				</div>
			</div>
		</form>

		<div class="table-responsive text-nowrap my-2">
      <table class="table table-sm table-bordered listData">
				<thead>
					<tr>
						<th>id</th>
						<th>Categoria</th>
						<th>Ragione Sociale</th>
						<th>Nome e Cognome</th>
						<th>Email</th>
						<th>Action</th>
					</tr>
				</thead>
				<tbody>
					@foreach($thirdparties as $thirdparty)
						<tr>
							<td>{{ $thirdparty->id }}</td>
							<td>{{ $thirdparty->category }} (<small>{{ $thirdparty->categories_id }}</small>)</td>
							<td>{{ $thirdparty->ragione_sociale }}</td>
							<td>{{ $thirdparty->name }}, {{ $thirdparty->surname }}</td>
							<td>{{ $thirdparty->email }}</td>
						
							<td class="actions text-end">
								<a href="javascript:void(0);" data-id="{{ $thirdparty->id }}" data-table="thirdparties" data-label="Cliente" data-labelsex="o" data-token="{{ csrf_token() }}" class="setactive" title=""><i class="bx bx-{{ $thirdparty->active == 1 ? 'lock-open-alt' : 'lock-alt' }}{{ $thirdparty->active == 1 ? ' text-success' : ' text-danger' }}"></i></a><a class="" href="{{ route('thirdparties.edit', [$thirdparty->id]) }}" title="Modifica Cliente"><i class='bx bx-edit'></i></a>
								{!! Form::open(['style'=>'','class'=>'float-end','method' => 'DELETE','route' => ['thirdparties.destroy', $thirdparty->id]]) !!}
								<a class="deleteitemformbutton" href="#" title="Cancella Cliente"><i class='bx bx-trash'></i></a>
								{!! Form::close() !!}
							</td>
						</tr>

					@endforeach
				</tbody>
			</table>
		</div>

		{!! $thirdparties->links('pagination::bootstrap-5') !!}

	</div>
</div>
@stop
