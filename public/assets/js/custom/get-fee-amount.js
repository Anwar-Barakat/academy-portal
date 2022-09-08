$(document).ready(function () {
    $("select[name=fee_id]").on("change", function () {
        var fee_id = $(this).val();
        if (fee_id) {
            $.ajax({
                url: "/admin/get-fee-amount/" + fee_id,
                type: "GET",
                dataType: "json",
                success: function (data) {
                    console.log(data);
                    $("#amount").empty();
                    $("#amount").append(
                        '<option selected value="' +
                            data +
                            '">' +
                            data +
                            "</option>"
                    );
                },
            });
        }
    });
});
