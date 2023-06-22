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

			{!! Form::open(['route' => 'projects.store']) !!}

			<div class="tab-content">

				<!-- datibase -->
				<div class="tab-pane fade show active" id="navs-pills-top-datibase" role="tabpanel">
					
					<fieldset>

						<div class="row mb-3">
							{{ Form::label('title', 'Nome', ['class'=>'col-sm-12 col-md-12 col-lg-2 col-xl-2 col-form-label col-form-label-sm']) }}
							<div class="col-sm-12 col-md-12 col-lg-9 col-xl-9">
								{{ Form::text('title', null, array('class' => 'form-control form-control-sm')) }}
							</div>
						</div>

						<div class="row mb-3">
							{{ Form::label('content', 'Content', ['class'=>'col-sm-12 col-md-12 col-lg-2 col-xl-2 col-form-label col-form-label-sm']) }}
							<div class="col-sm-12 col-md-12 col-lg-9 col-xl-9">
								{{ Form::textarea('content', null, array('class' => 'form-control form-control-sm')) }}
							</div>
						</div>

						<div class="row mb-3">
							{{ Form::label('stauts', 'Status', ['class'=>'col-sm-12 col-md-12 col-lg-2 col-xl-2 col-form-label col-form-label-sm']) }}
							<div class="col-sm-12 col-md-12 col-lg-5 col-xl-4">
							{{ Form::select('status',Config::get('settings.project_status'),0,array('class' => 'form-select form-select-sm')); }}
							</div>
						</div>

						<div class="row mb-3">
							{{ Form::label('completato', 'Completato %', ['class'=>'col-sm-12 col-md-12 col-lg-2 col-xl-2 col-form-label col-form-label-sm']) }}
							<div class="col-sm-12 col-md-12 col-lg-3 col-xl-2">
								{{ Form::number('completato',0, array('class' => 'form-control form-control-sm')) }}
							</div>
						</div>

					</fieldset>	
				</div>
				<!-- datibase -->

				<!-- altro -->
				<div class="tab-pane fade" id="navs-pills-top-altro" role="tabpanel">
					<fieldset>

						<div class="row mb-3">
							{{ Form::label('ordering', 'Ordinamento', ['class'=>'col-sm-12 col-md-12 col-lg-2 col-xl-2 col-form-label']) }}
							<div id="orderingID" class="col-sm-12 col-md-12 col-lg-2 col-xl-1">
								{{ Form::text('ordering', $ordering, array('class' => 'form-control form-control-sm','length' => 10)) }}
							</div>
						</div>

						<div class="row mb-3">
							{{ Form::label('active', 'Attiva', ['class'=>'col-sm-12 col-md-12 col-lg-2 col-xl-2 col-form-label']) }}
							<div class="col-sm-12 col-md-12 col-lg-3 col-xl-3'">
								<div class="form-check">
									{{ Form::checkbox('active', 1, 1 ,array('class' => 'form-check-input')) }}
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
					<a href="{{ route('projects.index') }}" title="Torna alla lista" class="btn btn-success">Indietro</a>
				</div>

			</div>
		{{ Form::close() }}

		</div>

	</div>
</div>
@stop