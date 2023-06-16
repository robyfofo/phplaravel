@extends('layouts.app')

@section('content')
<div class="card shadow mt-3 mb-4">
	<div class="card-body">
		{{ Form::model($profile, array('route' => 'profile.password.update', 'method' => 'post','enctype' => 'multipart/form-data')) }}
		<fieldset>

			<div class="form-group row">
				{{ Form::label('passwordold', 'Vecchia password', ['class'=>'col-sm-12 col-md-12 col-lg-2 col-xl-2 col-form-label col-form-label-sm']) }}
				<div class="col-sm-12 col-md-12 col-lg-4 col-xl-4">
					{{ Form::password('passwordold', null, array('class' => 'form-control form-control-sm')) }}
				</div>
			</div>


			<hr>

			<div class="form-group row">
				{{ Form::label('passwordnew', 'Nuova password', ['class'=>'col-sm-12 col-md-12 col-lg-2 col-xl-2 col-form-label col-form-label-sm']) }}
				<div class="col-sm-12 col-md-12 col-lg-4 col-xl-4">
					{{ Form::password('passwordnew', null, array('class' => 'form-control form-control-sm')) }}
				</div>
			</div>
		
			<div class="form-group row">
				{{ Form::label('passwordck', 'Verifica password', ['class'=>'col-sm-12 col-md-12 col-lg-2 col-xl-2 col-form-label col-form-label-sm']) }}
				<div class="col-sm-12 col-md-12 col-lg-4 col-xl-4">
					{{ Form::password('passwordck', null, array('class' => 'form-control form-control-sm')) }}
				</div>
			</div>

		</fieldset>

		<div class="col-md-12 col-xs-12 text-center">
			<button data-color="red" data-size="s" data-style="expand-right" id="submitFormID" type="submit" name="submitForm" value="submit" class="btn btn-primary submittheform">Invia</button>
		</div>

		{{ Form::close() }}
	</div>
</div>
@stop