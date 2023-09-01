@extends('layouts.app')

@section('content')

<div class="row">
	<div class="col-md-12 new"></div>
</div>

<div class="card mt-3 mb-4">
	<div class="card-body">

		<div class="nav-align-top mb-4">
			<ul class="nav nav-tabs mb-3" role="tablist">
				<li class="nav-item">
					<button type="button" class="nav-link active" role="tab" data-bs-toggle="tab" data-bs-target="#navs-pills-top-datibase" aria-controls="navs-pills-top-datibase" aria-selected="true">
						Dati base
					</button>
				</li>

				<li class="nav-item">
					<button type="button" class="nav-link" role="tab" data-bs-toggle="tab" data-bs-target="#navs-pills-top-image" aria-controls="navs-pills-top-image" aria-selected="false">
						Immagine
					</button>
				</li>

				<li class="nav-item">
					<button type="button" class="nav-link" role="tab" data-bs-toggle="tab" data-bs-target="#navs-pills-top-altro" aria-controls="navs-pills-top-altro" aria-selected="false">
						Altro
					</button>
				</li>
			</ul>

			@if (isset($product) && $product->id > 0)
				{{ Form::model($product, array('route' => array('products.update', $product->id), 'method' => 'PUT','enctype' => 'multipart/form-data')) }}
			@else
				{!! Form::open(['route' => 'products.store','enctype' => 'multipart/form-data']) !!}
			@endif

			

			<div class="tab-content">

				<!-- datibase -->
				<div class="tab-pane fade show active" id="navs-pills-top-datibase" role="tabpanel">
					<fieldset>

						<div class="row mb-3">
							{{ Form::label('title', 'Titolo', ['class'=>'col-sm-12 col-md-2 col-lg-2 col-xl-2 col-form-label col-form-label-sm']) }}
							<div class="col-sm-12 col-md-10 col-lg-10 col-xl-10">
								{{ Form::text('title',old('title', $product->title ?? ''), array('class' => 'form-control form-control-sm')) }}
							</div>
						</div>

						<div class="row mb-3">
							{{ Form::label('price_unity', 'Prezzo U.tà', ['class'=>'col-sm-12 col-md-2 col-lg-2 col-xl-2 col-form-label col-form-label-sm']) }}
							<div class="col-sm-12 col-md-4 col-lg-3 col-xl-3">
								{{ Form::text('price_unity',old('price_unity', $product->price_unity ?? ''), array('class' => 'form-control form-control-sm')) }}
							</div>
						</div>
							
						<div class="row mb-3">
							{{ Form::label('content', 'Contenuto', ['class'=>'col-sm-12 col-md-2 col-lg-2 col-xl-2 col-form-label col-form-label-sm']) }}
							<div class="col-sm-12 col-md-10 col-lg-10 col-xl-10">
								{{ Form::textarea('content', old('content', $product->content ?? ''), array('class' => 'form-control form-control-sm editorHTML')) }}
							</div>
						</div>


					</fieldset>
				</div>
				<!-- datibase -->

			<!-- image -->
			<div class="tab-pane fade" id="navs-pills-top-image" role="tabpanel">
					<fieldset>

						<div class="row mb-3">
							<div class="col-md-9">
								<div class="row mb-3">
									<label for="imageID" class="col-md-3 col-form-label col-form-label-sm">image</label>
									<div class="col-md-9">
										<input type="file" name="image" id="imageID" class="form-control">		
									</div>							
								</div>

								@if($product->image != '')
								<div class="row mb-3">
									<label for="deleteimageID" class="col-sm-6 col-md-6 col-lg-2 col-xl-2 col-form-label-sm">
										Cancella
									</label>
									<div class="col-sm-12 col-md-12 col-lg-3 col-xl-3'">
										<div class="form-check">
											<input name="deleteimage" id="deleteimageID" value="1" type="checkbox" class="form-check-input">
											<label class="form-check-label" for="deleteimageID"></label>
										</div>
									</div>

									<div class="col-sm-12 col-md-12 col-lg-3 col-xl-3'">

									
									<a class="" href="/uploads/products/{{ $product->image }}" data-lightbox="image-1" data-title="{{ $product->image }}" title="{{ $product->image }}"><img src="/uploads/products/{{ $product->image }}" style="height:150px;width:150px;"></a>
									</div>
								
								@endif

								</div>
							</div>
							
						</div>

					</fieldset>
				</div>
				<!-- image -->

			

				<!-- altro -->
				<div class="tab-pane fade" id="navs-pills-top-altro" role="tabpanel">
					<fieldset>
						<div class="row mb-3">
              {{ Form::label('categories_id', 'Categoria', ['class'=>'col-sm-12 col-md-12 col-lg-2 col-xl-2 col-form-label col-form-label-sm']) }}
              <div class="col-sm-12 col-md-12 col-lg-6 col-xl-6">
                <select name="categories_id" id="category_id" class="form-select form-select-sm">
                  <option value=""></option>
										@php 
										$subcat_level = 0; 
										$subcat_levelstr = '';
										$subcat_selected = $product->categories_id;
										@endphp                
										@foreach ($categories as $cat)
											@include('layouts.subcategoriesselect', [
												'cat' => $cat,
												'subcat_level' => $subcat_level,
												'subcat_levelstr' => $subcat_levelstr,
												'subcat_selected' => $subcat_selected,
												])
										@endforeach
                </select>
              </div>
            </div>

						<hr>

						<div class="row mb-3"> 
              {{ Form::label('ordering', 'Ordinamento', ['class'=>'col-sm-12 col-md-12 col-lg-2 col-xl-2 col-form-label col-form-label-sm']) }}
              <div id="orderingID" class="col-sm-12 col-md-12 col-lg-2 col-xl-1">
                {{ Form::text('ordering', $product->ordering,array('class' => 'form-control form-control-sm','length' => 10)) }}
              </div>
            </div>

						<div class="row mb-3">
						{{ Form::label('active', 'Attiva', ['class'=>'col-sm-12 col-md-2 col-lg-2 col-xl-2 col-form-label col-form-label-sm']) }}
							<div class="col-sm-12 col-md-2 col-lg-2 col-xl-2'">
								<div class="form-check">
									{{ Form::checkbox('active', 1,  $product->active ,array('class' => 'form-check-input')) }}
								</div>
							</div>
						</div>


					</fieldset>
				</div>
				<!-- altro -->

			</div>

			<hr>
			<div class="row mb-3">
				<div class="col-md-6 col-xs-12 text-center">
					<button data-color="red" data-size="s" data-style="expand-right" id="submitFormID" type="submit" name="submitForm" value="submit" class="btn btn-primary submittheform">Invia</button>
				</div>

				<div class="col-md-6 col-xs-12 text-sm-center text-xl-end">
					<a href="{{ route('products.index') }}" title="Torna alla lista" class="btn btn-success">Indietro</a>
				</div>

			</div>

			{{ Form::close() }}

		</div>

	</div>
</div>
@stop