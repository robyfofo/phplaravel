@extends('layouts.app')

@section('content')

@if($errors->any())
<div class="alert alert-danger">
	@foreach ($errors->all() as $error)
	{{ $error }} <br>
	@endforeach
</div>
@endif


<div class="row">
	<div class="col-md-12 new"></div>
</div>

<div class="card shadow mt-3 mb-4">
	<div class="card-body">
		<!-- Nav tabs -->
		<ul class="nav nav-tabs" id="formTab" role="tablist">
			<li class="nav-item">
				<a class="nav-link active" href="#datibase" id="datibase-tab" data-toggle="tab" role="tab" aria-controls="datibase" aria-selected="true">Dati Base</a>
			</li>
		</ul>


		{!! Form::open(['route' => 'modules.store']) !!}

		<!-- Tab panes -->
		<div class="tab-content" id="formTabContent">

			<!-- sezione datibase -->
			<div class="tab-pane fade show active" id="datibase" role="tabpanel" aria-labelledby="datibase-tab">
				<fieldset>

					<div class="form-group row">
						{{ Form::label('name', 'Nome', ['class'=>'col-sm-12 col-md-12 col-lg-2 col-xl-2 col-form-label col-form-label-sm']) }}
						<div id="divfieldnameID" class="col-sm-12 col-md-12 col-lg-9 col-xl-9">
							{{ Form::text('name', null, array('class' => 'form-control form-control-sm')) }}
						</div>
					</div>

					<div class="form-group row">
						{{ Form::label('label', 'Alias', ['class'=>'col-sm-12 col-md-12 col-lg-2 col-xl-2 col-form-label col-form-label-sm']) }}
						<div id="divfieldnameID" class="col-sm-12 col-md-12 col-lg-9 col-xl-9">
							{{ Form::text('alias', null, array('class' => 'form-control form-control-sm')) }}
						</div>
					</div>
					<div class="form-group row">
						{{ Form::label('label', 'Label', ['class'=>'col-sm-12 col-md-12 col-lg-2 col-xl-2 col-form-label col-form-label-sm']) }}
						<div id="divfieldnameID" class="col-sm-12 col-md-12 col-lg-9 col-xl-9">
							{{ Form::text('label', null, array('class' => 'form-control form-control-sm')) }}
						</div>
					</div>
					<div class="form-group row">
						{{ Form::label('content', 'Content', ['class'=>'col-sm-12 col-md-12 col-lg-2 col-xl-2 col-form-label col-form-label-sm']) }}
						<div id="contentID" class="col-sm-12 col-md-12 col-lg-9 col-xl-9">
							{{ Form::textarea('content', null, array('class' => 'form-control form-control-sm')) }}
						</div>
					</div>
					<div class="form-group row">
						{{ Form::label('code_menu', 'Codice Menu', ['class'=>'col-sm-12 col-md-12 col-lg-2 col-xl-2 col-form-label col-form-label-sm']) }}
						<div id="divfieldnameID" class="col-sm-12 col-md-12 col-lg-9 col-xl-9">
							{{ Form::textarea('code_menu', null, array('class' => 'form-control form-control-sm')) }}
						</div>
					</div>

					<div class="form-group row">
						{{ Form::label('ordering', 'Ordinamento', ['class'=>'col-sm-12 col-md-12 col-lg-2 col-xl-2 col-form-label col-form-label-sm']) }}
						<div id="orderingID" class="col-sm-12 col-md-12 col-lg-2 col-xl-1">
							{{ Form::text('ordering', $ordering+1, array('class' => 'form-control form-control-sm','length' => 10)) }}
						</div>
					</div>

					<div class="form-group row">
						{{ Form::label('active', 'Attiva', ['class'=>'col-sm-12 col-md-12 col-lg-2 col-xl-2 col-form-label col-form-label-sm col-form-label-sm-custom-checkbox']) }}
						<div class="col-sm-2 col-md-2 col-lg-1 col-xl-1">
							<div class="custom-control custom-checkbox">
								{{ Form::checkbox('active', 1,  1 ,array('class' => 'custom-control-input')) }}
								<label class="custom-control-label" for="active"></label>
							</div>
						</div>
					</div>

				</fieldset>
			</div>
			<!-- sezione datibase -->


		</div>
		<!--/Tab panes -->

		<hr>
		<div class="form-group row">
			<div class="col-md-6 col-xs-12 text-center">
				<button data-color="red" data-size="s" data-style="expand-right" id="submitFormID" type="submit" name="submitForm" value="submit" class="btn btn-primary submittheform">Invia</button>
			</div>

			<div class="col-md-6 col-xs-12 text-right">
				<a href="{{ route('modules.index') }}" title="Torna alla lista" class="btn btn-success">Indietro</a>
			</div>
		</div>

		{{ Form::close() }}

	</div>
</div>
@stop