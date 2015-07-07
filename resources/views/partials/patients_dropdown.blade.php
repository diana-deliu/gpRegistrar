<script>
    function loadPatientsDropdown(doFillId) {
        if ($('#patients_dropdown').is(':empty')) {
            $.getJSON("{{ url('medic/get_patients') }}", function (data) {
                var options = $("#patients_dropdown");
                $.each(data, function () {
                    options.append("<option value='" + this['id'] + "'>" + this['value'] + "</option>");
                });
                if(doFillId) {
                    fillPatientDetails(doFillId);
                }
            });
        }
    }
    $('#patient_change_btn').click(function () {
        loadPatientsDropdown(null);
        $('#patient_change').modal();
    });
    function fillPatientDetails(id) {
        var value = $("#patients_dropdown option[value='" + id + "']").text();
        var cnp = value.substring(0, value.indexOf(' '));
        var name = value.substring(value.indexOf(' ') + 1, value.length);
        $('#patient_cnp').html(cnp);
        $('#patient_name').html(name);
    }
    $('#patient_choose').click(function () {
        var id = $("#patients_dropdown").val();
        $("input[name=patient_id]").val(id);
        fillPatientDetails(id);
        $('#patient_change').modal('hide');
    });
    $(document).ready(function () {
        var id = $("input[name=patient_id]").val();
        /*if(id.trim().length > 0) {
            loadPatientsDropdown(id);
        }*/
    });

</script>