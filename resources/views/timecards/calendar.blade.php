<div class="row mb-2">
  <div class="col-md-12 new">

        <form id="applicationForm" class="form-horizontal" role="form" action="{{ route('timecards.index') }}" enctype="multipart/form-data" method="GET">

          <div class="mb-3 row">
            <label for="datatimecardInput" class="col-md-2 col-form-label">Data</label>
            <div class="col-md-3">

              <div class="input-group" id="datatimecard" data-td-target-input="nearest" data-td-target-toggle="nearest">
                <input name="datatimecard" id="datatimecardInput" type="text" class="form-control" data-td-target="#datatimecard">
                <span class="input-group-text" data-td-target="#datatimecard" data-td-toggle="datetimepicker">
                  <span class="fas fa-calendar"></span>
                </span>
              </div>

            </div>

            <div class="col-md-6">
              <button type="submit" class="btn btn-sm btn-primary mt-1">Invia</button>
            </div>

          </div>

        </form>

  </div>
</div>


<div class="card card-default">

  <div id="accordionIcon" class="accordion mt-3 accordion-without-arrow">

    @isset($dates_month)

    @foreach ($dates_month as $key=>$day)

    <div class="accordion-item card">
      <h2 class="accordion-header text-body d-flex justify-content-between" id="accordionIconOne">
        <button type="button" class="accordion-button collapsed" data-bs-toggle="collapse" data-bs-target="#accordionIcon-{{ $loop->index }}" aria-controls="accordionIcon-{{ $loop->index }}">
          @if ($datatimecardIso == $day['value'])<strong>@endif
            {{ $day['label'] }}&nbsp;-&nbsp;{{ $day['nameday'] }}
            @if ($datatimecardIso == $day['value'])</strong>@endif
        </button>

        @if ($timecards_total[$day['value']] != '00:00:00')
        <span style="font-size: 1.1rem !important;" class="float-right pt-2 pe-2">

          {{ $timecards_total[$day['value']] }}

        </span>
        @endif


      </h2>

      <div id="accordionIcon-{{ $loop->index }}" class="accordion-collapse collapse" data-bs-parent="#accordionIcon">
        <div class="accordion-body">
          <table class="table table-striped table-bordered table-hover table-sm subtimecards tooltip-proj">
            <tbody>

              @foreach ($timecards[$day['value']]['timecards'] AS $d)

              <tr>
                <td data-toggle="tooltip" data-placement="top" title="{{ $d->project }}">{{ $d->project }}</td>
                <td data-toggle="tooltip" data-placement="top" title="{{ $d->content }}">{{ $d->content }}</td>
                <td style="width:55px;">IOw: {{ $d->user_id }}</td>
                <td class="hours text-end">{{ \Illuminate\Support\Str::limit($d->starttime, 5, '') }}-{{ \Illuminate\Support\Str::limit($d->endtime,5,'') }}</td>
                <td class="tothours text-end">
                  <a class="" href="" title="Modifica">{{ \Illuminate\Support\Str::limit($d->worktime,5,'') }}</a>
                </td>


              </tr>

              <tr class="">
                <td colspan="4">&nbsp;</td>
                <td style="font-size: 1.3rem !important;" class="hours text-end success">{{ \Illuminate\Support\Str::limit($timecards_total[$day['value']],5,'') }}</td>
              </tr>

              @endforeach


            </tbody>
          </table>
        </div>
      </div>
    </div>

    @endforeach

    @endisset

  </div>


  <div class="card-footer">
    <div class="row">
      <div class="col-md-9 ore-totali text-end">
        Tempo totale:
      </div>
      <div class="col-md-3 text-end">
        <span class="value">{{ \Illuminate\Support\Str::limit($timecards_total_time,5,'') }}</span>
      </div>
    </div>
  </div>

  <div class="card-footer">

    <div class="row">
      <span class="timestamp-project-used-label">
        Progetti lavorati:
      </span>
      @foreach ($id_project_used AS $key=>$value)
      <span class="timestamp-projeck-used"><a href="" title="Guarda le timecard di questo progetto">{{ $value }}</a></span>
      @endforeach

    </div>

  </div>

</div>