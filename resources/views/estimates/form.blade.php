@extends('layouts.app')

@section('content')

<div class="row">
	<div class="col-md-12 new"></div>
</div>

<div class="card mt-3 mb-4">
	<div class="card-body">

		<div class="row">

			<div class="col-md-7" id="articleslistID">
			

			</div>

			<div class="col-md-5">

				@if (isset($estimate) && $estimate->id > 0)
				{{ Form::model($estimate, array('route' => array('estimates.update', $estimate->id), 'method' => 'PUT')) }}
				@else
					{!! Form::open(['route' => 'estimates.store']) !!}
				@endif
			

					<fieldset>

						<div class="mb-3 row">

							<label for="dateinsInput" class="col-12 col-sm-12 col-md-2 col-lg-2 col-xl-2 col-form-label col-form-label-sm responsive-text-right">Data</label>
							<div class="col-12 col-sm-4 col-md-4 col-lg-4 col-xl-4">
								<div class="input-group" id="dateins" data-td-target-input="nearest" data-td-target-toggle="nearest">
									<input name="dateins" id="dateinsInput" type="text" class="form-control form-control-sm" data-td-target="#dateins">
									<span class="input-group-text" data-td-target="#dateins" data-td-toggle="datetimepicker">
										<span class="fas fa-calendar"></span>
									</span>
								</div>
							</div>

							<label for="datescaInput" class="col-12 col-sm-12 col-md-2 col-lg-2 col-xl-2 col-form-label col-form-label-sm responsive-text-right">Scadenza</label>
							<div class="col-12 col-sm-4 col-md-4 col-lg-4 col-xl-4">
								<div class="input-group" id="datesca" data-td-target-input="nearest" data-td-target-toggle="nearest">
									<input name="datesca" id="datescaInput" type="text" class="form-control form-control-sm" data-td-target="#datesca">
									<span class="input-group-text" data-td-target="#datesca" data-td-toggle="datetimepicker">
										<span class="fas fa-calendar"></span>
									</span>
								</div>
							</div>

						</div>

						<div class="row mb-3">
							{{ Form::label('note', 'Note', ['class'=>'col-12 col-sm-12 col-md-2 col-lg-2 col-xl-2 col-form-label col-form-label-sm responsive-text-right']) }}
							<div class="col-12 col-sm-12 col-md-10 col-lg-10 col-xl-10">
								{{ Form::text('note', old('note', $estimate->note ?? ''), array('class' => 'form-control form-control-sm')) }}
							</div>
						</div>

						<div class="row mb-3">
							{{ Form::label('content', 'Content', ['class'=>'col-12 col-sm-12 col-md-2 col-lg-2 col-xl-2 col-form-label col-form-label-sm responsive-text-right']) }}
							<div class="col-12 col-sm-12 col-md-12 col-lg-10 col-xl-10">
								{{ Form::textarea('content', old('content', $estimate->content ?? ''), array('rows'=>3,'class' => 'form-control form-control-sm')) }}
							</div>
						</div>


						<div class="mb-3 row">
							<label for="thirdparty_idID" class="col-12 col-sm-12 col-md-2 col-lg-2 col-xl-2 col-form-label col-form-label-sm responsive-text-right">Cliente</label>
							<div class="col-12 col-sm-12 col-md-9 col-lg-10 col-xl-10">
								<select name="thirdparty_id" id="thirdparty_idID" class="form-select form-select-sm" title="Seleziona un cliente">
									@isset($thirdies)
										@foreach ($thirdies AS $c)
										<option value="{{ $c->id }}" {{ $estimate->thirdparty_id == $c->id ? ' selected="selected"' : '' }}>{{ $c->name }} {{ $c->surname }}</option>
										@endforeach
									@endisset
								</select>
							</div>
						</div>

						<div class="row mb-3">
							{{ Form::label('alt_thirdparty', 'Altro Indirizzo', ['class'=>'col-12 col-sm-12 col-md-2 col-lg-2 col-xl-2 col-form-label col-form-label-sm responsive-text-right']) }}
							<div class="col-12 col-sm-12 col-md-9 col-lg-10 col-xl-10">
								{{ Form::textarea('alt_thirdparty', old('alt_thirdparty', $estimate->alt_thirdparty ?? ''), array('rows'=>3,'class' => 'form-control form-control-sm')) }}
							</div>
						</div>


					</fieldset>
				<hr>

				<div class="row">
					<div class="col-12 col-sm-12 col-md-8 col-lg-8 col-xl-8 responsive-text-right"> Totale preventivo</div>
					<div class="col-12 col-sm-12 col-md-4 col-lg-4 col-xl-4 responsive-text-right">€ <span id="estimate_strarticles_totalID"></span></div>
					<div class="col-12 col-sm-12 col-md-8 col-lg-8 col-xl-8 responsive-text-right"> Imponibile</div>
					<div class="col-12 col-sm-12 col-md-4 col-lg-4 col-xl-4 responsive-text-right">{{ $estimate_tax }} %</div>
					<div class="col-12 col-sm-12 col-md-8 col-lg-8 col-xl-8 responsive-text-right"> Imponibile</div>
					<div class="col-12 col-sm-12 col-md-4 col-lg-4 col-xl-4 responsive-text-right">€ <span id="estimate_strprice_taxID"></span></div>
					<div class="col-12 col-sm-12 col-md-8 col-lg-8 col-xl-8 responsive-text-right"> Totale</div>
					<div class="col-12 col-sm-12 col-md-4 col-lg-4 col-xl-4 responsive-text-right">€ <span id="estimate_strtotalID"></span></div>


					<input type="input" name="estimate_articles_total" id="estimate_articles_totalID" value="">
					<input type="input" name="estimate_tax" id="estimate_taxID" value="{{ $estimate_tax }}">

				</div>

				<hr>
				<div class="mb-3 row">

					<div class="col-6 text-center">
						<button id="submitFormID" type="submit" name="submitForm" value="submit" class="btn btn-primary">Invia</button>
					</div>

					<div class="col-6 text-end">
						<a href="{{ route('estimates.index') }}" title="Torna alla lista" class="btn btn-success">Indietro</a>
					</div>

				</div>


				<input type="input" name="estimate_id" id="estimate_idID" value="{{ $estimate->id }}">

				{{ Form::close() }}


			</div>
		</div>










	</div>
</div>
</div>
@stop