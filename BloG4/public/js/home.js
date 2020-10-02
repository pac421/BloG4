/*
 * 
 * Fonctions pour le fil d'actualité
 * 
 * evt: event
 * fct: fonction
 * 
 */

$(document).ready(function(){
	console.log('data_home : ', data_home);
	load_articles();
});

function load_articles(){
	let lst_selected_categories = get_selected_categories();
	let selected_date_order = get_selected_date_order();
	let searched_str = get_searched_str();
	select_and_order_articles(lst_selected_categories, selected_date_order, searched_str);
}

function get_selected_categories(){
	console.log('fct get_selected_categories start');
	
	let lst_selected_categories = [];
	
	let lst_elements_categories = $('.home_input_categorie');
	$.each(lst_elements_categories, function(i, el){
		let value = el.value;
		let checked = el.checked;
		
		lst_selected_categories[value] = checked;
	});
	
	console.log('lst_selected_categories : ', lst_selected_categories);
	return lst_selected_categories;
};

function get_selected_date_order(){
	console.log('fct get_selected_date_order start');
	
	let element_date_order = $('#home_order_date')[0];
	let selected_date_order = element_date_order.checked;
	
	console.log('selected_date_order : ', selected_date_order);
	return selected_date_order;
};

function get_searched_str(){
	console.log('fct get_searched_str start');
	
	let element_search = $('#home_search')[0];
	let searched_str = element_search.value;
	
	console.log('searched_str : ', searched_str);
	return searched_str;
}

function select_and_order_articles(lst_selected_categories, selected_date_order, searched_str){
	console.log('fct select_articles start');
	
	let lst_articles = data_home.lst_articles;
	
	// Sort articles with selected categories
	let lst_selected_articles = [];
	$.each(lst_articles, function(i, article){
		
		let has_selected_category = false;
		
		$.each(article.lst_categories, function(i, category){
			if(lst_selected_categories[category] == true){
				has_selected_category = true;
			}
		});
		
		if(has_selected_category){
			lst_selected_articles.push(article);
		}
	});
	
	// Order articles by their date
	let lst_selected_and_ordered_articles = lst_selected_articles.sort((a, b) => {
		return moment(a.created_at).diff(b.created_at);
	});
	if(selected_date_order){
		lst_selected_and_ordered_articles.reverse();
	} 
	
	// Sort articles with searched string
	for(let i = 0; i < lst_selected_and_ordered_articles.length; i++) {
		lst_selected_and_ordered_articles[i].title = lst_selected_and_ordered_articles[i].title.replaceAll('<span class="primary-color white-text">', '').replaceAll('</span>', '');
		lst_selected_and_ordered_articles[i].content = lst_selected_and_ordered_articles[i].content.replaceAll('<span class="primary-color white-text">', '').replaceAll('</span>', '');
	}
	if(searched_str != ''){
		
		lst_selected_and_ordered_articles = lst_selected_and_ordered_articles.filter(article => article.content.includes(searched_str) || article.title.includes(searched_str));
		
		for(let i = 0; i < lst_selected_and_ordered_articles.length; i++) {
			lst_selected_and_ordered_articles[i].title = lst_selected_and_ordered_articles[i].title.replaceAll(searched_str, '<span class="primary-color white-text">'+searched_str+'</span>');
			lst_selected_and_ordered_articles[i].content = lst_selected_and_ordered_articles[i].content.replaceAll(searched_str, '<span class="primary-color white-text">'+searched_str+'</span>');
		}
	}
	
	console.log('lst_selected_and_ordered_articles : ', lst_selected_and_ordered_articles);
	display_articles(lst_selected_and_ordered_articles);
};

function display_articles(lst_selected_and_ordered_articles){
	console.log('fct display_articles start');
	
	$('#home_div_articles').empty();

	$.each(lst_selected_and_ordered_articles, function(i, article){	
		
		let id = article.id;
		let title = article.title;
		let picture = article.picture;
		let name = article.name;
		let content = article.content;
		let created_at = moment(article.created_at.date).format("DD/MM/YYYY HH:mm:ss");
		let lst_categories = article.lst_categories;
		let lst_comments = article.lst_comments;
			
		let article_html = '<div class="mb-3">'+id+'</br>'+title+'</br>'+name+'</br>'+content+'</br>'+created_at+'</div>';
		
		$('#home_div_articles').append(article_html);
	});
};

$("#home_search").on("change paste keyup", function(){
   load_articles();
});
 
$('#home_check_all_categories').click(function() {
    console.log('evt home_check_all_categories click start');
    $('.home_input_categorie').prop('checked', true);
    load_articles();
});

$('#home_uncheck_all_categories').click(function() {
    console.log('evt home_uncheck_all_categories click start');
    $('.home_input_categorie').prop('checked', false);
    load_articles();
});
