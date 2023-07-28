@isset($articles)
<div class="accordion mt-3" id="accordionArticles">
  @foreach($articles as $article)
  <div class="card accordion-item">

    <h2 class="accordion-header" id="headingOne">
      <button type="button" class="accordion-button" data-bs-toggle="collapse" data-bs-target="#accordion{{ $article->id }}" aria-expanded="true" aria-controls="accordion{{ $article->id }}">
        {{ $article->note }}
      </button>
    </h2>

    <div id="accordion{{ $article->id }}" class="accordion-collapse collapse" data-bs-parent="#accordionArticles">

      <div class="card mt-3 mb-4">
        <div class="card-body">

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

          <div class="row">

            <div class="col-12 col-sm-7 col-md-7 col-lg-7 col-xl-8">
              <label class="col-form-label col-form-label-sm" for="art_contentID">Contenuto</label>
              <textarea class="form-control form-control-sm" name="art_content" id="art_contentIT">{{ $article->content }}</textarea>
            </div>

            <div class="col-12 col-sm-5 col-md-5 col-lg-5 col-xl-4">

            </div>

          </div>

        </div>
      </div>
    </div>

  </div>

  @endforeach
</div>
@endisset

<hr>