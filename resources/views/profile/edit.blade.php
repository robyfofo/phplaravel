@extends('layouts.app')

@section('content')

<div class="card mt-3 mb-4">
	<div class="card-body">

		<h3>Modifica profilo</h3>



		<div class="nav-align-top mb-4">
			<ul class="nav nav-tabs" role="tablist">
				<li class="nav-item">
					<button type="button" class="nav-link active" role="tab" data-bs-toggle="tab" data-bs-target="#navs-top-anagrafica" aria-controls="navs-top-anagrafica" aria-selected="true">
						Anagrafica
					</button>
				</li>
				<li class="nav-item">
					<button type="button" class="nav-link" role="tab" data-bs-toggle="tab" data-bs-target="#navs-top-contatti" aria-controls="navs-top-contatti" aria-selected="false">
						Contatti
					</button>
				</li>
				<li class="nav-item">
					<button type="button" class="nav-link" role="tab" data-bs-toggle="tab" data-bs-target="#navs-top-altro" aria-controls="navs-top-altro" aria-selected="false">
						Altro
					</button>
				</li>
			</ul>
			{{ Form::model($profile, array('route' => 'profile.update', 'method' => 'post','enctype' => 'multipart/form-data')) }}
			<div class="tab-content">

				<!-- anagrafica -->
				<div class="tab-pane fade show active" id="navs-top-anagrafica" role="tabpanel">
					<fieldset>
						<div class="row mb-2">

							{{ Form::label('name', 'Nome', ['class'=>'col-sm-12 col-md-12 col-lg-2 col-xl-2 col-form-label col-form-label-sm']) }}
							<div id="nameID" class="col-sm-12 col-md-12 col-lg-4 col-xl-4">
								{{ Form::text('name', null, array('class' => 'form-control form-control-sm')) }}
							</div>

							{{ Form::label('surname', 'Cognome', ['class'=>'col-sm-12 col-md-12 col-lg-2 col-xl-2 col-form-label col-form-label-sm']) }}
							<div id="surnameID" class="col-sm-12 col-md-12 col-lg-4 col-xl-4">
								{{ Form::text('surname', null, array('class' => 'form-control form-control-sm')) }}
							</div>

						</div>

						<div class="row mb-2">
							{{ Form::label('name', 'Nome', ['class'=>'col-sm-12 col-md-12 col-lg-2 col-xl-2 col-form-label col-form-label-sm']) }}
							<div id="nameID" class="col-sm-12 col-md-12 col-lg-4 col-xl-4">
								{{ Form::text('name', null, array('class' => 'form-control form-control-sm')) }}
							</div>

							{{ Form::label('surname', 'Cognome', ['class'=>'col-sm-12 col-md-12 col-lg-2 col-xl-2 col-form-label col-form-label-sm']) }}
							<div id="surnameID" class="col-sm-12 col-md-12 col-lg-4 col-xl-4">
								{{ Form::text('surname', null, array('class' => 'form-control form-control-sm')) }}
							</div>

						</div>
					</fieldset>
				</div>
				<!-- anagrafica -->

				<div class="tab-pane fade" id="navs-top-contatti" role="tabpanel">

				</div>
				<div class="tab-pane fade" id="navs-top-altro" role="tabpanel">

				</div>

				<hr>
				<div class="form-group row">
					<div class="col-md-12 col-xs-12 text-center">
						<button data-color="red" data-size="s" data-style="expand-right" id="submitFormID" type="submit" name="submitForm" value="submit" class="btn btn-primary submittheform">Invia</button>
					</div>
				</div>


			</div>
			{{ Form::close() }}
		</div>





































		<!-- Tab panes -->
		<div class="tab-content" id="formTabContent">

			<!-- sezione datibase -->
			<div class="tab-pane fade show active" id="datibase" role="tabpanel" aria-labelledby="datibase-tab">

			</div>
			<!-- sezione datibase -->

		</div>
		<!--/Tab panes -->




	</div>
</div>
@stop