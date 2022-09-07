$(function () {
    $("select[name=classroom_id]").on("change", function () {
        var classroom_id = $(this).val();
        if (classroom_id) {
            $.ajax({
                type: "get",
                url: "/get-sections/" + classroom_id,
                dataType: "json",
                success: function (response) {
                    $("select[name=section_id]").empty();
                    $("select[name=section_id]").append(
                        '<option disabled  value="" selected>Select...</option>'
                    );
                    $.each(response, function (index, value) {
                        $("select[name=section_id]").append(
                            '<option value="' +
                                index +
                                '">' +
                                value +
                                "</option>"
                        );
                    });
                },
            });
        }
    });
});
