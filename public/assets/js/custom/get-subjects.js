$(function () {
    $("select[name=teacher_id]").on("change", function () {
        var teacher_id = $(this).val();
        if (teacher_id) {
            $.ajax({
                type: "get",
                url: "/admin/get-subjects/" + teacher_id,
                dataType: "json",
                success: function (response) {
                    $("select[name=subject_id]").empty();
                    $("select[name=subject_id]").append(
                        '<option disabled  value="" selected>Select...</option>'
                    );
                    response.forEach((subjects) => {
                        subjects.forEach((subject) => {
                            document.querySelector(
                                "select[name=subject_id]"
                            ).innerHTML += `<option value=${subject["id"]}>${subject["name"]["en"]}</option>`;
                        });
                    });
                },
            });
        }
    });
});
