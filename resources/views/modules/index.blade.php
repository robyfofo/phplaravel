@extends('layouts.app')

@section('content')

@if (session('success'))
<div class="alert alert-success">
	{{ session('success') }}
</div>
@endif
@if (session('error'))
<div class="alert alert-danger">
	{{ session('error') }}
</div>
@endif

<div class="row">
	<div class="col-md-3 new">
		<a href="{{ route('modules.create') }}" title="Inserisci un nuovo modulo" class="btn btn-sm btn-primary">Nuovo Modulo</a>
	</div>
	<div class="col-md-7 help-small-list"></div>
	<div class="col-md-2 help text-right"></div>
</div>

<div class="card shadow mt-3 mb-4">
	<div class="card-body">

		<form name="searchForm" id="searchFormID" role="form" method="GET" action="{{ route('modules.index') }}">
			@csrf
			<div class="form-group row">
				<div class="col-md-1">
					<select name="itemsforpage" id="itemsforpage" class="custom-select custom-select-sm" onchange="this.form.submit();">
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

		<div class="table-responsive">
			<table class="table table-striped table-bordered table-hover table-sm listData">
				<thead>
					<tr>
						<th>id</th>
						<th>Ord</th>
						<th>Nome</th>
						<th>Label</th>
						<th>content</th>
						<th>Action</th>
					</tr>
				</thead>
				<tbody>
					@foreach($modules as $module)
						<tr>
							<td>{{ $module->id }}</td>
							<td>
								@if ($module->ordering == 'DESC')
									<a class="" href={{ route('modules.lessordering',[$module->id,$orderType]) }}" title="sposta giu"><i class="fas fa-long-arrow-alt-down"></i></a>
									<a class="" href="{{ route('modules.moreordering',[$module->id,$orderType]) }}" title="sposta su"><i class="fas fa-long-arrow-alt-up"></i></a>
								@else
									<a class="" href="{{ route('modules.moreordering',[$module->id,$orderType]) }}" title="sposta giu"><i class="fas fa-long-arrow-alt-down"></i></a>
									<a class="" href="{{ route('modules.lessordering',[$module->id,$orderType]) }}" title="sposta su"><i class="fas fa-long-arrow-alt-up"></i></a>
								@endif
								({{ $module->ordering }})
						</td>
							<td>{{ $module->name }}</td>
							<td>{{ $module->label }}</td>
							<td>{{ $module->content }}</td>
						
							<td class="actions text-right">
								<a href="javascript:void(0);" data-id="{{ $module->id }}" data-table="modules" data-label="Modulo" data-labelsex="o" data-token="{{ csrf_token() }}" class="btn btn-sm btn-default setactive" title=""><i class="fa fa-sm fa-{{ $module->active == 1 ? 'unlock' : 'lock' }}{{ $module->active == 1 ? ' text-success' : ' text-danger' }}"></i></a><a class="btn btn-sm btn-default" href="{{ route('modules.edit', [$module->id]) }}" title="Modifica progetto"><i class="far fa-edit"></i></a>
								{!! Form::open(['style'=>'','class'=>'float-right','method' => 'DELETE','route' => ['modules.destroy', $module->id]]) !!}
								<a class="btn btn-sm btn-default deleteitemformbutton" href="#" title="Cancella Modulo"><i class="far fa-trash-alt"></i></a>
								{!! Form::close() !!}
						</td>

						</tr>

					@endforeach
				</tbody>
			</table>
		</div>

		{!! $modules->links() !!}



	</div>
</div>

@stop
