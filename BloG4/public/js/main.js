/*
 * 
 * Fonctions générales pour l'application
 * 
 * evt: event
 * fct: fonction
 * 
 */

function input_date_focus(el){
    console.log('fct input_date_focus start');
    el.type = 'date';
};

function input_date_blur(el){
    console.log('fct input_date_blur start');
    console.log($('#'+el.id));
    let selector = $('#'+el.id);
    if(selector[0].value == ''){
		el.type = 'text';
		let parent = selector.parent();
		parent.find('i').removeClass("active");
		parent.find('input').removeClass("active");
		parent.find('label').removeClass("active");
	}
};
