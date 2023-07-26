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
					<button type="button" class="nav-link" role="tab" data-bs-toggle="tab" data-bs-target="#navs-pills-top-datibase" aria-controls="navs-pills-top-datibase" aria-selected="true">
						Dati base
					</button>
				</li>

				<li class="nav-item">
					<button type="button" class="nav-link" role="tab" data-bs-toggle="tab" data-bs-target="#navs-pills-top-cliente" aria-controls="navs-pills-top-cliente" aria-selected="true">
						Cliente
					</button>
				</li>

				<li class="nav-item">
					<button type="button" class="nav-link active" role="tab" data-bs-toggle="tab" data-bs-target="#navs-pills-top-articoli" aria-controls="navs-pills-top-articoli" aria-selected="true">
						Articoli
					</button>
				</li>

				<li class="nav-item">
					<button type="button" class="nav-link" role="tab" data-bs-toggle="tab" data-bs-target="#navs-pills-top-altro" aria-controls="navs-pills-top-altro" aria-selected="false">
						Altro
					</button>
				</li>
			</ul>


			{{ Form::model($estimate, array('route' => array('estimates.update', $estimate->id), 'method' => 'PUT')) }}

			<div class="tab-content">

				<!-- datibase -->
				<div class="tab-pane fade" id="navs-pills-top-datibase" role="tabpanel">

					<fieldset>

						<div class="mb-3 row">

							<label for="dateinsInput" class="col-12 col-sm-12 col-md-2 col-lg-2 col-xl-2 col-form-label col-form-label-sm">Data</label>
							<div class="col-12 col-sm-4 col-md-4 col-lg-3 col-xl-3">
								<div class="input-group" id="dateins" data-td-target-input="nearest" data-td-target-toggle="nearest">
									<input name="dateins" id="dateinsInput" type="text" class="form-control form-control-sm" data-td-target="#dateins">
									<span class="input-group-text" data-td-target="#dateins" data-td-toggle="datetimepicker">
										<span class="fas fa-calendar"></span>
									</span>
								</div>
							</div>

							<label for="datescaInput" class="col-12 col-sm-12 col-md-2 col-lg-2 col-xl-2 col-form-label col-form-label-sm responsive-text-right">Scadenza</label>
							<div class="col-12 col-sm-4 col-md-4 col-lg-3 col-xl-3">
								<div class="input-group" id="datesca" data-td-target-input="nearest" data-td-target-toggle="nearest">
									<input name="datesca" id="datescaInput" type="text" class="form-control form-control-sm" data-td-target="#datesca">
									<span class="input-group-text" data-td-target="#datesca" data-td-toggle="datetimepicker">
										<span class="fas fa-calendar"></span>
									</span>
								</div>
							</div>

						</div>

						<hr>

						<div class="row mb-3">
							{{ Form::label('note', 'Note', ['class'=>'col-12 col-sm-12 col-md-2 col-lg-2 col-xl-2 col-form-label col-form-label-sm']) }}
							<div class="col-12 col-sm-12 col-md-9 col-lg-9 col-xl-9">
								{{ Form::text('note', null, array('class' => 'form-control form-control-sm')) }}
							</div>
						</div>

						<div class="row mb-3">
							{{ Form::label('content', 'Content', ['class'=>'col-12 col-sm-12 col-md-2 col-lg-2 col-xl-2 col-form-label col-form-label-sm']) }}
							<div class="col-12 col-sm-12 col-md-12 col-lg-9 col-xl-9">
								{{ Form::textarea('content', null, array('class' => 'form-control form-control-sm')) }}
							</div>
						</div>

					</fieldset>
				</div>
				<!-- datibase -->

				<!-- cliente -->
				<div class="tab-pane fade" id="navs-pills-top-cliente" role="tabpanel">
					<fieldset>

						<div class="mb-3 row">
							<label for="thirdparty_idID" class="col-12 col-sm-12 col-md-2 col-lg-2 col-xl-2 col-form-label col-form-label-sm">Cliente</label>
							<div class="col-12 col-sm-12 col-md-9 col-lg-9 col-xl-9">
								<select name="thirdparty_id" id="thirdparty_idID" class="form-select" title="Seleziona un cliente">
									@isset($thirdies)
									@foreach ($thirdies AS $c)
									<option value="{{ $c->id }}" {{ $estimate->thirdparty_id == $c->id ? ' selected="selected"' : '' }}>{{ $c->name }} {{ $c->surname }}</option>
									@endforeach
									@endisset
								</select>
							</div>
						</div>

						<div class="row mb-3">
							{{ Form::label('alt_thirdparty', 'Altro Indirizzo', ['class'=>'col-12 col-sm-12 col-md-2 col-lg-2 col-xl-2 col-form-label col-form-label-sm']) }}
							<div class="col-12 col-sm-12 col-md-9 col-lg-9 col-xl-9">
								{{ Form::textarea('alt_thirdparty', null, array('class' => 'form-control form-control-sm')) }}
							</div>
						</div>

					</fieldset>
				</div>
				<!-- cliente -->

				<!-- articoli -->
				<div class="tab-pane fade show active" id="navs-pills-top-articoli" role="tabpanel">
					<fieldset>

						@foreach($articles as $article)

						<div class="card mt-3 mb-4">
							<div class="card-body">

								<div class="row">

									<div class="col-12 col-sm-1 col-md-1 col-lg-1 col-xl-1">
										<label class="col-form-label col-form-label-sm" for="art_noteID">Note</label>
										<input class="form-control form-control-sm" name="art_note" id="art_noteIT" value="{{ $article->note }}">
									</div>

									<div class="col-3 col-sm-1 col-md-1 col-lg-1 col-xl-1">
										<label class="col-form-label col-form-label-sm" for="art_quantityID">Quantità</label>
										<input class="form-control form-control-sm" name="art_quantity" id="art_quantityIT" value="{{ $article->quantity }}">
									</div>

									<div class="col-4 col-sm-3 col-md-3 col-lg-2 col-xl-2">
										<label class="col-form-label col-form-label-sm" for="art_valueID">Prezzo</label>
										<input class="form-control form-control-sm text-end" name="art_value" id="art_valueIT" value="{{ $article->value }}">
									</div>

								</div>

								<div class="row">

									<div class="col-12 col-sm-3 col-md-3 col-lg-2 col-xl-2">
										<label class="col-form-label col-form-label-sm" for="art_contentID">Contenuto</label>
										<textarea class="form-control form-control-sm" name="art_content" id="art_contentIT">{{ $article->content }}</textarea>
									</div>

								</div>



							</div>

								{{ $article->id }}

								{{ $article->content }}


								{{ $article->quantity }}
								{{ $article->value }}

							</div>

							<div class="card-footer">

							</div>
						</div>


						@endforeach


						<div>



							<div class="row mb-3">
								{{ Form::label('art_note', 'Note', ['class'=>'col-12 col-sm-12 col-md-2 col-lg-2 col-xl-2 col-form-label col-form-label-sm']) }}
								<div class="col-12 col-sm-12 col-md-9 col-lg-9 col-xl-9">
									{{ Form::text('note', null, array('class' => 'form-control form-control-sm')) }}
								</div>
							</div>

							<div class="row mb-3">
								{{ Form::label('art_content', 'Content', ['class'=>'col-12 col-sm-12 col-md-2 col-lg-2 col-xl-2 col-form-label col-form-label-sm']) }}
								<div class="col-12 col-sm-12 col-md-12 col-lg-9 col-xl-9">
									{{ Form::textarea('content', null, array('class' => 'form-control form-control-sm')) }}
								</div>
							</div>


							<div class="row mb-3">
								{{ Form::label('art_value', 'Valore', ['class'=>'col-12 col-sm-12 col-md-2 col-lg-2 col-xl-2 col-form-label col-form-label-sm']) }}
								<div class="col-12 col-sm-12 col-md-9 col-lg-9 col-xl-9">
									{{ Form::text('art_value', null, array('class' => 'form-control form-control-sm')) }}
								</div>
							</div>


							<div class="col-6 text-center">
								<button id="art_submitFormID" type="submit" name="art_submitForm" value="submit" class="btn btn-primary">Invia</button>
							</div>





						</div>


					</fieldset>
				</div>
				<!-- articoli -->

				<!-- altro -->
				<div class="tab-pane fade" id="navs-pills-top-altro" role="tabpanel">
					<fieldset>

						<div class="row mb-3">
							<div class="form-check">

								{{ Form::checkbox('active', 1,  $estimate->active ,array('class' => 'form-check-input')) }}

								{{ Form::label('active', 'Attiva', ['class'=>'form-check-label']) }}

							</div>


						</div>






					</fieldset>
				</div>
				<!-- altro -->

			</div>

			<hr>
			<div class="mb-3 row">

				<div class="col-6 text-center">
					<button id="submitFormID" type="submit" name="submitForm" value="submit" class="btn btn-primary">Invia</button>
				</div>

				<div class="col-6 text-end">
					<a href="{{ route('estimates.index') }}" title="Torna alla lista" class="btn btn-success">Indietro</a>
				</div>

			</div>

			{{ Form::close() }}




		</div>
	</div>
</div>
@stop