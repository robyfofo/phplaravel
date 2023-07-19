@extends('layouts.app')

@section('content')

<div class="row mb-3">
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
						<option @if (request()->session()->get('projects itemsforpage') ==1) selected @endif value="1">1</option>
						<option @if (request()->session()->get('projects itemsforpage')==5) selected @endif value="5">5</option>
						<option @if (request()->session()->get('projects itemsforpage')==10) selected @endif value="10">10</option>
						<option @if (request()->session()->get('projects itemsforpage')==25) selected @endif value="25">25</option>
						<option @if (request()->session()->get('projects itemsforpage')==50) selected @endif value="50">50</option>
						<option @if (request()->session()->get('projects itemsforpage')==100) selected @endif value="100">100</option>
					</select>
				</div>
				<label for="itemsforpageID" class="col-md-2 col-form-label form-control-sm">Voci per pagina</label>

				<label for="searchfromtableID" class="offset-md-6 col-md-1 col-form-label form-control-sm" style="text-align:right;">Cerca</label>
				<div class="col-md-2">
					<input type="search" name="searchfromtable" id="searchfromtableID" class="form-control form-control-sm" value="{{ request()->session()->get('projects searchfromtable') }}" onchange="this.form.submit();">
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
						<th>Worktime</th>

						<th>Action</th>
					</tr>
				</thead>

				<tbody>
					@foreach($projects as $project)
					<tr>
						<td>{{ $project->id }}</td>
						<td>
							@if ($project->ordering == 'DESC')
							<a class="" href={{ route('projects.lessordering',[$project->id,$orderType]) }}" title="sposta giu"><i class='bx bx-down-arrow-alt'></i></a><a class="" href="{{ route('projects.moreordering',[$project->id,$orderType]) }}" title="sposta su"><i class='bx bx-up-arrow-alt'></i></a>
							@else
							<a class="" href="{{ route('projects.moreordering',[$project->id,$orderType]) }}" title="sposta giu"><i class='bx bx-down-arrow-alt'></i></a><a class="" href="{{ route('projects.lessordering',[$project->id,$orderType]) }}" title="sposta su"><i class='bx bx-up-arrow-alt'></i></a>
							@endif

							({{ $project->ordering }})
						</td>

						<td>{{ $project->title }}</td>
						<td>{{ $project->content }}</td>
						<td>
							<?php
							echo Config::get('settings.project_status.' . $project->status);
							?>
							{{ $project->status }}
						</td>
						<td>{{ $project->completato }} %</td>
						<td>
							@php
							$strore = $project->ore_preventivo;

							if ($project->worktime != '') {
							$rapporto_minuti_preventivo_lavorate = 0;
							$minutipreventivati = $project->ore_preventivo * 60;
							$foo = explode(':', $project->worktime);
							$ore = (isset($foo[0]) ? $foo[0] : 0);
							$min = (isset($foo[1]) ? $foo[1] : 0);
							$minutilavorati = floor($ore * 60) + $min;
							if ($minutilavorati > 0 && $minutipreventivati > 0) $rapporto_minuti_preventivo_lavorate = ($minutilavorati * 100 ) / $minutipreventivati;
							$class = '';
							if ( $minutilavorati > $minutipreventivati) $class="text-alert";
							$strore .= ' <small class="'.$class.'">(lavorate: <b>'.substr($project->worktime,0,5).' - '.$rapporto_minuti_preventivo_lavorate.'%</b></small>)';

							}
							@endphp


							{!! $strore !!}



							<button type="button" href="javascript:void(0)" data-remote="false" data-target="#largeModal" data-toggle="modal" title="Mostra tempo lavorato al progetto" class="btn btn-sm btn-default float-end openmodal"><i class='bx bx-alarm'></i></button>



							<button
                          type="button"
                          class="btn btn-primary"
                          data-bs-toggle="modal"
                          data-bs-target="#largeModal"
                        >



						</td>

						<td class="actions text-end">
							<a href="javascript:void(0);" data-id="{{ $project->id }}" data-table="projects" data-label="Progetto" data-labelsex="o" data-token="{{ csrf_token() }}" class="setactive" title=""><i class="bx bx-{{ $project->active == 1 ? 'lock-open-alt' : 'lock-alt' }}{{ $project->active == 1 ? ' text-success' : ' text-danger' }}"></i></a><a class="" href="{{ route('projects.edit', [$project->id]) }}" title="Modifica progetto"><i class='bx bx-edit'></i></a>
							{!! Form::open(['style'=>'','class'=>'float-end','method' => 'DELETE','route' => ['projects.destroy', $project->id]]) !!}
							<a class="deleteitemformbutton" href="#" title="Cancella Progetto"><i class='bx bx-trash'></i></a>
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