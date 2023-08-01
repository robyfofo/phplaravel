<div class="row">
  <div class="col-12 col-sm-12 col-md-8 col-lg-9 col-xl-9">


    @isset($articles)

    @php

    $estimate_total = 0;
    $estimate_tax = 10;

    @endphp

    <div class="accordion mt-3" id="accordionArticles">
      @foreach($articles as $article)
      @php

      $article->tax = 10;
      $article->taxvalue = ($article->total * $article->tax)/100;
      $article->totaltopay = $article->total + $article->taxvalue;

      $estimate_total += $article->total;
      @endphp
      <div class="card accordion-item">

        <h2 class="accordion-header" id="headingOne">
          <button type="button" class="accordion-button" data-bs-toggle="collapse" data-bs-target="#accordion{{ $article->id }}" aria-expanded="true" aria-controls="accordion{{ $article->id }}">
            {{ $article->note }}
          </button>
        </h2>

        <div id="accordion{{ $article->id }}" class="accordion-collapse collapse py-3 px-3" data-bs-parent="#accordionArticles">



          <div class="row">

            <div class="col-12 col-sm-7 col-md-7 col-lg-8 col-xl-9">
              <label class="col-form-label col-form-label-sm" for="art_noteID">Note</label>
              <input class="form-control form-control-sm" name="art_note" id="art_noteIT" value="{{ $article->note }}">
            </div>

            <div class="col-3 col-sm-2 col-md-2 col-lg-2 col-xl-1">
              <label class="col-form-label col-form-label-sm" for="art_quantityID">Quantità</label>
              <input class="form-control form-control-sm" name="art_quantity" id="art_quantityIT" value="{{ $article->quantity }}">
            </div>

            <div class="col-4 col-sm-3 col-md-3 col-lg-2 col-xl-2">
              <label class="col-form-label col-form-label-sm" for="art_valueID">Prezzo</label>
              <input class="form-control form-control-sm text-end" name="art_value" id="art_valueIT" value="{{ $article->value }}">
            </div>

          </div>

          <div class="row py-3">

            <div class="col-12 col-sm-7 col-md-7 col-lg-7 col-xl-8">
              <label class="col-form-label col-form-label-sm" for="art_contentID">Contenuto</label>
              <textarea rows="5" class="form-control form-control-sm" name="art_content" id="art_contentIT">{{ $article->content }}</textarea>
            </div>

            <div class="col-12 col-sm-5 col-md-5 col-lg-5 col-xl-4">
              <div class="row">
                <div class="col-12 col-sm-12 col-md-8 col-lg-8 col-xl-8 responsive-text-right"> Totale articolo</div>
                <div class="col-12 col-sm-12 col-md-4 col-lg-4 col-xl-4 responsive-text-right">€ {{ number_format($article->total,2,',','.') }}</div>
                <div class="col-12 col-sm-12 col-md-8 col-lg-8 col-xl-8 responsive-text-right"> Imponibile</div>
                <div class="col-12 col-sm-12 col-md-4 col-lg-4 col-xl-4 responsive-text-right">{{ $article->tax }} %</div>
                <div class="col-12 col-sm-12 col-md-8 col-lg-8 col-xl-8 responsive-text-right"> Imponibile</div>
                <div class="col-12 col-sm-12 col-md-4 col-lg-4 col-xl-4 responsive-text-right">€ {{ number_format($article->taxvalue,2,',','.') }}</div>
                <div class="col-12 col-sm-12 col-md-8 col-lg-8 col-xl-8 responsive-text-right"> Totale</div>
                <div class="col-12 col-sm-12 col-md-4 col-lg-4 col-xl-4 responsive-text-right">€ {{ number_format($article->totaltopay,2,',','.') }}</div>
              </div>
            </div>

          </div>

          <div class="row">
            <div class="col text-end">
            <a href="javascript:void(0);" data-id="{{ $article->id }}" class="deletearticle" title="Cancella questo articolo"><i class="bx bx-md bx-trash"></i></a>
            </div>
          </div>


        </div>

      </div>

      @endforeach
    </div>
    @endisset

    <hr>

    <div class="card mt-3 mb-4">
      <div class="card-body">

        <div class="row">

          <div class="col-12 col-sm-7 col-md-7 col-lg-8 col-xl-9">
            <label class="col-form-label col-form-label-sm" for="art_noteID">Note</label>
            <input class="form-control form-control-sm" name="art_note" id="art_noteIT" value="">
          </div>

          <div class="col-3 col-sm-2 col-md-2 col-lg-2 col-xl-1">
            <label class="col-form-label col-form-label-sm" for="art_quantityID">Quantità</label>
            <input class="form-control form-control-sm" name="art_quantity" id="art_quantityIT" value="">
          </div>

          <div class="col-4 col-sm-3 col-md-3 col-lg-2 col-xl-2">
            <label class="col-form-label col-form-label-sm" for="art_valueID">Prezzo</label>
            <input class="form-control form-control-sm text-end" name="art_value" id="art_valueIT" value="">
          </div>

        </div>

        <div class="row py-3">

          <div class="col-12 col-sm-7 col-md-7 col-lg-7 col-xl-8">
            <label class="col-form-label col-form-label-sm" for="art_contentID">Contenuto</label>
            <textarea rows="5" class="form-control form-control-sm" name="art_content" id="art_contentIT"></textarea>
          </div>

          

          <div class="col-12 col-sm-5 col-md-5 col-lg-5 col-xl-4">
            <div class="row">
              <div class="col-12 col-sm-12 col-md-8 col-lg-8 col-xl-8 responsive-text-right"> Totale articolo</div>
              <div class="col-12 col-sm-12 col-md-4 col-lg-4 col-xl-4 responsive-text-right">€ <span id="art_totalID"></span></div>
              <div class="col-12 col-sm-12 col-md-8 col-lg-8 col-xl-8 responsive-text-right"> Imponibile</div>
              <div class="col-12 col-sm-12 col-md-4 col-lg-4 col-xl-4 responsive-text-right">{{ $article->tax }} %</div>
              <div class="col-12 col-sm-12 col-md-8 col-lg-8 col-xl-8 responsive-text-right"> Imponibile</div>
              <div class="col-12 col-sm-12 col-md-4 col-lg-4 col-xl-4 responsive-text-right">€ {{ number_format($article->taxvalue,2,',','.') }}</div>
              <div class="col-12 col-sm-12 col-md-8 col-lg-8 col-xl-8 responsive-text-right"> Totale</div>
              <div class="col-12 col-sm-12 col-md-4 col-lg-4 col-xl-4 responsive-text-right">€ {{ number_format($article->totaltopay,2,',','.') }}</div>
            </div>
          </div>

        </div>

      </div>
    </div>

  </div>

  <div class="col-12 col-sm-12 col-md-4 col-lg-3 col-xl-3">

    @php
      $estimate_tax = 10;
      $estimate_taxvalue = ($estimate_total * $estimate_tax )/100;
      $estimate_totaltopay = $estimate_total + $estimate_taxvalue;
    @endphp

    <div class="row">
      <div class="col-12 col-sm-12 col-md-8 col-lg-8 col-xl-8 responsive-text-right"> Totale preventivo</div>
      <div class="col-12 col-sm-12 col-md-4 col-lg-4 col-xl-4 responsive-text-right">€ {{ number_format($estimate_total,2,',','.') }}</div>
      <div class="col-12 col-sm-12 col-md-8 col-lg-8 col-xl-8 responsive-text-right"> Imponibile</div>
      <div class="col-12 col-sm-12 col-md-4 col-lg-4 col-xl-4 responsive-text-right">{{ $estimate_tax }} %</div>
      <div class="col-12 col-sm-12 col-md-8 col-lg-8 col-xl-8 responsive-text-right"> Imponibile</div>
      <div class="col-12 col-sm-12 col-md-4 col-lg-4 col-xl-4 responsive-text-right">€ {{ $estimate_taxvalue }}</div>
      <div class="col-12 col-sm-12 col-md-8 col-lg-8 col-xl-8 responsive-text-right"> Totale</div>
      <div class="col-12 col-sm-12 col-md-4 col-lg-4 col-xl-4 responsive-text-right">€ {{ number_format($estimate_totaltopay,2,',','.') }}</div>
    </div>


  </div>

</div>