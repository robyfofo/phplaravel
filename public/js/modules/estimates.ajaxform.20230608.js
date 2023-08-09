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
      referssessarticlevalues();
      insertsessarticle();
      //deletearticle();

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

function referssessarticlevalues()
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

function refreshEstimateValues()
{
  //estimate_articles_total = parseFloat($('#articles_totalID').val()) | 0.00;
  estimate_articles_total = $('#articles_totalID').val();

  estimate_articles_total = parseFloat(estimate_articles_total);
  
  console.log('estimate_articles_total ' + estimate_articles_total);
  
  estimate_tax = parseFloat($('#estimate_taxID').val()) || 0;
  console.log('estimate_tax ' + estimate_tax);

  estimate_price_tax = parseFloat((estimate_articles_total * estimate_tax) / 100);
  console.log('estimate_price_tax ' + estimate_price_tax);

  estimate_total = parseFloat(estimate_articles_total + estimate_price_tax).toFixed(2);
  console.log('estimate_total ' + estimate_total);
  
  $('#estimate_strarticles_totalID').html($.number(estimate_articles_total, 2, ','));
  $('#estimate_strprice_taxID').html($.number(estimate_price_tax, 2, ','));
  $('#estimate_strtotalID').html($.number(estimate_total, 2, ','));

}