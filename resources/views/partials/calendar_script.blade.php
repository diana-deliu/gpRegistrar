<script>
    function buildListElement(month, day, type, addText) {
        var text = "";
        if (type == "lab") {
            text = "Analize";
        }
        if (type == "vaccine") {
            text = "Vaccinare";
        }
        if (type == "consult") {
            text = "Consultaţie";
        }
        return '<li class="list-group-item day-event" date-month="' + month + '" date-day="' + day + '" date-type="' + type + '">' + text + ' ' + '<br/>' + addText + '</li>';
    }

    function appendElement(element) {
        $("#events").append(element);
    }

    var openedCalendar = false;
    $("#open_calendar").click(function (event) {
        if(openedCalendar) {
            return;
        }
        var url = "<?php
        if (Auth::user() && Auth::user()->role == 'patient') {
            echo url('patient/calendar');
        }
        else if (Auth::user() && Auth::user()->role == 'medic') {
            echo url('medic/calendar');
        }
        ?>";
        $.getJSON(url, function (data) {
            $.each(data["consults"], function (key, val) {
                var addText = "";
                if (val.patient != null) {
                    addText = val.patient.firstname + " " + val.patient.lastname;
                }
                var day = parseInt(val.next_date.substring(0, 2));
                var month = parseInt(val.next_date.substring(3, 5));
                appendElement(buildListElement(month, day, "consult", addText));
            });
            $.each(data["labs"], function (key, val) {
                var addText = "";
                if (val.patient) {
                    addText = val.patient.firstname + " " + val.patient.lastname;
                }
                var day = parseInt(val.next_date.substring(0, 2));
                var month = parseInt(val.next_date.substring(3, 5));
                appendElement(buildListElement(month, day, "lab", addText));
            });
            $.each(data["vaccines"], function (key, val) {
                var addText = "";
                if (val.patient) {
                    addText = val.patient.firstname + " " + val.patient.lastname;
                }
                var day = parseInt(val.next_date.substring(0, 2));
                var month = parseInt(val.next_date.substring(3, 5));
                appendElement(buildListElement(month, day, "vaccine", addText));
            });
            calendar.init();
        });
        openedCalendar = true;
    });

    $(".dropdown-menu").click(function (event) {
        event.stopPropagation();
    });
</script>