$('.popup-link').hover(function(e) {
    var id = "#" + e.target.id;
    $(id).popover('show')
}, function(e) {
    var id = "#" + e.target.id;
    $(id).popover('hide')
});

$(".active").attr('class', 'nav-link');
$("#episode").attr('class', 'nav-link active');
$("#master_episode").attr("class", "nav-item has-treeview menu-open");
$("#episode_index").css("display", "block");