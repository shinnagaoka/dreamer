(function() {
    'use strict';

    if (!$.fn.fullCalendar) return;

    $(initCalendar);

    $('#external-events .external-event').each(function() {
        var $this = $(this);
        // store data so the calendar knows to render an event upon drop
        $this.data('event', {
            title: $.trim($this.text()),
            stick: true
        });

        // create draggable using jQuery UI
        $this.draggable({
            zIndex: 999999,
            revert: true,
            revertDuration: 0
        });

    });

    function initCalendar() {

        var date = new Date();
        var d = date.getDate();
        var m = date.getMonth();
        var y = date.getFullYear();
        var removeAfterDropEvents = true;

        $('#calendar').fullCalendar({
            header: {
                left: 'prev,next today',
                center: 'title',
                right: 'month,agendaWeek,agendaDay'
            },
            editable: true,
            droppable: true,
            drop: function() {
                // if removeAfterDropEvents, remove the element from the "Draggable Events" list
                if (removeAfterDropEvents) {
                    $(this).remove();
                }
                // when done with events, show text
                if ( $('#external-events .external-event').length === 0) {
                    $('#external-events').html('<span>No more events today..</span>');
                }
            },
            events: [{
                title: 'All Day Event',
                start: new Date(y, m, 1)
            }, {
                title: 'Long Event',
                start: new Date(y, m, d - 5),
                end: new Date(y, m, d - 2)
            }, {
                id: 999,
                title: 'Repeating Event',
                start: new Date(y, m, d - 3, 16, 0),
                allDay: false
            }, {
                id: 999,
                title: 'Repeating Event',
                start: new Date(y, m, d + 4, 16, 0),
                allDay: false
            }, {
                title: 'Meeting',
                start: new Date(y, m, d, 10, 30),
                allDay: false
            }, {
                title: 'Lunch',
                start: new Date(y, m, d, 12, 0),
                end: new Date(y, m, d, 14, 0),
                allDay: false
            }, {
                title: 'Birthday Party',
                start: new Date(y, m, d + 1, 19, 0),
                end: new Date(y, m, d + 1, 22, 30),
                allDay: false
            }, {
                title: 'Click for Google',
                start: new Date(y, m, 28),
                end: new Date(y, m, 29),
                url: 'http://google.com/'
            }]
        });
    }

})();