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

      console.log(response);
      $("#articleslistID").html(response);
     
    },
    error: function () {
      showJavascriptAlert("Si sono verificati degli errori");
    },
    fail: function () {
      showJavascriptAlert("Ajax failed to fetch data");
    }
  })

}
