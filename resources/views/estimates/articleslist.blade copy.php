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
      $article->price_tax = ($article->price_total * $article->tax)/100;
      $article->total = $article->price_total + $article->price_tax;

      $estimate_total += $article->total;
      @endphp
      <div class="card accordion-item articles" id="article{{ $article->id }}">

        <div class="accordion-header" id="headingOne">

          
          <button type="button" class="accordion-button collapsed" data-bs-toggle="collapse" data-bs-target="#accordion{{ $article->id }}" aria-expanded="true" aria-controls="accordion{{ $article->id }}">{{ $article->note }}</button> 
        </div>

        <div id="accordion{{ $article->id }}" class="accordion-collapse collapse py-3 px-3" data-bs-parent="#accordionArticles">
          <div class="row">

            <div class="col-12 col-sm-7 col-md-7 col-lg-8 col-xl-9">
              <label class="col-form-label col-form-label-sm" for="art_noteID">Note</label>
              <input class="form-control form-control-sm" name="art_note[{{ $article->id }}]" id="art_note{{ $article->id }}ID" value="{{ $article->note }}">
            </div>

            <div class="col-3 col-sm-2 col-md-2 col-lg-2 col-xl-1">
              <label class="col-form-label col-form-label-sm" for="art_quantityID">Q.tà</label>
              <input class="form-control form-control-sm" name="art_quantity[{{ $article->id }}]" id="art_quantity{{ $article->id }}ID" value="{{ $article->quantity }}">
            </div>

            <div class="col-4 col-sm-3 col-md-3 col-lg-2 col-xl-2">
              <label class="col-form-label col-form-label-sm" for="art_price_unityID">Prezzo</label>
              <input class="form-control form-control-sm text-end" name="art_price_unity{{ $article->id }}" id="art_price_unity{{ $article->id }}ID" value="{{ $article->price_unity }}">
            </div>

          </div>

          <div class="row py-3">

            <div class="col-12 col-sm-7 col-md-7 col-lg-7 col-xl-8">
              <label class="col-form-label col-form-label-sm" for="art_contentID">Contenuto</label>
              <textarea rows="5" class="form-control form-control-sm" name="art_content[{{ $article->id }}]" id="art_content{{ $article->id }}ID">{{ $article->content }}</textarea>
            </div>

            <div class="col-12 col-sm-5 col-md-5 col-lg-5 col-xl-4">
              <div class="row">
                <div class="col-12 col-sm-12 col-md-8 col-lg-8 col-xl-8 responsive-text-right"> Totale articolo</div>
                <div class="col-12 col-sm-12 col-md-4 col-lg-4 col-xl-4 responsive-text-right">€ <span id="art_strprice_total{{ $article->id }}ID">{{ number_format($article->pricetotal,2,',','.') }}</span></div>
                <div class="col-12 col-sm-12 col-md-8 col-lg-8 col-xl-8 responsive-text-right"> Imponibile</div>
                <div class="col-12 col-sm-12 col-md-4 col-lg-4 col-xl-4 responsive-text-right">{{ $article->tax }} %</div>
                <div class="col-12 col-sm-12 col-md-8 col-lg-8 col-xl-8 responsive-text-right"> Imponibile</div>
                <div class="col-12 col-sm-12 col-md-4 col-lg-4 col-xl-4 responsive-text-right">€ <span id="art_strprice_tax{{ $article->id }}ID">{{ number_format($article->price_tax,2,',','.') }}</span></div>
                <div class="col-12 col-sm-12 col-md-8 col-lg-8 col-xl-8 responsive-text-right"> Totale</div>
                <div class="col-12 col-sm-12 col-md-4 col-lg-4 col-xl-4 responsive-text-right">€ <span id="art_strtotal{{ $article->id }}ID">{{ number_format($article->total,2,',','.') }}</span></div>

                <input type="hidden" id="art_total{{ $article->id }}ID" value="{{ $article->total }}">
              
              
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
            <input class="form-control form-control-sm" name="art_note" id="art_noteID" value="">
          </div>

          <div class="col-3 col-sm-2 col-md-2 col-lg-2 col-xl-1">
            <label class="col-form-label col-form-label-sm" for="art_quantityID">Quantità</label>
            <input class="form-control form-control-sm" name="art_quantity" id="art_quantityID" value="1">
          </div>

          <div class="col-4 col-sm-3 col-md-3 col-lg-2 col-xl-2">
            <label class="col-form-label col-form-label-sm" for="art_price_unityID">Prezzo</label>
            <input class="form-control form-control-sm text-end" name="art_price_unity" id="art_price_unityID" value="">
          </div>

        </div>

        <div class="row py-3">

          <div class="col-12 col-sm-7 col-md-7 col-lg-7 col-xl-8">
            <label class="col-form-label col-form-label-sm" for="art_contentID">Contenuto</label>
            <textarea rows="5" class="form-control form-control-sm" name="art_content" id="art_contentID"></textarea>
          </div>

          

          <div class="col-12 col-sm-5 col-md-5 col-lg-5 col-xl-4">
            <div class="row">
              <div class="col-12 col-sm-12 col-md-8 col-lg-8 col-xl-8 responsive-text-right"> Totale articolo</div>
              <div class="col-12 col-sm-12 col-md-4 col-lg-4 col-xl-4 responsive-text-right">€ <span id="art_price_totalID"></span></div>
              <div class="col-12 col-sm-12 col-md-8 col-lg-8 col-xl-8 responsive-text-right"> Imponibile</div>
              <div class="col-12 col-sm-12 col-md-4 col-lg-4 col-xl-4 responsive-text-right"><span id="art_taxID">{{ $article->tax }}</span> %</div>
              <div class="col-12 col-sm-12 col-md-8 col-lg-8 col-xl-8 responsive-text-right"> Imponibile</div>
              <div class="col-12 col-sm-12 col-md-4 col-lg-4 col-xl-4 responsive-text-right">€ <span id="art_price_taxID">{{ number_format($article->price_tax,2,',','.') }}</span></div>
              <div class="col-12 col-sm-12 col-md-8 col-lg-8 col-xl-8 responsive-text-right"> Totale</div>
              <div class="col-12 col-sm-12 col-md-4 col-lg-4 col-xl-4 responsive-text-right">€ <span id="art_totalID">{{ number_format($article->total,2,',','.') }}</span></div>
            </div>
          </div>

        </div>

      </div>
    </div>

  </div>

  <div class="col-12 col-sm-12 col-md-4 col-lg-3 col-xl-3">

    @php
      $estimate_tax = 10;
      $estimate_price_tax = ($estimate_total * $estimate_tax )/100;
      $estimate_totaltaxed = $estimate_total + $estimate_price_tax;
    @endphp

    <div class="row">
      <div class="col-12 col-sm-12 col-md-8 col-lg-8 col-xl-8 responsive-text-right"> Totale preventivo</div>
      <div class="col-12 col-sm-12 col-md-4 col-lg-4 col-xl-4 responsive-text-right">€ <span id="estimate_strtotalID">{{ number_format($estimate_total,2,',','.') }}</span></div>
      <div class="col-12 col-sm-12 col-md-8 col-lg-8 col-xl-8 responsive-text-right"> Imponibile</div>
      <div class="col-12 col-sm-12 col-md-4 col-lg-4 col-xl-4 responsive-text-right">{{ $estimate_tax }} %</div>
      <div class="col-12 col-sm-12 col-md-8 col-lg-8 col-xl-8 responsive-text-right"> Imponibile</div>
      <div class="col-12 col-sm-12 col-md-4 col-lg-4 col-xl-4 responsive-text-right">€ <span id="estimate_strprice_taxID">{{ number_format($estimate_price_tax,2,',','.') }}</span></div>
      <div class="col-12 col-sm-12 col-md-8 col-lg-8 col-xl-8 responsive-text-right"> Totale</div>
      <div class="col-12 col-sm-12 col-md-4 col-lg-4 col-xl-4 responsive-text-right">€ <span id="estimate_strtotaltaxedID">{{ number_format($estimate_totaltaxed,2,',','.') }}</span></div>

      <input type="hidden" id="estimate_totalID" value="{{ $estimate_total }}">
      <input type="hidden" id="estimate_taxID" value="{{ $estimate_tax }}">
    </div>


  </div>

</div>