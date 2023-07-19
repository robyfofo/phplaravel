
$(document).ready(function () {
  setDbRowActive();
  //openmodal();
});


function setDbRowActive() {
  $('.setactive').bind("click", function () {

    var elem = $(this);
    let id = elem.attr('data-id');
    let table = elem.attr('data-table');
    let label = elem.attr('data-label');
    let labelsex = elem.attr('data-labelsex');
    let token = elem.attr('data-token');
    $.ajax({
      url: "ajaxrequests/setdbrowactive",
      method: "POST",
      async: false,
      cache: false,
      global: false,
      data: {
        'id': id,
        'table': table,
        'label': label,
        'labelsex': labelsex,
        '_token': token
      },
      success: function (response) {

        data = $.parseJSON(response);
        elem.find("i").removeClass("bx bx-lock-alt");
        elem.find("i").removeClass("bx bx-lock-open-alt");
        elem.find("i").removeClass("text-success");
        elem.find("i").removeClass("text-danger");

        $("#active" + id + "ID").html(data.value);
        //prependMessageBar('#messagesContainerID',data.error,data.message);  
        elem.find("i").addClass(data.icon);
        //if (data.title != '') elem.prop('title', data.title);
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


function openmodal() {

  $('.openmodal').bind("click", function () {

    console.log('open');

    openmodal
    /*
    $("#largeModal").on("show.bs.modal", function (e) {





      let output = 'aaaaaaaaaaaaaaaaaa';
      $("#largeModal").on("show.bs.modal", function (e) {
        $(this).find(".modal-body").html(output);
      });
      
      
    });
    */

  });

};