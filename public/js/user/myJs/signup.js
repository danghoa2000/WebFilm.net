function get_img(event) {
    if (URL.createObjectURL(event.target.files[0]) != null) {
        $("#img_avatar").attr("src", URL.createObjectURL(event.target.files[0]));
    }
}