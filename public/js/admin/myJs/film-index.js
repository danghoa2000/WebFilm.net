$('.popup-detail').hover(function(e) {
    var id = "#" + e.target.id;
    $(id).popover('show')
}, function(e) {
    var id = "#" + e.target.id;
    $(id).popover('hide')
});

$('.popup-link').hover(function(e) {
    var id = "#" + e.target.id;
    $(id).popover('show')
}, function(e) {
    var id = "#" + e.target.id;
    $(id).popover('hide')
});

$('.popup-category').hover(function(e) {
    var id = "#" + e.target.id;
    $(id).popover('show')
}, function(e) {
    var id = "#" + e.target.id;
    $(id).popover('hide')
});

$(".active").attr('class', 'nav-link');
$("#film").attr('class', 'nav-link active');
$("#master_film").attr("class", "nav-item has-treeview menu-open");
$("#film_index").css("display", "block");