$("#file-link").change(function(e) {
    if (URL.createObjectURL(e.target.files[0]) != null) {
        $("#label-link").text(URL.createObjectURL(e.target.files[0]));
    }
});

$(document).ready(function() {
    $("#episode-update").validate({
        rules: {
            tap_so: {
                required: true,
            },
            link: {
                extension: "mp4"
            }
        },
        messages: {
            tap_so: {
                required: "Tập film không được để trống",
            },
            link: {
                extension: "file tải lên phải thuộc mp4"
            }
        }
    });
});

$(".active").attr('class', 'nav-link');
$("#episodeEdit").attr('class', 'nav-link active');
$("#master_episode").attr("class", "nav-item has-treeview menu-open");
$("#episode_edit").css("display", "block");