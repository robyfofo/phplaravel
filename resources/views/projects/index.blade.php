@extends('layouts.app')

@section('content')

<div class="row">
	<div class="col-md-3 new">
		<a href="{{ route('projects.create') }}" title="Inserisci un nuovo progetto" class="btn btn-sm btn-primary">Nuovo Progetto</a>
	</div>
	<div class="col-md-7 help-small-list"></div>
	<div class="col-md-2 help text-right"></div>
</div>

<div class="card">
	<div class="card-body">

		<form name="searchForm" id="searchFormID" role="form" method="GET" action="{{ route('projects.index') }}">
			@csrf
			<div class="form-group row">
				<div class="col-md-1">
					<select name="itemsforpage" id="itemsforpage" class="form-select form-select-sm" onchange="this.form.submit();">
						<option @if ($itemsforpage==1) selected @endif value="1">1</option>
						<option @if ($itemsforpage==5) selected @endif value="5">5</option>
						<option @if ($itemsforpage==10) selected @endif value="10">10</option>
						<option @if ($itemsforpage==25) selected @endif value="25">25</option>
						<option @if ($itemsforpage==50) selected @endif value="50">50</option>
						<option @if ($itemsforpage==100) selected @endif value="100">100</option>
					</select>
				</div>
				<label for="itemsforpageID" class="col-md-2 col-form-label form-control-sm">Voci per pagina</label>

				<label for="searchFromTableID" class="offset-md-6 col-md-1 col-form-label form-control-sm" style="text-align:right;">Cerca</label>
				<div class="col-md-2">
					<input type="search" name="searchFromTable" id="searchFromTableID" class="form-control form-control-sm" value="@isset($searchFromTable){{ $searchFromTable }}@endisset" onchange="this.form.submit();">
				</div>
			</div>
		</form>

		<div class="table-responsive text-nowrap my-2">
      <table class="table table-sm table-bordered listData">
				<thead>
					<tr>
						<th>id</th>
						<th>Ord</th>
						<th>Titolo</th>
						<th>Contenuto</th>
						<th>Status</th>
						<th>Completato</th>
						<th>Attivo</th>

						<th>Action</th>
					</tr>
				</thead>

				<tbody>
					@foreach($projects as $project)
					<tr>
						<td>{{ $project->id }}</td>
						<td>
							@if ($project->ordering == 'DESC')
								<a class="" href={{ route('projects.lessordering',[$project->id,$orderType]) }}" title="sposta giu"><i class='bx bx-down-arrow-alt' ></i></a><a class="" href="{{ route('projects.moreordering',[$project->id,$orderType]) }}" title="sposta su"><i class='bx bx-up-arrow-alt' ></i></a>
							@else
								<a class="" href="{{ route('projects.moreordering',[$project->id,$orderType]) }}" title="sposta giu"><i class='bx bx-down-arrow-alt' ></i></a><a class="" href="{{ route('projects.lessordering',[$project->id,$orderType]) }}" title="sposta su"><i class='bx bx-up-arrow-alt' ></i></a>
							@endif

							({{ $project->ordering }})
						</td>

						<td>{{ $project->title }}</td>
						<td>{{ $project->content }}</td>
						<td>{{ $project->status }}</td>
						<td>{{ $project->completato }}</td>
						<td>{{ $project->active }}</td>

						<td class="actions text-end">
							<a href="javascript:void(0);" data-id="{{ $project->id }}" data-table="modules" data-label="Modulo" data-labelsex="o" data-token="{{ csrf_token() }}" class="setactive" title=""><i class="bx bx-{{ $project->active == 1 ? 'lock-open-alt' : 'lock-alt' }}{{ $project->active == 1 ? ' text-success' : ' text-danger' }}"></i></a><a class="" href="{{ route('modules.edit', [$project->id]) }}" title="Modifica modulo"><i class='bx bx-edit'></i></a>
							{!! Form::open(['style'=>'','class'=>'float-end','method' => 'DELETE','route' => ['modules.destroy', $project->id]]) !!}
							<a class="deleteitemformbutton" href="#" title="Cancella Modulo"><i class='bx bx-trash'></i></a>
							{!! Form::close() !!}
						</td>
					</tr>

					@endforeach
				</tbody>
			</table>

		</div>

		{!! $projects->links('pagination::bootstrap-5') !!}

	</div>
</div>
@stop