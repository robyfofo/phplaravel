
$(document).ready(function() {

  new tempusDominus.TempusDominus(document.getElementById('datatimecard'),
    {
      defaultDate: defaultdatatimecard,

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

  new tempusDominus.TempusDominus(document.getElementById('starttime'),
    {
      defaultDate: defaultstarttime,

      localization: {
        locale: 'it-IT',
        format: 'HH:mm',
      },
      display: {
        viewMode: 'clock',
        components: {
          decades: false,
          year: false,
          month: false,
          date: false,
          hours: true,
          minutes: true,
          seconds: false
        },

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

  new tempusDominus.TempusDominus(document.getElementById('endtime'),
    {
      defaultDate: defaultendtime,

      localization: {
        locale: 'it-IT',
        format: 'HH:mm',
      },
      display: {
        viewMode: 'clock',
        components: {
          decades: false,
          year: false,
          month: false,
          date: false,
          hours: true,
          minutes: true,
          seconds: false
        },

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


  /*
  $('#newForm').on('submit', function (e) {

    let result = false;

    let project_id = $('#project_idID').val();   	
    let id = $('#idID').val();   


    //let parsedDate = dateins.dates.formatInput = function(date) {  { console.log("d1: ", date); return moment(date).format('YYYY/MM/DD')  }  }
    let parsedDate = dateins.dates.parseInput();
    //const parsedDate = dateins.dates.parseInput(new Date());


    //dateins.formatInput = function(date) {  { console.log("d1: ", date); return moment(date).format('DD/MM/YYYY hh:mm')  }  }

    //const dateins = new tempusDominus.TempusDominus(document.getElementById('dateins'));

    //const starttime = new tempusDominus.TempusDominus(document.getElementById('starttime'));
    //const endtime = new tempusDominus.TempusDominus(document.getElementById('endtime'));
   
   console.log(parsedDate);
   //console.log(starttime);
   //console.log(starttime);
  
    return false;
  
  });
  */

});