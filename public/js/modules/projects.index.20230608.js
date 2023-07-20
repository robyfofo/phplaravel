
$(document).ready(function () {
  setDbRowActive();
  openmodal();
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
    var elem = $(this);
    let id = elem.attr('data-id');
    let token = elem.attr('data-token');
    $.ajax({
      url: "ajaxrequest/getprojecttimecards",
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

        var myModal = new bootstrap.Modal(document.getElementById('largeModal'));
        $("#largeModal").find(".modal-body").html(response);
        myModal.show();
      },
      error: function () {
        showJavascriptAlert("Si sono verificati degli errori");
      },
      fail: function () {
        showJavascriptAlert("Ajax failed to fetch data");
      }
    })

  });

};


