/*
 * 
 * Fonctions pour le fil d'actualité
 * 
 * evt: event
 * fct: fonction
 * 
 */
 
$('#home_check_all_categories').click(function() {
    console.log('evt home_check_all_categories click start');
    $('.home_input_categorie').prop('checked', true);
});

$('#home_uncheck_all_categories').click(function() {
    console.log('evt home_uncheck_all_categories click start');
    $('.home_input_categorie').prop('checked', false);
});

$('#home_search').change(function() {
    console.log('evt home_search change start');
    console.log(this.value);
});

$('#home_order_date').change(function() {
    console.log('evt home_order_date change start');
    console.log(this.checked);
});
