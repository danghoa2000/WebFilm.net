$("#bt-comment").click(function(e) {
    if ($("#name_comment").val() != "") {
        if ($("#your-comment").val() != "") {
            var avatar = $("#avatar").attr('src');
            var name = $("#name_comment").val();
            var noi_dung = $("#your-comment").val();
            var id_film = $("#id_film").val();
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                type: "post",
                url: "/comment/store",
                data: {
                    name: name,
                    noi_dung: noi_dung,
                    avatar: avatar,
                    id_film: id_film
                },
                success: function(response) {
                    $("#lb-name-comment").css('display', 'none');

                    $("#view-comment").prepend(
                        function() {
                            var a = "";
                            var time_now = moment(new Date()).format('YYYY-MM-DD HH:mm:ss');
                            a += "<div class='anime__review__item'>" +
                                "<div class='anime__review__item__pic'>" +
                                "<img src='" + avatar + "' alt=''>" +
                                "</div>" +
                                "<div class='anime__review__item__text'>" +
                                "<h6>" + name + " - <span> 1 second before </span></h6>" +
                                "<p>" + noi_dung + "</p>" +
                                "</div>" +
                                "</div>"
                            return a;
                        }
                    );
                    $("#your-comment").val("");
                }
            });
        } else {
            $("#lb-name-comment").text("You have not written a comment");
            $("#lb-name-comment").fadeIn();
        }
    } else {
        $("#lb-name-comment").text("You need to enter a name if you want to comment");
        $("#lb-name-comment").fadeIn();
    }
});

$(".star").hover(function(e) {
    if (hover != 0) {
        for (let i = 1; i <= 5; i++) {
            $("#" + i).addClass('gray2');
        }
        for (let i = 1; i <= e.target.id; i++) {
            $("#" + i).addClass('yellow');
        }
    }
}, function() {
    for (let i = 1; i <= 5; i++) {
        $("#" + i).removeClass('yellow');
        $("#" + i).removeClass('gray2');
    }
});

$(".delete-comment").click(function(e) {
    console.log("asdasd");
    let $this = $(this),
        id_comment = $this.closest('.comment-form')[0][0]["value"];
    $.ajax({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        type: "post",
        url: "/comment/destroy",
        data: {
            id: function() {
                return id_comment;
            }
        },
        success: function(response) {
            $this.closest('.comment-form').css('display', 'none');
        }
    });
});

var i = 1;
$(document).ready(function() {
    loadComment(i);
    i++;
});

$("#see-more-comment").click(function(e) {
    loadComment(i);
    i++;
});



$(".trailer").click(function(e) {
    if (e.target["id"] != "video-trailer") {
        $(".trailer").css('display', 'none');
        $("#video-trailer").get(0).pause();
    }
});

$("#trailler").click(function(e) {
    $(".trailer").css('display', 'flex');
});

function loadComment(page) {
    $.ajax({
        type: "get",
        url: "/comment/get?page=" + page,
        data: {
            id: function() {
                return $("#id_film").val();
            }
        },
        success: function(response) {
            if (response[0] == null) {
                $("#see-more-comment").css("display", "none");
            }
            response.forEach(data => {
                $("#view-comment").append(
                    function() {
                        var a = "";
                        a += "<div class='anime__review__item'>" +
                            "<div class='anime__review__item__pic'>" +
                            "<img src='" + data[0] + "' alt=''>" +
                            "</div>" +
                            "<div class='anime__review__item__text' style='position: relative'>" +
                            "<h6>" + data[1] + " - <span>" + data[3] + "</span></h6>" +
                            "<p>" + data[2] + "</p>" +
                            "</div>"  +
                            "</div>"
                        return a;
                    }
                );
            });
        }
    });
}
