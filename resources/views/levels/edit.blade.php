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
					<button type="button" class="nav-link aactive" role="tab" data-bs-toggle="tab" data-bs-target="#navs-pills-top-datibase" aria-controls="navs-pills-top-datibase" aria-selected="true">
						Dati base
					</button>
				</li>

				<li class="nav-item">
					<button type="button" class="nav-link active" role="tab" data-bs-toggle="tab" data-bs-target="#navs-pills-top-modules" aria-controls="navs-pills-top-modules" aria-selected="true">
						Moduli
					</button>
				</li>

				<li class="nav-item">
					<button type="button" class="nav-link" role="tab" data-bs-toggle="tab" data-bs-target="#navs-pills-top-altro" aria-controls="navs-pills-top-altro" aria-selected="false">
						Altro
					</button>
				</li>
			</ul>

			{{ Form::model($level, array('route' => array('levels.update', $level->id), 'method' => 'PUT')) }}

			<div class="tab-content">

				<!-- datibase -->
				<div class="tab-pane fade ashow aactive" id="navs-pills-top-datibase" role="tabpanel">
					<fieldset>

						<div class="row mb-3">
							{{ Form::label('title', 'Titolo', ['class'=>'col-sm-12 col-md-12 col-lg-2 col-xl-2 col-form-label col-form-label-sm']) }}
							<div class="col-sm-12 col-md-12 col-lg-9 col-xl-9">
								{{ Form::text('title', $level->title, array('class' => 'form-control form-control-sm')) }}
							</div>
						</div>

					</fieldset>
				</div>
				<!-- datibase -->


				<!-- modules -->
				<div class="tab-pane fade show active" id="navs-pills-top-modules" role="tabpanel">
					<fieldset>

					@dump($level_modules_rigths);

						<div class="row mb-3">
							<div class="col-md-3">
								<strong>Moduli attivi</strong>
							</div>

							<div class="col-md-4">
								<strong>Accessi</strong>
							</div>
							<div class="col-md-5">

							</div>
						</div>

						@foreach($allModulesActive as $module)
						<div class="row py-3">
							<div class="col-md-3">
								<label class="control-label">{{ $module->label }}</label>
							</div>

							<div class="col-md-4">
								<label style="padding-right:2px;" 
								class="<?php echo (isset($level_modules_rigths[$module->name]->read_access) && $level_modules_rigths[$module->name]->read_access== 1 ? 'text-success': 'text-danger'); ?>"
								>Lettura</label>
								<input type="checkbox" name="modules_read[{{ $module->id }}]" id="" 
								class="" value="1" 
								<?php echo (isset($level_modules_rigths[$module->name]->read_access) && $level_modules_rigths[$module->name]->read_access== 1 ? 'checked': ''); ?>
								>

								<label style="padding-left:20px; padding-right:2px;" 
								class="<?php echo (isset($level_modules_rigths[$module->name]->write_access) && $level_modules_rigths[$module->name]->write_access== 1 ? 'text-success': 'text-danger'); ?>">Scrittura</label>
								<input type="checkbox" name="modules_write[{{ $module->id }}]" id="" class="" value="1" 
								<?php echo (isset($level_modules_rigths[$module->name]->write_access) && $level_modules_rigths[$module->name]->write_access== 1 ? 'checked': ''); ?>
								>

							</div>
							<div class="col-md-5">

								module name: {{ $module->name }}

								@isset($level_modules_rigths[$module->name]->read_access)
								<br>read {{ $level_modules_rigths[$module->name]->read_access }}
								@endisset

								@isset($level_modules_rigths[$module->name]->write_access)
								<br>write {{ $level_modules_rigths[$module->name]->write_access }}
								@endisset
								





								<br>
								{{ $module->content }}
							</div>
						</div>

						@endforeach



					</fieldset>
				</div>
				<!-- modules -->


				<!-- altro -->
				<div class="tab-pane fade" id="navs-pills-top-altro" role="tabpanel">
					<fieldset>


						<div class="row mb-3">
							{{ Form::label('active', 'Attiva', ['class'=>'col-sm-12 col-md-12 col-lg-2 col-xl-2 col-form-label']) }}
							<div class="col-sm-12 col-md-12 col-lg-3 col-xl-3'">
								<div class="form-check">
									{{ Form::checkbox('active', 1,  $level->active ,array('class' => 'form-check-input')) }}
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

				<div class="col-md-6 col-xs-12 text-sm-center text-md-end">
					<a href="{{ route('levels.index') }}" title="Torna alla lista" class="btn btn-success">Indietro</a>
				</div>

			</div>

			{{ Form::close() }}

		</div>

	</div>
</div>
@stop