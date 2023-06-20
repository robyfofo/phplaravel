@extends('layouts.app')

@section('content')

<div class="row">
	<div class="col-md-3 new"></div>
	<div class="col-md-7 help-small-form"></div>
	<div class="col-md-2 help text-right"></div>
</div>

<div class="card mt-3 mb-4">
	<div class="card-body">






				<h6 class="text-muted">Basic</h6>
				<div class="nav-align-top mb-4">
					<ul class="nav nav-pills mb-3" role="tablist">
						<li class="nav-item">
							<button type="button" class="nav-link active" role="tab" data-bs-toggle="tab" data-bs-target="#navs-pills-top-home" aria-controls="navs-pills-top-home" aria-selected="true">
								Home
							</button>
						</li>
						<li class="nav-item">
							<button type="button" class="nav-link" role="tab" data-bs-toggle="tab" data-bs-target="#navs-pills-top-profile" aria-controls="navs-pills-top-profile" aria-selected="false">
								Profile
							</button>
						</li>
						<li class="nav-item">
							<button type="button" class="nav-link" role="tab" data-bs-toggle="tab" data-bs-target="#navs-pills-top-messages" aria-controls="navs-pills-top-messages" aria-selected="false">
								Messages
							</button>
						</li>
					</ul>
					<div class="tab-content">
						<div class="tab-pane fade show active" id="navs-pills-top-home" role="tabpanel">
							<p>
								Icing pastry pudding oat cake. Lemon drops cotton candy caramels cake caramels sesame snaps
								powder. Bear claw candy topping.
							</p>
							<p class="mb-0">
								Tootsie roll fruitcake cookie. Dessert topping pie. Jujubes wafer carrot cake jelly. Bonbon
								jelly-o jelly-o ice cream jelly beans candy canes cake bonbon. Cookie jelly beans marshmallow
								jujubes sweet.
							</p>
						</div>
						<div class="tab-pane fade" id="navs-pills-top-profile" role="tabpanel">
							<p>
								Donut dragée jelly pie halvah. Danish gingerbread bonbon cookie wafer candy oat cake ice
								cream. Gummies halvah tootsie roll muffin biscuit icing dessert gingerbread. Pastry ice cream
								cheesecake fruitcake.
							</p>
							<p class="mb-0">
								Jelly-o jelly beans icing pastry cake cake lemon drops. Muffin muffin pie tiramisu halvah
								cotton candy liquorice caramels.
							</p>
						</div>
						<div class="tab-pane fade" id="navs-pills-top-messages" role="tabpanel">
							<p>
								Oat cake chupa chups dragée donut toffee. Sweet cotton candy jelly beans macaroon gummies
								cupcake gummi bears cake chocolate.
							</p>
							<p class="mb-0">
								Cake chocolate bar cotton candy apple pie tootsie roll ice cream apple pie brownie cake. Sweet
								roll icing sesame snaps caramels danish toffee. Brownie biscuit dessert dessert. Pudding jelly
								jelly-o tart brownie jelly.
							</p>
						</div>
					</div>
				</div>



























			<div class="nav-align-top mb-4">
				<ul class="nav nav-tabs" role="tablist">
					<li class="nav-item">
						<button type="button" class="nav-link active" role="tab" data-bs-toggle="tab" data-bs-target="#navs-top-datibase" aria-controls="navs-top-datibase" aria-selected="true">
							Dati base
						</button>
					</li>
					<li class="nav-item">
						<button type="button" class="nav-link" role="tab" data-bs-toggle="tab" data-bs-target="#navs-top-altro" aria-controls="navs-top-altro" aria-selected="false">
							Altro
						</button>
					</li>
				</ul>

				{{ Form::model($module, array('route' => array('modules.update', $module->id), 'method' => 'PUT')) }}

				<div class="tab-content">

					<!-- datibase -->
					<div class="tab-pane fade show active" id="navs-top-datibase" role="tabpanel">
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

						</fieldset>
					</div>
					

					<!-- altro -->
					<div class="tab-pane fade" id="navs-top-altro" role="tabpanel">
						<fieldset>
							<div class="form-group row">
								{{ Form::label('ordering', 'Ordinamento', ['class'=>'col-sm-12 col-md-12 col-lg-2 col-xl-2 col-form-label col-form-label-sm']) }}
								<div id="orderingID" class="col-sm-12 col-md-12 col-lg-2 col-xl-1">
									{{ Form::text('ordering', $module->ordering, array('class' => 'form-control form-control-sm','length' => 10)) }}
								</div>
							</div>

							<div class="form-group row">
								{{ Form::label('active', 'Attiva', ['class'=>'col-sm-12 col-md-12 col-lg-2 col-xl-2 col-form-label col-form-label-sm col-form-label-sm-custom-checkbox']) }}
								<div class="col-sm-2 col-md-2 col-lg-1 col-xl-1">
									<div class="custom-control custom-checkbox">
										{{ Form::checkbox('active', 1,  $module->active ,array('class' => 'custom-control-input')) }}
										<label class="custom-control-label" for="active"></label>
									</div>
								</div>
							</div>
						</fieldset>
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

		</div>
	</div>
	@stop