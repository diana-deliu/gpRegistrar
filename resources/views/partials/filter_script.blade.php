<script>
    $(".table-striped > thead > tr > th > input").change(function () {
        var val = $(this).val();
        console.log(val);
        var id = $(this).parent().index();
        var rows = $(this).parent().parent().parent().parent().find("tbody > tr");
        rows.each(function() {
            var html = $(this).find("td:eq("+id+")").html();
            if (!matches(html, val)) {
                $(this).addClass("hidden");
            } else {
                $(this).removeClass("hidden");
            }
        });
    });
    function matches(father, child) {
        return father.toLowerCase().includes(child.toLowerCase());
    }
</script>