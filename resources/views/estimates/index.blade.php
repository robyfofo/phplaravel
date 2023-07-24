@extends('layouts.app')

@section('content')

<div class="row mb-3">
	<div class="col-md-3 new">
		<a href="{{ route('estimates.create') }}" title="Inserisci un nuovo progetto" class="btn btn-sm btn-primary">Nuovo Preventivo</a>
	</div>
	<div class="col-md-7 help-small-list"></div>
	<div class="col-md-2 help text-right"></div>
</div>

<div class="card">
	<div class="card-body">

		<form name="searchForm" id="searchFormID" role="form" method="GET" action="{{ route('estimates.index') }}">
			@csrf
			<div class="form-group row">
				<div class="col-md-1">
					<select name="itemsforpage" id="itemsforpage" class="form-select form-select-sm" onchange="this.form.submit();">
						<option @if (request()->session()->get('estimates itemsforpage') ==1) selected @endif value="1">1</option>
						<option @if (request()->session()->get('estimates itemsforpage')==5) selected @endif value="5">5</option>
						<option @if (request()->session()->get('estimates itemsforpage')==10) selected @endif value="10">10</option>
						<option @if (request()->session()->get('estimates itemsforpage')==25) selected @endif value="25">25</option>
						<option @if (request()->session()->get('estimates itemsforpage')==50) selected @endif value="50">50</option>
						<option @if (request()->session()->get('estimates itemsforpage')==100) selected @endif value="100">100</option>
					</select>
				</div>
				<label for="itemsforpageID" class="col-md-2 col-form-label form-control-sm">Voci per pagina</label>

				<label for="searchfromtableID" class="offset-md-6 col-md-1 col-form-label form-control-sm" style="text-align:right;">Cerca</label>
				<div class="col-md-2">
					<input type="search" name="searchfromtable" id="searchfromtableID" class="form-control form-control-sm" value="{{ request()->session()->get('estimates searchfromtable') }}" onchange="this.form.submit();">
				</div>
			</div>
		</form>

		<div class="table-responsive text-nowrap my-2">
			<table class="table table-sm table-bordered listData">
				<thead>
					<tr>
						<th>id</th>
						<th>Note</th>
						<th>Content</th>
						<th>Action</th>
					</tr>
				</thead>

				<tbody>
					@foreach($estimates as $estimate)
					<tr>
						<td>{{ $estimate->id }}</td>
						<td>{{ $estimate->note }}</td>
						<td>{{ $estimate->content }}</td>
						<td class="actions text-end">
							<a href="javascript:void(0);" data-id="{{ $estimate->id }}" data-table="estimates" data-label="Preventivo" data-labelsex="o" data-token="{{ csrf_token() }}" class="setactive" title=""><i class="bx bx-{{ $estimate->active == 1 ? 'lock-open-alt' : 'lock-alt' }}{{ $estimate->active == 1 ? ' text-success' : ' text-danger' }}"></i></a><a class="" href="{{ route('estimates.edit', [$estimate->id]) }}" title="Modifica Preventivo"><i class='bx bx-edit'></i></a>
							{!! Form::open(['style'=>'','class'=>'float-end','method' => 'DELETE','route' => ['estimates.destroy', $estimate->id]]) !!}
							<a class="deleteitemformbutton" href="#" title="Cancella Preventivo"><i class='bx bx-trash'></i></a>
							{!! Form::close() !!}
						</td>
					</tr>

					@endforeach
				</tbody>
			</table>

		</div>

		{!! $estimates->links('pagination::bootstrap-5') !!}

	</div>
</div>



<!-- Large Modal -->
<div class="modal fade" id="largeModal" tabindex="-1" aria-hidden="true">
	<div class="modal-dialog modal-lg" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel3">Tempo lavorato al progetto</h5>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<div class="modal-body">
				<div class="row">

				</div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
					Chiudi
				</button>

			</div>
		</div>
	</div>
</div>
<!-- Extra Large Modal -->
@stop