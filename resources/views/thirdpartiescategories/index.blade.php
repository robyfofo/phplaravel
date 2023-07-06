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
						<th></th>
						<th>Parent</th>
						<th>Livello</th>
						<th>Titolo</th>

					</tr>
				</thead>
				<tbody>

					@php $level = 0; @endphp
					
					<!-- Loop through each category -->
					@foreach ($categories as $category)

						<!-- Include subcategories.blade.php file and pass the current category to it -->
						@include('layouts.subcategoriestable', ['category' => $category,'level'=>$level])

					@endforeach

				</tbody>
			</table>

		</div>
	</div>
</div>
@stop