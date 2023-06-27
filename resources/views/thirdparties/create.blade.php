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
					<button type="button" class="nav-link" role="tab" data-bs-toggle="tab" data-bs-target="#navs-pills-top-contatti" aria-controls="navs-pills-top-contatti" aria-selected="false">
						Contatti
					</button>
				</li>

				<li class="nav-item">
					<button type="button" class="nav-link" role="tab" data-bs-toggle="tab" data-bs-target="#navs-pills-top-fiscale" aria-controls="navs-pills-top-fiscale" aria-selected="false">
						Fiscale
					</button>
				</li>


				<li class="nav-item">
					<button type="button" class="nav-link" role="tab" data-bs-toggle="tab" data-bs-target="#navs-pills-top-altro" aria-controls="navs-pills-top-altro" aria-selected="false">
						Altro
					</button>
				</li>
			</ul>

			{!! Form::open(['route' => 'thirdparties.store','enctype' => 'multipart/form-data']) !!}

			<div class="tab-content">
				
				<!-- datibase -->
				<div class="tab-pane fade show active" id="navs-pills-top-datibase" role="tabpanel">
					<fieldset>

						<div class="row mb-3">
							{{ Form::label('name', 'Nome', ['class'=>'col-sm-12 col-md-12 col-lg-2 col-xl-2 col-form-label col-form-label-sm']) }}
							<div class="col-sm-12 col-md-12 col-lg-9 col-xl-9">
								{{ Form::text('name', null, array('class' => 'form-control form-control-sm')) }}
							</div>
						</div>

						<div class="row mb-3">
							{{ Form::label('surname', 'Cognome', ['class'=>'col-sm-12 col-md-12 col-lg-2 col-xl-2 col-form-label col-form-label-sm']) }}
							<div class="col-sm-12 col-md-12 col-lg-9 col-xl-9">
								{{ Form::text('surname', null, array('class' => 'form-control form-control-sm')) }}
							</div>
						</div>

						<div class="row mb-3">
							{{ Form::label('zip_code', 'CAP', ['class'=>'col-sm-12 col-md-12 col-lg-2 col-xl-2 col-form-label col-form-label-sm']) }}
							<div class="col-sm-12 col-md-12 col-lg-9 col-xl-9">
								{{ Form::text('zip_code', null, array('class' => 'form-control form-control-sm')) }}
							</div>
						</div>

						<div class="row mb-3">
							{{ Form::label('street', 'Via', ['class'=>'col-sm-12 col-md-12 col-lg-2 col-xl-2 col-form-label col-form-label-sm']) }}
							<div class="col-sm-12 col-md-12 col-lg-9 col-xl-9">
								{{ Form::text('street', null, array('class' => 'form-control form-control-sm')) }}
							</div>
						</div>

					</fieldset>	
				</div>
				<!-- datibase -->

				<!-- contatti -->
				<div class="tab-pane fade" id="navs-pills-top-contatti" role="tabpanel">
					<fieldset>
						
						<div class="row mb-3">
							{{ Form::label('email', 'Email', ['class'=>'col-sm-12 col-md-12 col-lg-2 col-xl-2 col-form-label col-form-label-sm']) }}
							<div class="col-sm-12 col-md-12 col-lg-9 col-xl-9">
								{{ Form::text('email', null, array('class' => 'form-control form-control-sm')) }}
							</div>
						</div>

						<div class="row mb-3">
							
							{{ Form::label('telephone', 'Telefono', ['class'=>'col-sm-12 col-md-12 col-lg-2 col-xl-2 col-form-label col-form-label-sm']) }}
							<div class="col-sm-12 col-md-12 col-lg-4 col-xl-4">
								{{ Form::text('telephone', null, array('class' => 'form-control form-control-sm')) }}
							</div>
					
							{{ Form::label('mobile', 'Mobile', ['class'=>'col-sm-12 col-md-12 col-lg-2 col-xl-2 col-form-label col-form-label-sm']) }}
							<div class="col-sm-12 col-md-12 col-lg-4 col-xl-4">
								{{ Form::text('mobile', null, array('class' => 'form-control form-control-sm')) }}
							</div>

						</div>

					</fieldset>	
				</div>
				<!-- contatti -->

				<!-- fiscale -->
				<div class="tab-pane fade" id="navs-pills-top-fiscale" role="tabpanel">
					<fieldset>

						<div class="row mb-3">
							{{ Form::label('ragione_sociale', 'Ragione sociale', ['class'=>'col-sm-12 col-md-12 col-lg-2 col-xl-2 col-form-label col-form-label-sm']) }}
							<div class="col-sm-12 col-md-12 col-lg-9 col-xl-9">
								{{ Form::text('ragione_sociale', null, array('class' => 'form-control form-control-sm')) }}
							</div>
						</div>

						<div class="row mb-3">

							{{ Form::label('codice_fiscale', 'Codice fiscale', ['class'=>'col-sm-12 col-md-12 col-lg-2 col-xl-2 col-form-label col-form-label-sm']) }}
							<div class="col-sm-12 col-md-12 col-lg-4 col-xl-4">
								{{ Form::text('codice_fiscale', null, array('class' => 'form-control form-control-sm')) }}
							</div>
						

							{{ Form::label('partita_iva', 'Partita IVA', ['class'=>'col-sm-12 col-md-12 col-lg-2 col-xl-2 col-form-label col-form-label-sm']) }}
							<div class="col-sm-12 col-md-12 col-lg-4 col-xl-4">
								{{ Form::text('partita_iva', null, array('class' => 'form-control form-control-sm')) }}
							</div>
						</div>
						
						<div class="row mb-3">

							{{ Form::label('pec', 'PEC', ['class'=>'col-sm-12 col-md-12 col-lg-2 col-xl-2 col-form-label col-form-label-sm']) }}
							<div class="col-sm-12 col-md-12 col-lg-4 col-xl-4">
								{{ Form::text('pec', null, array('class' => 'form-control form-control-sm')) }}
							</div>
						

							{{ Form::label('sid', 'SID', ['class'=>'col-sm-12 col-md-12 col-lg-2 col-xl-2 col-form-label col-form-label-sm']) }}
							<div class="col-sm-12 col-md-12 col-lg-4 col-xl-4">
								{{ Form::text('sid', null, array('class' => 'form-control form-control-sm')) }}
							</div>
							
						</div>

					</fieldset>
				</div>
				<!-- fiscale -->

		
				<!-- altro -->
				<div class="tab-pane fade" id="navs-pills-top-altro" role="tabpanel">
					<fieldset>

						<div class="row mb-3">
							{{ Form::label('active', 'Attiva', ['class'=>'col-sm-12 col-md-12 col-lg-2 col-xl-2 col-form-label']) }}
							<div class="col-sm-12 col-md-12 col-lg-3 col-xl-3'">
								<div class="form-check">
									{{ Form::checkbox('active', 1,  1 ,array('class' => 'form-check-input')) }}
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
					<a href="{{ route('thirdparties.index') }}" title="Torna alla lista" class="btn btn-success">Indietro</a>
				</div>
			</div>

			{{ Form::close() }}

		</div>

	</div>
</div>
@stop