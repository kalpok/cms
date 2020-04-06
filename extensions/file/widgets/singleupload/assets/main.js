$(document).ready(function() {
    var deleteUrl = $('input[name="delete-url"]').val();
    $(document).on("click", ".file-delete", function() {
        if (confirm("آیا از حذف این فایل اطمینان دارید؟")) {
            var btn = $(this);
            $.ajax({
                type: "post",
                dataType: "json",
                data: { id: $(this).data("id") },
                url: deleteUrl
            }).done(function(data) {
                btn.parents("li").fadeOut(500, function() {
                    btn.parents(".filemanager-widgets-file")
                        .find(".single-file-upload")
                        .fadeIn(1000);
                });
                //TODO showAlert(data.message);
            });
        }
    });

    // image upload widget uploaded image preview
    $(document).on("change", ".btn-image :file", function() {
        if ($(this).get(0).files && $(this).get(0).files[0]) {
            var image = $(this)
                .parents(".single-file-upload")
                .find("img.image-preview");
            var reader = new FileReader();
            reader.onload = function(e) {
                image.attr("src", e.target.result);
                image.show();
            };
            reader.readAsDataURL($(this).get(0).files[0]);
        }
    });

    // file upload widget show uploaded file's name
    $(document).on("change", ".btn-file :file", function() {
        var input = $(this),
            numFiles = input.get(0).files ? input.get(0).files.length : 1,
            label = input
                .val()
                .replace(/\\/g, "/")
                .replace(/.*\//, "");
        var input = $(this)
                .parents(".input-group")
                .find(":text"),
            log = numFiles > 1 ? numFiles + " files selected" : label;
        if (input.length) {
            input.val(log);
        } else {
            if (log) alert(log);
        }
    });
});
