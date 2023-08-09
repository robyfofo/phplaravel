window.dateins = new tempusDominus.TempusDominus(document.getElementById('dateins'),
  {
    defaultDate: defaultdateins,

    localization: {
      locale: 'it-IT',
      format: 'dd/MM/yyyy',
    },
    display: {

      icons: {
        type: 'icons',
        time: 'far fas-clock',
        date: 'fas fa-calendar',
        up: 'fas fa-arrow-up',
        down: 'fas fa-arrow-down',
        previous: 'fas fa-chevron-left',
        next: 'fas fa-chevron-right',
        today: 'fas fa-calendar-check',
        clear: 'fas fa-trash',
        close: 'fas fa-xmark'
      },


    }
  }
);

window.dateins = new tempusDominus.TempusDominus(document.getElementById('datesca'),
  {
    defaultDate: defaultdatesca,

    localization: {
      locale: 'it-IT',
      format: 'dd/MM/yyyy',
    },
    display: {

      icons: {
        type: 'icons',
        time: 'far fas-clock',
        date: 'fas fa-calendar',
        up: 'fas fa-arrow-up',
        down: 'fas fa-arrow-down',
        previous: 'fas fa-chevron-left',
        next: 'fas fa-chevron-right',
        today: 'fas fa-calendar-check',
        clear: 'fas fa-trash',
        close: 'fas fa-xmark'
      },


    }
  }
);


$(document).ready(function () {
  //getArticleslist();
  deletearticle();
});

function getArticleslist() {

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

      console.log(response);
      $("#articleslistID").html(response);
      deletearticle();

    },
    error: function () {
      showJavascriptAlert("Si sono verificati degli errori");
    },
    fail: function () {
      showJavascriptAlert("Ajax failed to fetch data");
    }
  })

}

// cancella articolo 
function deletearticle() {
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

            // aggiorna il totale
            let art_total = $('#art_total' + id + 'ID').val();

            refreshEstimateValues(art_total);
          

            // cancella il div
            $('#article' + id).remove();

          },
          error: function () {
            showJavascriptAlert("Si sono verificati degli errori");
          },
          fail: function () {
            showJavascriptAlert("Ajax failed to fetch data");
          }
        })

      }
    });
  });

}

$('.articles .form-control').on('change', function (event) {
  
  let token = $("input[name=_token]").val();
  let elem = $(this);
  let id = elem.prop('id').replace(/[^0-9]/gi, '');
  id = parseInt(id);
  //console.log('aggiorno articolo '+id);

  elem.before('<div id="waitingeditartID" class="spinner-border spinner-border-sm text-secondary" role="status"><span class="visually-hidden">Loading...</span></div>');

  note = $('#art_note'+id+'ID').val();
  content = $('#art_content'+id+'ID').val();
  price_unity = $('#art_price_unity'+id+'ID').val();
  quantity = $('#art_quantity'+id+'ID').val();

  /*
  console.log(note);
  console.log(content);
  console.log(quantity);
  console.log(price_unity);
  */

  $.ajax({
    url: "/estimates/ajaxeditarticle",
    method: "PUT",
    async: false,
    cache: false,
    global: false,
    dataType: 'json',
    data: {
      'id': id,
      '_token': token,

      'note': note,
      'content': content,
      'quantity': quantity,
      'price_unity': price_unity
    },
    success: function (res) {
      
      art_tax = 10;
      // valori correnti
      art_price_total = parseFloat(res.data.art_price_total);
      art_price_tax = parseFloat((art_price_total * art_tax)/100);
      art_total = parseFloat(art_price_total + art_price_tax);
      
      console.log('art_price_tax '+art_price_tax);

      // vecchi valori
      old_art_price_total = parseFloat(res.data.old_art_price_total);
      old_art_price_tax = parseFloat((old_art_price_total * art_tax)/100);
      old_art_total = parseFloat(old_art_price_total + old_art_price_tax);

      // refresh output
      $('#art_strprice_total'+id+'ID').html($.number(art_price_total, 2, ','));
      $('#art_strprice_tax'+id+'ID').html($.number(art_price_tax, 2, ','));
      $('#art_strtotal'+id+'ID').html($.number(art_total, 2, ','));

      // ricalcola totale estimate

      foo = parseFloat(art_total - old_art_total);
      console.log('diff totali '+foo);
      let estimate_total = parseFloat($('#estimate_totalID').val());
      console.log('estimate_total ' + estimate_total);
      
      if (foo > 0) {
        console.log('aumento');
        estimate_total = parseFloat(estimate_total + foo);
      }
      
      if (foo < 0) {
        console.log('diminuisco');
        estimate_total = parseFloat(estimate_total + foo);    
      }

      console.log('new estimate total '+estimate_total);

      refreshEstimateTotals(estimate_total);

      $('#waitingeditartID').remove();

    },
    error: function () {
      showJavascriptAlert("Si sono verificati degli errori");
    },
    fail: function () {
      showJavascriptAlert("Ajax failed to fetch data");
    }
  })

}); // end function
