$("#file-link").click(function(e) {
    $("#file-link").val("");
    $("#label-link").text("Choose file");
});

$("#file-link").change(function(e) {
    if (URL.createObjectURL(e.target.files[0]) != null) {
        $("#label-link").text(URL.createObjectURL(e.target.files[0]));
    }
});

$(document).ready(function() {
    $("#episode-create").validate({
        rules: {
            tap_so: {
                required: true,
            },
            link: {
                required: true,
                extension: "mp4"
            }
        },
        messages: {
            tap_so: {
                required: "Tập film không được để trống",
            },
            link: {
                required: "Link film không được để trống",
                extension: "file tải lên phải thuộc mp4"
            }
        }
    });
});

$(".active").attr('class', 'nav-link');
$("#episodeCreate").attr('class', 'nav-link active');
$("#master_episode").attr("class", "nav-item has-treeview menu-open");
$("#episode_create").css("display", "block");