@extends('layouts.app')

@section('content')

<div class="row mb-3">
	<div class="col-md-3 new">
	</div>
	<div class="col-md-7 help-small-list"></div>
	<div class="col-md-2 help text-right"></div>
</div>


<div class="card">
	<div class="card-body">

 	 	<form name="searchForm" id="searchFormID" role="form" method="GET" action="{{ route('timecards.list') }}">
			@csrf
			<div class="form-group row">
				<div class="col-md-1">
					<select name="itemsforpage" id="itemsforpage" class="form-select form-select-sm" onchange="this.form.submit();">
						<option @if (request()->session()->get('timecards itemsforpage') ==1) selected @endif value="1">1</option>
						<option @if (request()->session()->get('timecards itemsforpage')==5) selected @endif value="5">5</option>
						<option @if (request()->session()->get('timecards itemsforpage')==10) selected @endif value="10">10</option>
						<option @if (request()->session()->get('timecards itemsforpage')==25) selected @endif value="25">25</option>
						<option @if (request()->session()->get('timecards itemsforpage')==50) selected @endif value="50">50</option>
						<option @if (request()->session()->get('timecards itemsforpage')==100) selected @endif value="100">100</option>
					</select>
				</div>
				<label for="itemsforpageID" class="col-md-2 col-form-label form-control-sm">Voci per pagina</label>


				<label for="searchFromTableID" class="col-md-1 col-form-label form-control-sm">Progetti</label>
				<div class="col-md-2">
					<select name="project_id" id="project_idID" class="form-select form-select-sm" onchange="this.form.submit();">
						<option value=""></option>
						@foreach($projects as $project)
							<option value="{{ $project->id }}"@if (request()->session()->get('timecards project_id') == $project->id) selected @endif>{{ $project->title }}</option>
						@endforeach

					</select>
				</div>

				<label for="dateinsInput" class="col-md-1 col-form-label">Data</label>
				<div class="col-md-2">

					<select name="dateins" id="dateinsID" class="form-select form-select-sm" onchange="this.form.submit();">
						<option value=""></option>
						<option value="mc"@if (request()->session()->get('timecards dateins') == 'mc') selected @endif>Mese corrente</option>
						<option value="mp"@if (request()->session()->get('timecards dateins') == 'mp') selected @endif>Mese precedente</option>
					</select>
				</div>

				<label for="searchFromTableID" class="col-md-1 col-form-label form-control-sm">Contenuto</label>
				<div class="col-md-2">
						<input class="form-control form-control-sm" value="{{ request()->session()->get('timecards keyword') }}" name="keyword" id="keywordID">
				</div>

			</div>
		</form>

  <div class="table-responsive text-nowrap my-2">
      <table class="table table-sm table-bordered listData">
				<thead>
					<tr>
						<th>id</th>
						<th>Utente</th>
						<th>Progetto</th>
						<th>Data</th>
						<th>inizio</th>
						<th>Fine</th>
						<th>Ore</th>
						<th>Contenuto</th>
						<th>Action</th>
					</tr>
				</thead>

			

				<tbody>
					@php  $worktimes = array(); @endphp
					@foreach($timecards as $timecard)
					<tr>
						<td>{{ $timecard->id }}</td>
						<td>{{ $timecard->name }}, {{ $timecard->surname }}</td>
						<td>{{ $timecard->project }}</td>
						<td>{{ $timecard->dateins }}</td>
						<td class="text-end">{{ $timecard->starttime }}</td>
						<td class="text-end">{{ $timecard->endtime }}</td>
						<td class="text-end">{{ $timecard->worktime }}</td>
						<td>{{ $timecard->content }}</td>

						<td class="actions text-end">
							{!! Form::open(['style'=>'','class'=>'float-end','method' => 'DELETE','route' => ['timecards.destroy', $timecard->id]]) !!}
							<a class="deleteitemformbutton" href="#" title="Cancella Timecard"><i class='bx bx-trash'></i></a>
							{!! Form::close() !!}
						</td>
					</tr>

					@php  $worktimes[] = $timecard->worktime; @endphp

					@endforeach
				</tbody>

				<tfoot>
					<tr>
						<td colspan="6" class="text-end fw-bolder">Totale ore</td>
						<td colspan="" class="text-end fw-bolder">@php  echo sumTheTime($worktimes); @endphp</td>
						<td colspan="2" class="text-end">
						<a href="{{ route('timecards.listpdf') }}" title="Espporta in pdf"><i class='bx bxs-file-pdf'></i></a>
						</td>
					</tr>
				</tfoot>

			</table>

		</div>

		{!! $timecards->links('pagination::bootstrap-5') !!}


  </div>

</div>
@stop
