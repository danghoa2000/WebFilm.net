$("#exampleInputFile").change(function(e) {
    if (URL.createObjectURL(e.target.files[0]) != null) {
        $("#img-upload-preview").attr("src", URL.createObjectURL(e.target.files[0]));
        $("#img-upload-preview").css('display', 'block');
        $("#label-avatar").text(URL.createObjectURL(e.target.files[0]));
    }
});

$("#movie-background").click(function(e) {
    $("#img-upload-preview-background").css('display', 'none');
    $("#movie-background").val("");
    $("#label-background").text("Choose file");
});

$("#movie-background").change(function(e) {
    if (URL.createObjectURL(e.target.files[0]) != null) {
        $("#img-upload-preview-background").attr("src", URL.createObjectURL(e.target.files[0]));
        $("#img-upload-preview-background").css('display', 'block');
        $("#label-background").text(URL.createObjectURL(e.target.files[0]));
    }
});

$("#exampleInputFile").click(function(e) {
    $("#img-upload-preview").css('display', 'none');
    $("#exampleInputFile").val("");
    $("#label-avatar").text("Choose file");
});

$("#file-link-trailer").change(function(e) {
    if (URL.createObjectURL(e.target.files[0]) != null) {
        $("#label-link-trailer").text(URL.createObjectURL(e.target.files[0]));
    }
});

$("#file-link-trailer").click(function(e) {
    $("#file-link-trailer").val("");
    $("#label-link-trailer").text("Choose file");
});

$(".active").attr('class', 'nav-link');
$("#CreateFilm").attr('class', 'nav-link active');
$("#master_film").attr("class", "nav-item has-treeview menu-open");

$(document).ready(function() {
    $("#film-create").validate({
        rules: {
            name: {
                required: true,
                maxlength: 255
            },
            quoc_gia: {
                required: true,
            },
            nam_sx: {
                required: true,
            },
            mota: {
                required: true,
            },
            link_trailer: {
                extension: "mp4"
            },
            avatar: {
                required: true,
                extension: "png|jpg|jpeg|jfif"
            },
            background: {
                required: true,
                extension: "png|jpg|jpeg|jfif"
            }
        },
        messages: {
            name: {
                required: "Tên film không được để trống",
                maxlength: "không quá 255 kí tự",
            },
            quoc_gia: {
                required: "Quốc gia không được để trống",
            },
            nam_sx: {
                required: "Năm sản xuất không được để trống",
            },
            mota: {
                required: "Mô tả không được để trống",
            },
            link_trailer: {
                extension: "Link trailer được chọn phải thuộc mp4"
            },
            avatar: {
                required: "Avatar không được để trống",
                extension: "avatar được chọn phải thuộc jpg,jpeg,png,jfif"
            },
            background: {
                required: "Background không được để trống",
                extension: "Background được chọn phải thuộc jpg,jpeg,png,jfif"
            }
        }
    });
});