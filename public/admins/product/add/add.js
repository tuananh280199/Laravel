$(function () {
    $(".tags_select").select2({
        tags: true,
        tokenSeparators: [","],
    });
    $(".select2_cate").select2({
        placeholder: "Chọn danh mục",
        allowClear: true,
    });
});
