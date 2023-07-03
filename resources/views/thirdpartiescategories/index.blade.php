@extends('layouts.app')

@section('content')

<div class="row mb-3">
	<div class="col-md-3 new">
		<a href="{{ route('thirdpartiescategories.create') }}" title="Inserisci una nuova categoria cliente" class="btn btn-sm btn-primary">Nuova Categoria</a>
	</div>
	<div class="col-md-7 help-small-list"></div>
	<div class="col-md-2 help text-right"></div>
</div>

<div class="card">
	<div class="card-body">



    <div class="table-responsive text-nowrap my-2">
      <table class="table table-sm table-bordered listData">
				<thead>
					<tr>
						<th>id</th>
						<th>Parent</th>
						<th>Livello</th>
						<th>Titolo</th>
					
					</tr>
				</thead>
				<tbody>
        	@foreach($categories as $parent)
						<tr>
							<td>{{ $parent->id }}</td>
							<td>{{ $parent->parent_id }}</td>
							<td>{{ $parent->level }}</td>
							<td>{{ $parent->title }}</td>		
						</tr>

						@foreach($parent->children as $son)
							<tr>
								<td>{{ $son->id }}</td>
								<td>{{ $son->parent_id }}</td>
								<td>{{ $parent->level }}</td>
								<td>{{ $son->title }}</td>
							</tr>

								@foreach($son->children as $subson)
								<tr>
									<td>{{ $subson->id }}</td>
									<td>{{ $subson->parent_id }}</td>
									<td>{{ $parent->level }}</td>
									<td>{{ $subson->title }}</td>
								</tr>
								@endforeach

						@endforeach

					@endforeach

				</tbody>
			</table>
		</div>



	</div>
</div>
@stop



