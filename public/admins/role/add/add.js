$(function () {
    $(".check_wrapper").on("click", function () {
        $(this)
            .parents(".card")
            .find(".check_children")
            .prop("checked", $(this).prop("checked")); //$(this).prop('checked') : trả về true/false
    });

    $(".check_all").on("click", function () {
        $(this)
            .parents()
            .find(".check_children")
            .prop("checked", $(this).prop("checked")); //$(this).prop('checked') : trả về true/false
        $(this)
            .parents()
            .find(".check_wrapper")
            .prop("checked", $(this).prop("checked"));
    });
});
