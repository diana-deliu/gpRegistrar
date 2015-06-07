<script type="text/javascript">
    $(function () {
        var value = $('#datetimepicker11 input').val();
        if (value) {
            $('#datetimepicker11').datetimepicker({
                daysOfWeekDisabled: [0, 6],
                date: value,
                locale:'ro'
            });
        }
        else {
            $('#datetimepicker11').datetimepicker({
                daysOfWeekDisabled: [0, 6],
                locale:'ro'
            });
        }

    });
</script>