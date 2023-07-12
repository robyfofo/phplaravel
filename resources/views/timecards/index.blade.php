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

        {!! Form::open(['route' => 'projects.store']) !!}


        
        <div class="mb-3 row">
          <label for="newtimecarddataInput" class="col-md-2 col-form-label">Data</label>
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
          <label for="progettoID" class="col-md-2">Progetto</label>
          <div class="col-md-8">
            <select name="projects_id" id="projects_idID" class="form-select" title="Seleziona un progetto">
              @isset($projects)
                @foreach ($projects AS $p)
                  <option value="{{ $p->id }}">{{ $p->title }}</option>														
                @endforeach
              @endisset
            </select>										
          </div>
        </div>


        <div class="mb-3 row">
          <label for="newtimecardstarttimeInput" class="col-md-2 col-form-label">Inizio</label>
          <div class="col-md-6">

            <div class="input-group" id="newtimecardstarttime" data-td-target-input="nearest" data-td-target-toggle="nearest">
              <input name="newtimecardstarttime" id="newtimecardstarttimeInput" type="text" class="form-control" data-td-target="#newtimecardstarttime">
              <span class="input-group-text" data-td-target="#newtimecardstarttime" data-td-toggle="datetimepicker">
                <span class="fas fa-clock"></span>
              </span>
            </div>

          </div>
        </div>

        <div class="mb-3 row">

          <div class="col-md-12">
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