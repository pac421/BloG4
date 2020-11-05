function btn_delete_click(el) {

    let action_val = $(el).attr('action');

    $('#modal_confirm_delete_btn').attr("href", action_val);
}

$('#btn_scroll_to_top').click(function() {
    $('#div_profil_fil_actualite').animate({ scrollTop: 0 }, 500);
});

$("#div_profil_fil_actualite").scroll(function() {
    if($(this).scrollTop() > 0) {
        if($("#div_scroll_to_top").hasClass("invisible")){
            $('#div_scroll_to_top').removeClass('invisible');
        }
    } else {
        $('#div_scroll_to_top').addClass('invisible');
    }
});