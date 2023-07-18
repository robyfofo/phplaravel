@extends('layouts.app')

@section('content')

<div class="row mb-3">

  <div class="col-md-4">

    <div class="card">
      <div class="d-flex align-items-end row">
        <div class="col-sm-8">
          <div class="card-body">
            <h5 class="card-title text-primary">Congratulazioni {{ auth()->user()->name }}! 🎉</h5>
            <p class="mb-4">
              Questa applicazione in continuo sviluppo vuole simulare un software per la gestione di progetti e mi serve per imparare lo sviluppo con il framework Laravel.
            </p>
            <p>L'interfaccia grafica utilizzata e sviluppata sul template <a class="footer-link fw-bolder" href="https://themeselection.com/item/sneat-free-bootstrap-html-admin-template/" target="_blank" title="Sneat – Free Bootstrap 5 HTML Admin Template">Sneat</a> scaricato da <a title="Theme Selection" href="https://themeselection.com" target="_blank" class="footer-link fw-bolder">ThemeSelection</a>


          </div>
        </div>
        <div class="col-sm-4 text-center text-sm-left">
          <div class="card-body pb-0 px-0 px-md-4">
            <img src="/assets/img/illustrations/man-with-laptop-light.png" height="140" alt="View Badge User" data-app-dark-img="illustrations/man-with-laptop-dark.png" data-app-light-img="illustrations/man-with-laptop-light.png" />
          </div>
        </div>
      </div>
    </div>


  </div>
  <div class="col-md-8">

    <div class="card">
      <div class="d-flex align-items-end row">
        <div class="col-sm-12">
          <div class="card-body">
            <h5 class="card-title text-primary">Caratteristiche</h5>

            <p class="mb-4">
              In questa applicazioni ho implementato soluzioni che mi sono servite per imparare lo sviluppo di Laravel. Ecco un elenco:
            </p>
            <ul>
              <li>Sistema modulare</li>
              <li>Moduli con la gestione CRUD</li>
              <li>Menu laterale dinamico e a due livelli. I moduli appaiono in base alla lo attivazione</li>
              <li>Le liste dei dati hanno le opzioni numero voci visibili, ricerca e paginazione</li>
              <li>Funzione ordinamento dinamico nella lista voci in tabella</li>
              <li>Gestione di un flag attivazione per tutte le voci con switch ajax nelle tabella</li>
              <li>Gestione categoria multilivello con ordinamento e vista tebell ad albero (jquery)</li>
              <li>Gestione tempi lavorativi (timecard) con uso di query custom</li>
              <li>Creazione di documenti pdf per esporazioni dati</li>


            </ul>

          </div>
        </div>
      </div>
    </div>


  </div>


</div>

<!-- nuovi inserimenti -->
<div class="row">

  <div class="col-lg-3 mb-4 order-1">
    <div class="card">
      <div class="card-body">
        <div class="card-title d-flex align-items-start justify-content-between">
          <div class="avatar flex-shrink-0">
            <h3 class="card-title text-nowrap mb-2">
              <i class="menu-icon tf-icons bx bx-lg bx-pyramid"></i>
              {{ $lastprojects }}
            </h3>
          </div>
        </div>
        <span class="d-block mb-1">Nuovi progetti</span>
      </div>
    </div>
  </div>

  <div class="col-lg-3 mb-4 order-1">
    <div class="card">
      <div class="card-body">
        <div class="card-title d-flex align-items-start justify-content-between">
          <div class="avatar flex-shrink-0">
            <h3 class="card-title text-nowrap mb-2">
              <i class="menu-icon tf-icons bx bx-lg bx-alarm"></i>
              {{ $lasttimecards }}
            </h3>
          </div>
        </div>
        <span class="d-block mb-1">Nuove timecard</span>
      </div>
    </div>
  </div>

  <div class="col-lg-3 mb-4 order-1">
    <div class="card">
      <div class="card-body">
        <div class="card-title d-flex align-items-start justify-content-between">
          <div class="avatar flex-shrink-0">
            <h3 class="card-title text-nowrap mb-2">
              <i class="menu-icon tf-icons bx bx-lg bx-group"></i>
              {{ $lastthirdparty }}
            </h3>
          </div>
        </div>
        <span class="d-block mb-1">Nuovi clienti</span>
      </div>
    </div>
  </div>
</div>
<!-- nuovi inserimenti -->

<!--tabelle -->
<div class="row">

  <!-- ultimi progetti -->
  <div class="col-lg-6 mb-2 order-1">
    <div class="card">
      <div class="card-header">
        <div class="card-title d-flex">
          <i class="menu-icon tf-icons bx bx-pyramid"></i> Ultimi progetti
        </div>
      </div>
      <div class="card-body">
        <table class="table table-sm table-bordered listData">
          <thead>
            <tr>
              <th></th>
              <th>Titolo</th>
              <th>Status</th>
              <th>Completato</th>
            </tr>
          </thead>

          <tbody>
            @foreach($projects as $project)
            <tr>
              <td>
                <a href="javascript:void(0)" data-bs-toggle="tooltip" data-bs-offset="0,4" data-bs-placement="right" data-bs-html="true" title="Creato il: {{ $project->created_at }}<br>Aggiornato il: {{ $project->updated_at }}">
                  <i class="menu-icon tf-icons bx bx-alarm"></i>
                </a>
              </td>
              <td>{{ $project->title }}</td>
              <td>
                <?php
                echo Config::get('settings.project_status.' . $project->status);
                ?>
              </td>
              <td>{{ $project->completato }}</td>
            </tr>
            @endforeach
          </tbody>

        </table>
      </div>
    </div>
  </div>
  <!-- ultimi progetti -->

  <!-- ultime tiecards -->
  <div class="col-lg-6 mb-2 order-2">
    <div class="card">
      <div class="card-header">
        <div class="card-title d-flex">
          <i class="menu-icon tf-icons bx bx-alarm"></i> Ultime timecards
        </div>
      </div>
      <div class="card-body">
        <table class="table table-sm table-bordered listData">
          <thead>
            <tr>
              <th>Date</th>
              <th>Contenuto</th>
              <th>Tempo</th>
            </tr>
          </thead>

          <tbody>
            @foreach($timecards as $timecard)
            <tr>
              <td>{{ $timecard->dateins }}</td>
              <td>{{ $timecard->content }}</td>
              <td>{{ $timecard->worktime }}</td>
            </tr>
            @endforeach
          </tbody>

        </table>
      </div>
    </div>
  </div>
  <!-- ultime tiecards -->

  <!-- ultimi clienti -->
  <div class="col-lg-6 mb-2 order-3">
    <div class="card">
      <div class="card-header">
        <div class="card-title d-flex">
          <i class="menu-icon tf-icons bx bx-group"></i> Ultimi clienti
        </div>
      </div>
      <div class="card-body">
        <table class="table table-sm table-bordered listData">
          <thead>
            <tr>
              <th></th>
              <th>Nome</th>
              <th>Cognome</th>
            </tr>
          </thead>

          <tbody>
            @foreach($thirdparties as $thirdparty)
            <tr>
              <td>
                <a href="javascript:void(0)" data-bs-toggle="tooltip" data-bs-offset="0,4" data-bs-placement="right" data-bs-html="true" title="Creato il: {{ $project->created_at }}<br>Aggiornato il: {{ $project->updated_at }}">
                  <i class="menu-icon tf-icons bx bx-alarm"></i>
                </a>
              </td>
              <td>{{ $thirdparty->name }}</td>
              <td>{{ $thirdparty->surname }}</td>
            </tr>
            @endforeach
          </tbody>

        </table>
      </div>
    </div>
  </div>
  <!-- ultimi clienti -->


</div>


@stop