<div class="row">
  <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
    @php $accordion = 1; @endphp
    <div class="accordion mt-3" id="accordionArticles">

      <!-- lista articoli database -->
      @isset($articles)
      @foreach($articles as $article)

      <div class="card accordion-item articles" id="article{{ $accordion }}" data-id="{{ $article->id }}">

        <div class="accordion-header" id="heading{{ $accordion }}">
          <div class="row roby">
            <div class="col-md-11" id="articleheader{{ $accordion }}">
              <div class="row articleheader ps-2">

                <div class="col-12 col-sm-7 col-md-7 col-lg-8 col-xl-9">
                  <label>Note</label><br>
                  {{ $article->note }}
                </div>

                <div class="col-3 col-sm-2 col-md-2 col-lg-2 col-xl-1">
                  <label>Q.tà</label><br>
                  {{ $article->quantity }}
                </div>

                <div class="col-4 col-sm-3 col-md-3 col-lg-2 col-xl-2 text-end">
                  <label>Prezzo</label><br>
                  {{ number_format($article->price_unity,2,',','.') }}
                </div>


              </div>
            </div>
            <div class="col-md-1 text-end">
              <button id="accordionbutton{{ $accordion }}" type="button" class="accordion-button collapsed" data-bs-toggle="collapse" data-bs-target="#accordion{{ $accordion }}" aria-expanded="true" aria-controls="accordion{{ $accordion }}"></button>
            </div>
          </div>
        </div>

        <div id="accordion{{ $accordion }}" class="accordion-collapse collapse pb-3 px-3" data-bs-parent="#accordionArticles">

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
                <div class="col-12 col-sm-12 col-md-4 col-lg-4 col-xl-4 responsive-text-right">{{ Config::get('settings.estimate_article_tax') }} %</div>
                <div class="col-12 col-sm-12 col-md-8 col-lg-8 col-xl-8 responsive-text-right"> Imponibile</div>
                <div class="col-12 col-sm-12 col-md-4 col-lg-4 col-xl-4 responsive-text-right">€ <span id="art_strprice_tax{{ $article->id }}ID">{{ number_format($article->price_tax,2,',','.') }}</span></div>
                <div class="col-12 col-sm-12 col-md-8 col-lg-8 col-xl-8 responsive-text-right"> Totale</div>
                <div class="col-12 col-sm-12 col-md-4 col-lg-4 col-xl-4 responsive-text-right">€ <span id="art_strtotal{{ $article->id }}ID">{{ number_format($article->total,2,',','.') }}</span></div>

                <input type="text" id="art_total{{ $article->id }}ID" value="{{ $article->total }}">


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

      @php $accordion++; @endphp

      @endforeach
      @endisset
      <!-- lista articoli database -->

      <!-- lista articoli sessione -->
      @php
      $foo = request()->session()->get('estimates articles');
      @endphp
      @isset($foo)
      @foreach($foo as $article)

      <div class="card accordion-item sessarticles" id="article{{ $accordion }}" data-id="{{ $article['id'] }}">

        <div class="accordion-header" id="heading{{ $accordion }}">
          <div class="row">
            <div class="col-md-11" id="articleheader{{ $accordion }}">
              <div class="row articleheader ps-2">
              <div class="col-12 col-sm-7 col-md-7 col-lg-8 col-xl-9 ">
                  <label>Note</label><br>
                  {{ $article['note'] }}
                </div>

                <div class="col-3 col-sm-2 col-md-2 col-lg-2 col-xl-1">
                  <label>Q.tà</label><br>
                  {{ $article['quantity'] }}
                </div>

                <div class="col-4 col-sm-3 col-md-3 col-lg-2 col-xl-2 text-end">
                  <label>Prezzo</label><br>
                  {{ number_format($article['price_unity'],2,',','.') }}
                </div>
              </div>
            </div>
            <div class="col-md-1 text-end">
              <button id="accordionbutton{{ $accordion }}" type="button" class="accordion-button collapsed" data-bs-toggle="collapse" data-bs-target="#accordion{{ $accordion }}" aria-expanded="true" aria-controls="accordion{{ $article['id'] }}"></button>
            </div>
          </div>
        </div>

         

        <div id="accordion{{ $accordion }}" class="accordion-collapse collapse pb-3 px-3" data-bs-parent="#accordionArticles">

          <div class="row">

            <div class="col-12 col-sm-7 col-md-7 col-lg-8 col-xl-9">
              <label class="col-form-label col-form-label-sm" for="sessart_note{{ $article['id'] }}ID">Note</label>
              <input class="form-control form-control-sm" name="sessart_note[{{ $article['id'] }}]" id="sessart_note{{ $article['id'] }}ID" value="{{ $article['note'] }}">
            </div>

            <div class="col-3 col-sm-2 col-md-2 col-lg-2 col-xl-1">
              <label class="col-form-label col-form-label-sm" for="sessart_quantity{{ $article['id'] }}ID">Q.tà</label>
              <input class="form-control form-control-sm" name="sessart_quantity[{{ $article['id'] }}]" id="sessart_quantity{{ $article['id'] }}ID" value="{{ $article['quantity'] }}">
            </div>

            <div class="col-4 col-sm-3 col-md-3 col-lg-2 col-xl-2">
              <label class="col-form-label col-form-label-sm" for="sesssart_price_unity{{ $article['id'] }}ID">Prezzo</label>
              <input class="form-control form-control-sm text-end" name="sessart_price_unity{{ $article['id'] }}" id="sessart_price_unity{{ $article['id'] }}ID" value="{{ $article['price_unity'] }}">
            </div>


          </div>

          <div class="row py-3">

            <div class="col-12 col-sm-7 col-md-7 col-lg-7 col-xl-8">
              <label class="col-form-label col-form-label-sm" for="sessart_content{{ $article['id'] }}ID">Contenuto</label>
              <textarea rows="5" class="form-control form-control-sm" name="sessart_content[{{ $article['id'] }}]" id="sessart_content{{ $article['id'] }}ID">{{ $article['content'] }}</textarea>
            </div>

            <div class="col-12 col-sm-5 col-md-5 col-lg-5 col-xl-4">
              <div class="row">
                <div class="col-12 col-sm-12 col-md-8 col-lg-8 col-xl-8 responsive-text-right"> Totale articolo</div>
                <div class="col-12 col-sm-12 col-md-4 col-lg-4 col-xl-4 responsive-text-right">€ <span id="sessart_strprice_total{{ $article['id'] }}ID">{{ number_format($article['price_total'],2,',','.') }}</span></div>
                <div class="col-12 col-sm-12 col-md-8 col-lg-8 col-xl-8 responsive-text-right"> Imponibile</div>
                <div class="col-12 col-sm-12 col-md-4 col-lg-4 col-xl-4 responsive-text-right">{{ $article['tax'] }} %</div>
                <div class="col-12 col-sm-12 col-md-8 col-lg-8 col-xl-8 responsive-text-right"> Imponibile</div>
                <div class="col-12 col-sm-12 col-md-4 col-lg-4 col-xl-4 responsive-text-right">€ <span id="sessart_strprice_tax{{ $article['id'] }}ID">{{ number_format($article['price_tax'],2,',','.') }}</span></div>
                <div class="col-12 col-sm-12 col-md-8 col-lg-8 col-xl-8 responsive-text-right"> Totale</div>
                <div class="col-12 col-sm-12 col-md-4 col-lg-4 col-xl-4 responsive-text-right">€ <span id="sessart_strtotal{{ $article['id'] }}ID">{{ number_format($article['total'],2,',','.') }}</span></div>

                <input type="hidden" id="sessart_total{{ $article['id'] }}ID" value="{{ $article['total'] }}">


              </div>
            </div>


            <div class="row">
              <div class="col text-end">
                <a href="javascript:void(0);" data-id="{{ $article['id'] }}" class="deletesessarticle" title="Cancella questo articolo"><i class="bx bx-md bx-trash"></i></a>
              </div>
            </div>

          </div>


        </div>

      </div>

      @php $accordion++; @endphp

      @endforeach
      @endisset
      <!-- lista articoli sessione -->

    </div>


    <input type="hidden" id="articles_totalID" name="articles_total" value="{{ $articles_total }}">



    <!-- modumo inserimento -->

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
            <input class="form-control form-control-sm text-end" name="art_price_unity" id="art_price_unityID" value="0">
          </div>

        </div>

        <div class="row py-3">

          <div class="col-12 col-sm-7 col-md-7 col-lg-7 col-xl-7">
            <label class="col-form-label col-form-label-sm" for="art_contentID">Contenuto</label>
            <textarea rows="5" class="form-control form-control-sm" name="art_content" id="art_contentID"></textarea>
          </div>

          <div class="col-12 col-sm-5 col-md-5 col-lg-5 col-xl-5">
            <div class="row">
              <div class="col-6 col-sm-6 col-md-8 col-lg-8 col-xl-8 responsive-text-right"> Totale articolo</div>
              <div class="col-6 col-sm-6 col-md-4 col-lg-4 col-xl-4 responsive-text-right">€ <span id="art_strprice_totalID">0,00</span></div>
              <div class="col-12 col-sm-12 col-md-8 col-lg-8 col-xl-8 responsive-text-right"> Imponibile</div>
              <div class="col-12 col-sm-12 col-md-4 col-lg-4 col-xl-4 responsive-text-right"><span id="art_strtaxID">0</span> %</div>
              <div class="col-12 col-sm-12 col-md-8 col-lg-8 col-xl-8 responsive-text-right"> Imponibile</div>
              <div class="col-12 col-sm-12 col-md-4 col-lg-4 col-xl-4 responsive-text-right">€ <span id="art_strprice_taxID">0,00</span></div>
              <div class="col-12 col-sm-12 col-md-8 col-lg-8 col-xl-8 responsive-text-right"> Totale</div>
              <div class="col-12 col-sm-12 col-md-4 col-lg-4 col-xl-4 responsive-text-right">€ <span id="art_strtotalID">0,00</span></div>
            </div>
          </div>

        </div>

        <input type="hidden" id="art_taxID" value="10">
        <input type="hidden" id="art_totalID" value="0">
        <div class="row">
          <div class="col text-end">
            <a href="javascript:void(0);" class="btn btn-primary insertsessarticle" title="Aggiungi questo articolo">Aggiungi articolo</a>
          </div>
        </div>

      </div>
    </div>


    <!-- modumo inserimento -->

  </div>

</div>