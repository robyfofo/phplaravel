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
					<button type="button" class="nav-link" role="tab" data-bs-toggle="tab" data-bs-target="#navs-pills-top-contatti" aria-controls="navs-pills-top-contaii" aria-selected="false">
						Contatti
					</button>
				</li>

				<li class="nav-item">
					<button type="button" class="nav-link" role="tab" data-bs-toggle="tab" data-bs-target="#navs-pills-top-avatar" aria-controls="navs-pills-top-avatar" aria-selected="false">
						Avatar
					</button>
				</li>

				<li class="nav-item">
					<button type="button" class="nav-link" role="tab" data-bs-toggle="tab" data-bs-target="#navs-pills-top-altro" aria-controls="navs-pills-top-altro" aria-selected="false">
						Altro
					</button>
				</li>
			</ul>

			{{ Form::model($user, array('route' => array('users.update', $user->id), 'method' => 'PUT','enctype' => 'multipart/form-data')) }}

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
							{{ Form::label('email', 'Email', ['class'=>'col-sm-12 col-md-12 col-lg-2 col-xl-2 col-form-label col-form-label-sm']) }}
							<div class="col-sm-12 col-md-12 col-lg-9 col-xl-9">
								{{ Form::text('email', null, array('class' => 'form-control form-control-sm')) }}
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

					</fieldset>	
				</div>
				<!-- contatti -->

				<!-- avatar -->
				<div class="tab-pane fade" id="navs-pills-top-avatar" role="tabpanel">
					<fieldset>

						<div class="row mb-3">
							<div class="col-md-9">
								<div class="row mb-3">
									<label for="avatarID" class="col-md-3 col-form-label">Avatar</label>
									<div class="col-md-9">
										<input type="file" name="avatar" id="avatarID" class="form-control">		
									</div>							
								</div>
								<div class="row mb-3">
									<label for="deleteavatarID" class="col-sm-6 col-md-6 col-lg-2 col-xl-2 col-form-label-sm">
										Cancella
									</label>
									<div class="col-sm-12 col-md-12 col-lg-3 col-xl-3'">
										<div class="form-check">
											<input name="deleteavatar" id="deleteavatarID" value="1" type="checkbox" class="form-check-input">
											<label class="form-check-label" for="deleteavatarID"></label>
										</div>
									</div>
								</div>
							</div>
							<div class="col-md-3">
								<?php
								if ($user->avatar != '') {
									echo showImageUserAvatar($user->id, $alt = $user->name, $class = 'w-px-80 h-auto rounded-circle');
								} else {
									echo '<img alt="' . $user->name . ' avatar" src="/assets/img/avatars/user.png"  style="max-height:100px;">';
								}
								?>
							</div>
						</div>

					</fieldset>
				</div>
				<!-- avatar -->

				<!-- altro -->
				<div class="tab-pane fade" id="navs-pills-top-altro" role="tabpanel">
					<fieldset>
				
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
					<a href="{{ route('users.index') }}" title="Torna alla lista" class="btn btn-success">Indietro</a>
				</div>
				
			</div>

			{{ Form::close() }}

		</div>

	</div>
</div>
@stop