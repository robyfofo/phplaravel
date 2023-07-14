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

        {{ Form::model($timecard, array('route' => array('timecards.update', $timecard->id), 'method' => 'PUT')) }}


        
        <div class="mb-3 row">
          <label for="dateinsInput" class="col-md-3 col-form-label">Data</label>
          <div class="col-md-6">

            <div class="input-group" id="dateins" data-td-target-input="nearest" data-td-target-toggle="nearest">
              <input name="dateins" id="dateinsInput" type="text" class="form-control" data-td-target="#dateins">
              <span class="input-group-text" data-td-target="#dateins" data-td-toggle="datetimepicker">
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
                  <option value="{{ $p->id }}"{{ $timecard->project_id == $p->id ? ' selected="selected"' : '' }}>{{ $p->title }}</option>														
                @endforeach
              @endisset
            </select>										
          </div>
        </div>
        
        
        <div class="mb-3 row">
          <label for="starttimeInput" class="col-md-3 col-form-label">Inizio</label>
          <div class="col-md-6">
            
            <div class="input-group" id="starttime" data-td-target-input="nearest" data-td-target-toggle="nearest">
              <input value="" name="starttime" id="starttimeInput" type="text" class="form-control" data-td-target="#starttime">
              <span class="input-group-text" data-td-target="#starttime" data-td-toggle="datetimepicker">
                <span class="fas fa-clock"></span>
              </span>
            </div>

          </div>
        </div>

        
        <div class="mb-3 row">
          <label for="endtimeInput" class="col-md-3 col-form-label">Fine</label>
          <div class="col-md-6">

            <div class="input-group" id="endtime" data-td-target-input="nearest" data-td-target-toggle="nearest">
              <input value="" name="endtime" id="endtimeInput" type="text" class="form-control" data-td-target="#endtime">
              <span class="input-group-text" data-td-target="#endtime" data-td-toggle="datetimepicker">
                <span class="fas fa-clock"></span>
              </span>
            </div>

          </div>
        </div>

        <div class="md-3 row">
						<label for="contentID" class="col-md-3">Contenuto</label>
						<div class="col-md-8">
							<textarea name="content" class="form-control" id="contentID" rows="5">{{ $timecard->content }}</textarea>
						</div>
					</div>	

        <div class="mt-3 row">

          <div class="col-md-12 text-center">
            <input type="hidden" name="id" id="idID" value="{{ $timecard->id }}">
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