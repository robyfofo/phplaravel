@extends('layouts.app')

@section('content')

<div class="row mb-3">
	<div class="col-md-3 new">
		<a href="{{ route('thirdpartiescategories.create') }}" title="Inserisci una nuova categoria cliente" class="btn btn-sm btn-primary">Nuova Categoria</a>
	</div>
	<div class="col-md-7 help-small-list">

	
	</div>
	<div class="col-md-2 help text-right"></div>
</div>

<div class="card">
	<div class="card-body">
		<div class="table-responsive text-nowrap my-2">

			<table class="table table-sm table-bordered listData tree">
				<thead>
					<tr>
						<th></th>
						<th>id/Pr/Lv</th>
						<th>Ord</th>
						<th>Titolo</th>
						<th>Anagrafiche</th>
						<th>Action</th>
					</tr>
				</thead>
				<tbody>

					@php 
					$subcat_level = 0; 
					$subcat_levelstr = '';
					$subcat_route = 'thirdpartiescategories';
					$subcat_table = 'thirdparties_categories';
					$subcat_associatedulr = 'thirdparties';
					$subcat_associatedtitle = 'Anagrafiche';
					@endphp
					
					@foreach ($categories as $category)
						@include('layouts.subcategoriestable', [
							'category' => $category,
							'subcat_level'=>$subcat_level,
							'subcat_route'=>$subcat_route,
							'subcat_table'=>$subcat_table,
							'subcat_levelstr'=>$subcat_levelstr,
							'subcat_associatedulr'=>$subcat_associatedulr,
							'subcat_associatedtitle'=>$subcat_associatedtitle
							])
					@endforeach

				</tbody>
			</table>

		</div>
	</div>
</div>
@stop