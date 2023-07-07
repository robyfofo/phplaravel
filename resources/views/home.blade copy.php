@extends('layouts.app')

@section('content')

<div class="row">


  <div class="col-lg-8 mb-4 order-0">
    <div class="card">
      <div class="d-flex align-items-end row">
        <div class="col-sm-7">
          <div class="card-body">
            <h5 class="card-title text-primary">Congratulazioni {{ auth()->user()->name }}! 🎉</h5>
            <p class="mb-4">
              Questa applicazione in continuo sviluppo vuole simulare un software per la gestione di progetti e mi serve per imparare lo sviluppo con il framework Laravel.
            </p>
            <p>L'interfaccia grafica utilizzata e sviluppata sul template <a class="footer-link fw-bolder" href="https://themeselection.com/item/sneat-free-bootstrap-html-admin-template/" target="_blank" title="Sneat – Free Bootstrap 5 HTML Admin Template">Sneat</a> scaricato da <a title="Theme Selection" href="https://themeselection.com" target="_blank" class="footer-link fw-bolder">ThemeSelection</a>

            
          </div>
        </div>
        <div class="col-sm-5 text-center text-sm-left">
          <div class="card-body pb-0 px-0 px-md-4">
            <img src="/assets/img/illustrations/man-with-laptop-light.png" height="140" alt="View Badge User" data-app-dark-img="illustrations/man-with-laptop-dark.png" data-app-light-img="illustrations/man-with-laptop-light.png" />
          </div>
        </div>
      </div>
    </div>
  </div>


  <div class="col-lg-4 mb-4 order-0">
    <div class="card">
      <div class="d-flex align-items-end row">
        <div class="col-sm-7">
          <div class="card-body">
            <h5 class="card-title text-primary">Congratulazioni {{ auth()->user()->name }}! 🎉</h5>
            <p class="mb-4">
              Questa applicazione in continuo sviluppo vuole simulare un software per la gestione di progetti e mi serve per imparare lo sviluppo con il framework Laravel.
            </p>
            <p>L'interfaccia grafica utilizzata e sviluppata sul template <a class="footer-link fw-bolder" href="https://themeselection.com/item/sneat-free-bootstrap-html-admin-template/" target="_blank" title="Sneat – Free Bootstrap 5 HTML Admin Template">Sneat</a> scaricato da <a title="Theme Selection" href="https://themeselection.com" target="_blank" class="footer-link fw-bolder">ThemeSelection</a>

            
          </div>
        </div>
      
    </div>
  </div>






</div>
</div>

  @stop