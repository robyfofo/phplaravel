@extends('layouts.app')

@section('content')

<div class="row mb-3">
	<div class="col-md-3 new">
		<a href="{{ route('users.create') }}" title="Inserisci un nuovo utente" class="btn btn-sm btn-primary">Nuovo Utente</a>
	</div>
	<div class="col-md-7 help-small-list"></div>
	<div class="col-md-2 help text-right"></div>
</div>

<div class="card">
	<div class="card-body">

		<form name="searchForm" id="searchFormID" role="form" method="GET" action="{{ route('users.index') }}">
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
						<th>Nome</th>
						<th>Cognome</th>
						<th>Email</th>
						<th>Avatar</th>
						<th>Action</th>
					</tr>
				</thead>
				<tbody>
					@foreach($users as $user)
						<tr>
							<td>{{ $user->id }}</td>
							<td>{{ $user->name }}</td>
							<td>{{ $user->surname }}</td>
							<td>{{ $user->email }}</td>
							<td>

								<img src="<?php echo getImageUserAvatar($user->id ); ?>" alt="<?php echo $user->name; ?>" class="w-px-40 h-auto rounded-circle">
													
							</td>
							<td class="actions text-end">
								<a href="javascript:void(0);" data-id="{{ $user->id }}" data-table="users" data-label="Utente" data-labelsex="o" data-token="{{ csrf_token() }}" class="setactive" title=""><i class="bx bx-{{ $user->active == 1 ? 'lock-open-alt' : 'lock-alt' }}{{ $user->active == 1 ? ' text-success' : ' text-danger' }}"></i></a><a class="" href="{{ route('users.edit', [$user->id]) }}" title="Modifica utente"><i class='bx bx-edit'></i></a>
								{!! Form::open(['style'=>'','class'=>'float-end','method' => 'DELETE','route' => ['users.destroy', $user->id]]) !!}
								<a class="deleteitemformbutton" href="#" title="Cancella Utente"><i class='bx bx-trash'></i></a>
								{!! Form::close() !!}
							</td>
						</tr>

					@endforeach
				</tbody>
			</table>
		</div>

		{!! $users->links('pagination::bootstrap-5') !!}

	</div>
</div>
@stop
