$(document).ready(function () {
    $("select[name=grade_id]").on("change", function () {
        var grade_id = $(this).val();
        if (grade_id) {
            $.ajax({
                url: "/get-classrooms/" + grade_id,
                type: "GET",
                dataType: "json",
                success: function (data) {
                    $("select[name=classroom_id]").empty();
                    $("select[name=classroom_id]").append(
                        '<option disabled  value="" selected>Select ...</option>'
                    );
                    $.each(data, function (key, value) {
                        $("select[name=classroom_id]").append(
                            '<option value="' + key + '">' + value + "</option>"
                        );
                    });
                },
            });
        }
    });
});
