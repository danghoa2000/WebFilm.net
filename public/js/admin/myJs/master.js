$.ajax({
    type: "get",
    url: "/language",
    success: function($data) {
        if ($data == "vi") {
            $("#language").attr('class', 'flag-icon flag-icon-vn');
        } else {
            $("#language").attr('class', 'flag-icon flag-icon-us');
        }
    }
});

$(document).ready(function() {
    $('#preloder').fadeOut();
});
