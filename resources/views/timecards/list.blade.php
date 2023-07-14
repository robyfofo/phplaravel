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

					@endforeach
				</tbody>
			</table>

		</div>

		{!! $timecards->links('pagination::bootstrap-5') !!}


  </div>
</div>
@stop
