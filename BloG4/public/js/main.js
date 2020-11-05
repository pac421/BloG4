/*
 * 
 * Fonctions générales pour l'application
 * 
 * evt: event
 * fct: fonction
 * 
 */

function input_date_focus(el){
    el.type = 'date';
};

function input_date_blur(el){
    let selector = $('#'+el.id);
    if(selector[0].value == ''){
		el.type = 'text';
		let parent = selector.parent();
		parent.find('i').removeClass("active");
		parent.find('input').removeClass("active");
		parent.find('label').removeClass("active");
	}
};
