$('.popup-detail').hover(function(e) {
    var id = "#" + e.target.id;
    $(id).popover('show')
}, function(e) {
    var id = "#" + e.target.id;
    $(id).popover('hide')
});

$(".active").attr('class', 'nav-link');
$("#user").attr('class', 'nav-link active');
$("#master_user").attr("class", "nav-item has-treeview menu-open");
$("#user_index").css("display", "block");