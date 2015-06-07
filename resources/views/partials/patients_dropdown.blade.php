<script>
    $('#patient_change_btn').click(function () {
        if ($('#patients_dropdown').is(':empty')) {
            $.getJSON("{{ url('medic/get_patients') }}", function (data) {
                var options = $("#patients_dropdown");
                $.each(data, function () {
                    options.append("<option value='" + this['id'] + "'>" + this['value'] + "</option>");
                });
            });
        }
        $('#patient_change').modal();
    });
    $('#patient_choose').click(function () {
        var id = $("#patients_dropdown").val();
        $('#patient_id_hidden').val(id);
        var value = $("#patients_dropdown option[value='" + id + "']").text();
        var cnp = value.substring(0, value.indexOf(' '));
        var name = value.substring(value.indexOf(' ') + 1, value.length);
        $('#patient_cnp').html(cnp);
        $('#patient_name').html(name);
        $('#patient_change').modal('hide');
    })
</script>