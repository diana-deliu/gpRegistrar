<script>
    window.NotyManager = new $.NotyManager($('#notifications'), {
        bubble: {
            top: 10,
            left: -2,
            showZero: true
        },
        max: 30,
        container: $('#notification-list'),
        wrapper: '<div/>',
        emptyHTML: '<div class="no-notification">Nu exista notificari</div>',
        callback: {
            onOpen: function () {
            },
            onClose: function () {
            }
        },
        useNoty: true,
        noty: {
            layout: 'bottomLeft',
            timeout: false,
            closeWith: ['button']
        }
    });
    var notifications = <?php if(isset($notifications)) echo json_encode($notifications) ?>;
    var consultImageUrl = "{{ asset('images/consult_orange_30.png') }}";
    var labImageUrl = "{{ asset('images/lab_green_30.png') }}";
    var vaccineImageUrl = "{{ asset('images/vaccine_red_30.png') }}";
    var surveyImageUrl = "{{ asset('images/survey_green_30.png') }}";
    $.each(notifications, function (key, value) {
        var notif;
        switch (value.type) {
            case "consult":
                notif = '<div class="activity-item"> <img src="' + consultImageUrl + '"/> <div class="activity"> ' + value.text + ' </div> </div>';
                break;
            case "lab":
                notif = '<div class="activity-item"> <img src="' + labImageUrl + '"/> <div class="activity"> ' + value.text + ' </div> </div>';
                break;
            case "vaccine":
                notif = '<div class="activity-item"> <img src="' + vaccineImageUrl + '"/> <div class="activity"> ' + value.text + ' </div> </div>';
                break;
            case "survey":
                notif = '<div class="activity-item"> <img src="' + surveyImageUrl + '"/> <div class="activity"> ' + value.text + ' </div> </div>';
                break;
        }
        NotyManager.alert(notif);
    });
</script>