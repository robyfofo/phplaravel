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
					<button type="button" class="nav-link" role="tab" data-bs-toggle="tab" data-bs-target="#navs-pills-top-altro" aria-controls="navs-pills-top-altro" aria-selected="false">
						Altro
					</button>
				</li>
			</ul>

			@if (isset($module) && $module->id > 0)
				{{ Form::model($module, array('route' => array('modules.update', $module->id), 'method' => 'PUT','enctype' => 'multipart/form-data')) }}
			@else
				{!! Form::open(['route' => 'modules.store','enctype' => 'multipart/form-data']) !!}
			@endif


			<div class="tab-content">
				
				<!-- dati base -->
				<div class="tab-pane fade show active" id="navs-pills-top-datibase" role="tabpanel">
					<fieldset>
						
						<div class="row mb-3">
							{{ Form::label('name', 'Nome', ['class'=>'col-sm-12 col-md-12 col-lg-2 col-xl-2 col-form-label col-form-label-sm']) }}
							<div class="col-sm-12 col-md-12 col-lg-9 col-xl-9">
								{{ Form::text('name', old('name', $module->name ?? ''), array('class' => 'form-control form-control-sm')) }}
							</div>
						</div>

						<div class="row mb-3">
							{{ Form::label('alias', 'Alias', ['class'=>'col-sm-12 col-md-12 col-lg-2 col-xl-2 col-form-label col-form-label-sm']) }}
							<div class="col-sm-12 col-md-12 col-lg-9 col-xl-9">
								{{ Form::text('alias', old('alias', $module->alias ?? ''), array('class' => 'form-control form-control-sm')) }}
							</div>
						</div>
						
						<div class="row mb-3">
							{{ Form::label('label', 'Label', ['class'=>'col-sm-12 col-md-12 col-lg-2 col-xl-2 col-form-label col-form-label-sm']) }}
							<div class="col-sm-12 col-md-12 col-lg-9 col-xl-9">
								{{ Form::text('label', old('label', $module->label ?? ''), array('class' => 'form-control form-control-sm')) }}
							</div>
						</div>
						
						<div class="row mb-3">
							{{ Form::label('content', 'Content', ['class'=>'col-sm-12 col-md-12 col-lg-2 col-xl-2 col-form-label col-form-label-sm']) }}
							<div class="col-sm-12 col-md-12 col-lg-9 col-xl-9">
								{{ Form::textarea('content',old('content', $module->content ?? ''), array('class' => 'form-control form-control-sm')) }}
							</div>
						</div>
						
						<div class="row mb-3">
							{{ Form::label('code_menu', 'Codice Menu', ['class'=>'col-sm-12 col-md-12 col-lg-2 col-xl-2 col-form-label col-form-label-sm']) }}
							<div id="divfieldnameID" class="col-sm-12 col-md-12 col-lg-9 col-xl-9">
								{{ Form::textarea('code_menu', old('code_menu', $module->code_menu ?? ''), array('class' => 'form-control form-control-sm')) }}
							</div>
						</div>

					</fieldset>	
				</div>
				<!-- datibase -->

				<!-- altro -->
				<div class="tab-pane fade" id="navs-pills-top-altro" role="tabpanel">
					<fieldset>

					<div class="row mb-3"> 
              {{ Form::label('ordering', 'Ordinamento', ['class'=>'col-sm-12 col-md-12 col-lg-2 col-xl-2 col-form-label col-form-label-sm']) }}
              <div id="orderingID" class="col-sm-12 col-md-12 col-lg-2 col-xl-1">
                {{ Form::text('ordering', $module->ordering,array('class' => 'form-control form-control-sm','length' => 10)) }}
              </div>
            </div>

						<div class="row mb-3">
						{{ Form::label('active', 'Attiva', ['class'=>'col-sm-12 col-md-2 col-lg-2 col-xl-2 col-form-label col-form-label-sm']) }}
							<div class="col-sm-12 col-md-2 col-lg-2 col-xl-2'">
								<div class="form-check">
									{{ Form::checkbox('active', 1,  $module->active ,array('class' => 'form-check-input')) }}
								</div>
							</div>
						</div>

					</fieldset>
				</div>
				<!-- altro -->

			</div>

			<hr>
			<div class="form-group row">
				<div class="col-md-6 col-xs-12 text-center">
					<button data-color="red" data-size="s" data-style="expand-right" id="submitFormID" type="submit" name="submitForm" value="submit" class="btn btn-primary submittheform">Invia</button>
				</div>
				<div class="col-md-6 col-xs-12 text-sm-center text-xl-end">
					<a href="{{ route('modules.index') }}" title="Torna alla lista" class="btn btn-success">Indietro</a>
				</div>
			</div>

			{{ Form::close() }}

		</div>

	</div>
</div>
@stop