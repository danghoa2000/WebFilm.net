$(document).ready(function() {
    setTimeout(function() {
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            type: "post",
            url: "/watch",
            data: { id: $("#id_film").val() }
        });
    }, 5000);
});