@extends('layouts.app')

@section('content')


<div class="row">
	<div class="col-md-3 new"></div>
	<div class="col-md-7 help-small-form"></div>
	<div class="col-md-2 help text-right">

	</div>
</div>

<div class="card shadow mt-3 mb-4">
	<div class="card-body">

		<!-- Nav tabs -->
		<ul class="nav nav-tabs" id="formTab" role="tablist">
			<li class="nav-item">
				<a class="nav-link active" href="#datibase" id="datibase-tab" data-toggle="tab" role="tab" aria-controls="datibase" aria-selected="true">Dati Base</a>
			</li>
		</ul>

		{{ Form::model($profile, array('route' => 'profile.update', 'method' => 'post','enctype' => 'multipart/form-data')) }}

		<!-- Tab panes -->
		<div class="tab-content" id="formTabContent">

			<!-- sezione datibase -->
			<div class="tab-pane fade show active" id="datibase" role="tabpanel" aria-labelledby="datibase-tab">
				<fieldset>

					<div class="form-group row">

						{{ Form::label('name', 'Nome', ['class'=>'col-sm-12 col-md-12 col-lg-2 col-xl-2 col-form-label col-form-label-sm']) }}
						<div id="divfieldtitleID" class="col-sm-12 col-md-12 col-lg-4 col-xl-4">
							{{ Form::text('name', null, array('class' => 'form-control form-control-sm')) }}
						</div>
					
						{{ Form::label('surname', 'Cognome', ['class'=>'col-sm-12 col-md-12 col-lg-2 col-xl-2 col-form-label col-form-label-sm']) }}
						<div id="divfieldtitleID" class="col-sm-12 col-md-12 col-lg-4 col-xl-4">
							{{ Form::text('surname', null, array('class' => 'form-control form-control-sm')) }}
						</div>

					</div>
				</fieldset>
			</div>
			<!-- sezione datibase -->

		</div>
		<!--/Tab panes -->

		<hr>
		<div class="form-group row">
			<div class="col-md-12 col-xs-12 text-center">
				<button data-color="red" data-size="s" data-style="expand-right" id="submitFormID" type="submit" name="submitForm" value="submit" class="btn btn-primary submittheform">Invia</button>
			</div>
		</div>

		{{ Form::close() }}

	</div>
</div>
@stop