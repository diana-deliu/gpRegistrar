<script type="text/javascript">
    $(function () {
        $(".datetimepicker").each(function(elem) {
           var value = $(this).find("input").val();
            if(value.trim().length > 0) {
                $(this).datetimepicker({
                    daysOfWeekDisabled: [0, 6],
                    date: value,
                    locale:'ro'
                });
            } else {
               $(this).datetimepicker({
                   daysOfWeekDisabled: [0, 6],
                   locale:'ro'
               });
            }
        });
    });
</script>