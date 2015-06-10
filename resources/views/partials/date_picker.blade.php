<script type="text/javascript">
    $(function () {
        $(".datetimepicker").each(function(elem) {
           var value = $(this).find("input").val();
            if(value.trim().length > 0) {
                if(value.indexOf("-") >= 0) {
                    $(this).datetimepicker({
                        daysOfWeekDisabled: [0, 6],
                        date: value,
                        locale:'ro'
                    });
                }
                else {
                    value = moment(value, "DD.MM.YYYY HH:mm").toDate();
                    $(this).datetimepicker({
                        daysOfWeekDisabled: [0, 6],
                        date: value,
                        locale:'ro'
                    });
                }

            } else {
               $(this).datetimepicker({
                   daysOfWeekDisabled: [0, 6],
                   locale:'ro'
               });
            }
        });
    });
</script>