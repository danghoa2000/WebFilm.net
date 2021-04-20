$(".active").attr('class', 'nav-link');
$("#home").attr('class', 'nav-link active');

$('#bt-edit').click(function(e) {
    $('.hidden-edit').fadeOut();
    $('.input-edit-profile').fadeIn();
    $('#bt-cancel').fadeIn();
    $('#bt-save').fadeIn();
});

$('#bt-cancel').click(function() {
    $('.hidden-edit').fadeIn();
    $('.input-edit-profile').fadeOut();
    $('#bt-cancel').fadeOut();
    $('#bt-save').fadeOut();
    $('#name-error').fadeOut();
})

$(document).ready(function() {
    $("#edit-admin-form").validate({
        rules: {
            name: {
                required: true,
                maxlength: 255
            },

        }
    });
});

$(document).ready(function() {
    $("#update_avatar").validate({
        rules: {
            avatar: {
                extension: "png|jpg|jpeg|jfif"
            },
        }
    });
});

$("#upload-avatar").click(function() {
    $("#input-change-avatar").val("");
    $("#save-change-avatar").prop('disabled', true);
    $("#preview-avatar").css('display', 'none');
    $("#input-change-avatar").trigger('click');
})

function get_img(event) {
    if (URL.createObjectURL(event.target.files[0]) != null) {
        $("#preview-avatar").attr("src", URL.createObjectURL(event.target.files[0]));
        $("#preview-avatar").css('display', 'block');
        $("#save-change-avatar").prop('disabled', false);
    }
}

$("#cancel-change-avatar").click(function(e) {
    $("#preview-avatar").css('display', 'none');
    $(".popup").css('display', 'none');
    $("#save-change-avatar").prop('disabled', true);
});

$(".show-popup-change-avatar").click(function() {
    $(".popup").css('display', 'flex');
})