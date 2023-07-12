

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

new tempusDominus.TempusDominus(document.getElementById('newtimecarddata'),
  {
    defaultDate: defaultnewtimecarddata,

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

new tempusDominus.TempusDominus(document.getElementById('newtimecardstarttime'),
  {
    defaultDate: defaultnewtimecardstartitme,

    localization: {
      locale: 'it-IT',
      format: 'LT',
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