@extends('layouts.app')

@section('content')

<div class="row">

  <div class="col-lg-8 mb-4 order-0">
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


  <div class="col-lg-4 mb-4 order-1">
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

@stop