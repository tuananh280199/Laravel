$(function () {
    $(".check_all").on("click", function () {
        $(this)
            .parents()
            .find(".check_children")
            .prop("checked", $(this).prop("checked")); //$(this).prop('checked') : trả về true/false
    });
});
