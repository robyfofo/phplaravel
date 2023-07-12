@extends('layouts.app')

@section('content')

<div class="row">
  <div class="col-md-3 new">
  </div>
  <div class="col-md-7 help-small-form">
  </div>
  <div class="col-md-2 help">
  </div>
</div>


<div class="row">
  <div class="col-md-7 calendar">
    @include('timecards.calendar')
  </div>

  <div class="col-md-5 forms">


    <div class="card mt-3 mb-4">
      <div class="card-body">

        {!! Form::open(['route' => 'timecards.store']) !!}


        
        <div class="mb-3 row">
          <label for="newtimecarddataInput" class="col-md-3 col-form-label">Data</label>
          <div class="col-md-6">

            <div class="input-group" id="newtimecarddata" data-td-target-input="nearest" data-td-target-toggle="nearest">
              <input name="newtimecarddata" id="newtimecarddataInput" type="text" class="form-control" data-td-target="#newtimecarddata">
              <span class="input-group-text" data-td-target="#newtimecarddata" data-td-toggle="datetimepicker">
                <span class="fas fa-calendar"></span>
              </span>
            </div>

          </div>
        </div>


        <div class="mb-3 row">
          <label for="progettoID" class="col-md-3 col-form-label">Progetto</label>
          <div class="col-md-8">
            <select name="project_id" id="project_idID" class="form-select" title="Seleziona un progetto">
              @isset($projects)
                @foreach ($projects AS $p)
                  <option value="{{ $p->id }}">{{ $p->title }}</option>														
                @endforeach
              @endisset
            </select>										
          </div>
        </div>


        <div class="mb-3 row">
          <label for="newtimecardstarttimeInput" class="col-md-3 col-form-label">Inizio</label>
          <div class="col-md-6">

            <div class="input-group" id="newtimecardstarttime" data-td-target-input="nearest" data-td-target-toggle="nearest">
              <input value="" name="newtimecardstarttime" id="newtimecardstarttimeInput" type="text" class="form-control" data-td-target="#newtimecardstarttime">
              <span class="input-group-text" data-td-target="#newtimecardstarttime" data-td-toggle="datetimepicker">
                <span class="fas fa-clock"></span>
              </span>
            </div>

          </div>
        </div>

        <div class="mb-3 row">
          <label for="newtimecardendtimeInput" class="col-md-3 col-form-label">Fine</label>
          <div class="col-md-6">

            <div class="input-group" id="newtimecardendtime" data-td-target-input="nearest" data-td-target-toggle="nearest">
              <input value="" name="newtimecardendtime" id="newtimecardendtimeInput" type="text" class="form-control" data-td-target="#newtimecardendtime">
              <span class="input-group-text" data-td-target="#newtimecardendtime" data-td-toggle="datetimepicker">
                <span class="fas fa-clock"></span>
              </span>
            </div>

          </div>
        </div>

        <div class="md-3 row">
						<label for="contentID" class="col-md-3">Contenuto</label>
						<div class="col-md-8">
							<textarea name="content" class="form-control" id="contentID" rows="5"></textarea>
						</div>
					</div>	

        <div class="mt-3 row">

          <div class="col-md-12 text-center">
            <button type="submit" class="btn btn-sm btn-primary mt-1">Invia</button>
          </div>

        </div>

      </div>




      {{ Form::close() }}

    </div>
  </div>

</div>
</div>

@stop