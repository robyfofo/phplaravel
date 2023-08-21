$(document).ready(function () {
  getArticleslist();
});

function getArticleslist() 
{

  let id = $('#estimate_idID').val();
  let token = $("input[name=_token]").val();
  console.log(id);

  $.ajax({
    url: "/estimates/ajaxgetarticleslist",
    method: "PUT",
    async: false,
    cache: false,
    global: false,
    data: {
      'id': id,
      '_token': token
    },
    success: function (response) {
      //console.log(response);
      $("#articleslistID").html(response);
      refresharticlevalues();
      insertsessarticle();
      deletesessarticle();
      editsessarticle();

      deletearticle();
      editarticle();

      refreshEstimateValues();

      accordionevents();

    },
    error: function () {
      showJavascriptAlert("Si sono verificati degli errori");
    },
    fail: function () {
      showJavascriptAlert("Ajax failed to fetch data");
    }
  })

}

// inserisci articolo in sessione
function insertsessarticle()
{
  $('.insertsessarticle').bind("click", function () {
    var elem = $(this);
    let token = $("input[name=_token]").val();
    console.log('token ' + token);

    note = $('#art_noteID').val();
    content = $('#art_contentID').val();
    price_unity = $('#art_price_unityID').val();
    quantity = $('#art_quantityID').val();
  
    /*
    console.log(note);
    console.log(content);
    console.log(quantity);
    console.log(price_unity);
    */

    $.ajax({
      url: "/estimates/ajaxinsertsessarticle",
      method: "PUT",
      async: false,
      cache: false,
      global: false,
      dataType: 'json',
      data: {
        '_token': token,
  
        'note': note,
        'content': content,
        'quantity': quantity,
        'price_unity': price_unity
      },
      success: function (res) {
      
        getArticleslist();
      },
      error: function () {
        showJavascriptAlert("Si sono verificati degli errori");
      },
      fail: function () {
        showJavascriptAlert("Ajax failed to fetch data");
      }
    })
    
  


  

  })
}

function refresharticlevalues()
{

  $('#art_price_unityID').on('change', function (event) {
    price_unity = parseFloat($('#art_price_unityID').val()) || 0.00;
    quantity = parseInt($('#art_quantityID').val()) || 1;
    calcolatesessarticletotals(price_unity, quantity);
  });
  
  $('#art_quantityID').on('change', function (event) {
    price_unity = parseFloat($('#art_price_unityID').val()) || 0.00;
    quantity = parseInt($('#art_quantityID').val()) || 1;
    calcolatesessarticletotals(price_unity, quantity);
  });
  
}

function calcolatesessarticletotals(price_unity, quantity) {
  //console.log('price_unity '+price_unity);
  //console.log('quantity '+quantity);
  
  price_total = parseFloat(price_unity * quantity) || 0.00;
  //console.log('price_total '+price_total);

  art_tax = parseFloat($('#art_taxID').val()) || 0;
  //console.log('art_tax '+art_tax);

  price_tax = (price_total * art_tax) / 100;	
  //console.log('price_tax '+price_tax);

  total = price_total + price_tax;
  //console.log('total '+total);

  // prende il vecchio totale articolo
  old_total = parseFloat($('#art_totalID').val()) | 0.00;
  //console.log('old_total '+old_total);

  diff_total = total - old_total;
  //console.log('diff_total '+diff_total);
  
  $('#art_strprice_totalID').html($.number(price_total, 2, ','));
  $('#art_strtaxID').html(art_tax);
  $('#art_strprice_taxID').html($.number(price_tax, 2, ','));
  $('#art_strtotalID').html($.number(total, 2, ','));
  $('#art_totalID').val(total.toFixed(2));



  // ricalcole il totale articoli
  articles_total = parseFloat($('#articles_totalID').val()) | 0.00;
  foo_articles_total = articles_total + diff_total;
 // console.log('estimate_articles_total '+estimate_articles_total);

  $('#articles_totalID').val(foo_articles_total.toFixed(2));
  //$('#estimate_articles_totalID').val(estimate_articles_total.toFixed(2));
  refreshEstimateValues();
  
}

// aggiorna i totali preventivo
function refreshEstimateValues()
{
  //estimate_articles_total = parseFloat($('#articles_totalID').val()) | 0.00;
  estimate_articles_total = $('#articles_totalID').val();
  estimate_articles_total = parseFloat(estimate_articles_total);
  //console.log('estimate_articles_total ' + estimate_articles_total);
  estimate_tax = parseFloat($('#estimate_taxID').val()) || 0;
  //console.log('estimate_tax ' + estimate_tax);
  estimate_price_tax = parseFloat((estimate_articles_total * estimate_tax) / 100);
  //console.log('estimate_price_tax ' + estimate_price_tax);
  estimate_total = parseFloat(estimate_articles_total + estimate_price_tax).toFixed(2);
  //console.log('estimate_total ' + estimate_total);
  $('#estimate_strarticles_totalID').html($.number(estimate_articles_total, 2, ','));
  $('#estimate_strprice_taxID').html($.number(estimate_price_tax, 2, ','));
  $('#estimate_strtotalID').html($.number(estimate_total, 2, ','));

}

// cancella articolo in sessione
function deletesessarticle()
{
  $('.deletesessarticle').bind("click", function () {
    var elem = $(this);
    let token = $("input[name=_token]").val();
    //console.log('token ' + token);
    let id = elem.attr('data-id');
    //console.log('aggiorno articolo '+id);

    bootbox.confirm('Sei sicuro?', function (confirmed) {
      if (confirmed) {
       
        $.ajax({
          url: "/estimates/ajaxdeletesessarticle",
          method: "PUT",
          async: false,
          cache: false,
          global: false,
          data: {
            'id': id,
            '_token': token
          },
          success: function (response) {
            getArticleslist();
          },
          error: function () {
            showJavascriptAlert("Si sono verificati degli errori");
          },
          fail: function () {
            showJavascriptAlert("Ajax failed to fetch data");
          }
        })

      }
    })



  });

}

// modifica articolo in sessione
function editsessarticle()
{
  $('.sessarticles .form-control').on('change', function (event) {
    
    let token = $("input[name=_token]").val();
    let elem = $(this);

    let id = elem.prop('id').replace(/[^0-9]/gi, '');
    id = parseInt(id);
    //console.log('aggiorno articolo '+id);

    elem.before('<div id="waitingeditartID" class="spinner-border spinner-border-sm text-secondary" role="status"><span class="visually-hidden">Loading...</span></div>');

    note = $('#sessart_note'+id+'ID').val();
    content = $('#sessart_content'+id+'ID').val();
    price_unity = $('#sessart_price_unity'+id+'ID').val();
    quantity = $('#sessart_quantity'+id+'ID').val();
    
    $.ajax({
      url: "/estimates/ajaxeditsessarticle",
      method: "PUT",
      async: false,
      cache: false,
      global: false,
      dataType: 'json',
      data: {
        '_token': token,
        'id': id,
        'note': note,
        'content': content,
        'quantity': quantity,
        'price_unity': price_unity
      },
      success: function (res) {

        //console.log(res);
        price_total = res.data.price_total;
        tax = res.data.tax;
        price_tax = res.data.price_tax;
        total = res.data.total;

        console.log('price_total '+price_total);
        console.log('price_tax '+price_tax);
        console.log('price_total '+total);

        // prende il vecchio totale articolo
        old_total = parseFloat($('#sessart_total'+id+'ID').val()) | 0.00;
        console.log('old_total '+old_total);

        diff_total = total - old_total;
        console.log('diff_total '+diff_total);

        $('#sessart_strprice_total'+id+'ID').html($.number(price_total, 2, ','));
        $('#sessart_strtax'+id+'ID').html(tax);
        $('#sessart_strprice_tax'+id+'ID').html($.number(price_tax, 2, ','));
        $('#sessart_strtotal'+id+'ID').html($.number(total, 2, ','));
        $('#sessart_total'+id+'ID').val(total.toFixed(2));

        // ricalcole il totale articoli
        articles_total = parseFloat($('#articles_totalID').val()) | 0.00;
        foo_articles_total = articles_total + diff_total;

        $('#articles_totalID').val(foo_articles_total.toFixed(2));
        //$('#estimate_articles_totalID').val(estimate_articles_total.toFixed(2));
        refreshEstimateValues();

        $('#waitingeditartID').remove();
        //getArticleslist();
      },
      error: function () {
        showJavascriptAlert("Si sono verificati degli errori");
      },
      fail: function () {
        showJavascriptAlert("Ajax failed to fetch data");
      }
    })
    


  });
}

// cancella articolo in database
function deletearticle() 
{
  $('.deletearticle').bind("click", function () {

    var elem = $(this);
    let id = elem.attr('data-id');
    let token = $("input[name=_token]").val();

    bootbox.confirm('Sei sicuro?', function (confirmed) {

      if (confirmed) {
        
        // cancello da database
        $.ajax({
          url: "/estimates/ajaxdeletearticle",
          method: "PUT",
          async: false,
          cache: false,
          global: false,
          data: {
            'id': id,
            '_token': token
          },
          success: function (response) {
            getArticleslist();
          },
          error: function () {
            showJavascriptAlert("Si sono verificati degli errori");
          },
          fail: function () {
            showJavascriptAlert("Ajax failed to fetch data");
          }
        });

      }

    });

  });

}

// modifica articolo in sessione
function editarticle()
{
  $('.articles .form-control').on('change', function (event) {
    
    let token = $("input[name=_token]").val();
    let elem = $(this);

    let id = elem.prop('id').replace(/[^0-9]/gi, '');

    id = parseInt(id);
    console.log('aggiorno articolo '+id);

    elem.before('<div id="waitingeditartID" class="spinner-border spinner-border-sm text-secondary" role="status"><span class="visually-hidden">Loading...</span></div>');

    note = $('#art_note'+id+'ID').val();
    content = $('#art_content'+id+'ID').val();
    price_unity = $('#art_price_unity'+id+'ID').val();
    quantity = $('#art_quantity'+id+'ID').val();
    
    $.ajax({
      url: "/estimates/ajaxeditarticle",
      method: "PUT",
      async: false,
      cache: false,
      global: false,
      dataType: 'json',
      data: {
        '_token': token,
        'id': id,
        'note': note,
        'content': content,
        'quantity': quantity,
        'price_unity': price_unity
      },
      success: function (res) {

        //console.log(res);
        price_total = res.data.price_total;
        tax = res.data.tax;
        price_tax = res.data.price_tax;
        total = res.data.total;

        //console.log('price_total '+price_total);
        //console.log('price_tax '+price_tax);
        //console.log('price_total '+total);

        // prende il vecchio totale articolo
        old_total = parseFloat($('#art_total'+id+'ID').val()) | 0.00;
        //console.log('old_total '+old_total);

        diff_total = total - old_total;
        //console.log('diff_total '+diff_total);

        $('#art_strprice_total'+id+'ID').html($.number(price_total, 2, ','));
        $('#art_strtax'+id+'ID').html(tax);
        $('#art_strprice_tax'+id+'ID').html($.number(price_tax, 2, ','));
        $('#art_strtotal'+id+'ID').html($.number(total, 2, ','));
        $('#art_total'+id+'ID').val(total.toFixed(2));

        // ricalcole il totale articoli
        articles_total = parseFloat($('#articles_totalID').val()) | 0.00;
        foo_articles_total = articles_total + diff_total;

        $('#articles_totalID').val(foo_articles_total.toFixed(2));
        //$('#estimate_articles_totalID').val(estimate_articles_total.toFixed(2));
        refreshEstimateValues();

        $('#waitingeditartID').remove();
        //getArticleslist();
      },
      error: function () {
        showJavascriptAlert("Si sono verificati degli errori");
      },
      fail: function () {
        showJavascriptAlert("Ajax failed to fetch data");
      }
    })
    


  });
}

function accordionevents() 
{

  $('.accordion-button').bind("click", function () {

    $('.articleheader').show();

    let elem = $(this);
    let id = elem.prop('id').replace(/[^0-9]/gi, '');
    id = parseInt(id);

    let cl = elem.prop('class');
    
    console.log(cl);

    e = '#articleheader'+id+' .articleheader';
    if (cl == 'accordion-button collapsed') {
      $(e).show();
    } else {
      $(e).hide();
    }
    
  });

}
  
