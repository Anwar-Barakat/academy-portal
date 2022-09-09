$(function () {
    $("select[name=section_id]").on("change", function () {
        var section_id = $(this).val();
        if (section_id) {
            $.ajax({
                type: "get",
                url: "/admin/get-teachers/" + section_id,
                dataType: "json",
                success: function (response) {
                    $("select[name=teacher_id]").empty();
                    $("select[name=teacher_id]").append(
                        '<option disabled  value="" selected>Select...</option>'
                    );
                    response.forEach((teachers) => {
                        teachers.forEach((teacher) => {
                            document.querySelector(
                                "select[name=teacher_id]"
                            ).innerHTML += `<option value=${teacher["id"]}>${teacher["name"]["en"]}</option>`;
                        });
                    });
                },
            });
        }
    });
});
