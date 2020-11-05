/*
 * 
 * Fonctions pour le fil d'actualité
 * 
 * evt: event
 * fct: fonction
 * 
 */

$(document).ready(function(){
	load_articles();
});

function load_articles(){
	let lst_selected_categories = get_selected_categories();
	let selected_date_order = get_selected_date_order();
	let searched_str = get_searched_str();
	select_and_order_articles(lst_selected_categories, selected_date_order, searched_str);
}

function get_selected_categories(){
	
	let lst_selected_categories = [];
	
	let lst_elements_categories = $('.home_input_categorie');
	$.each(lst_elements_categories, function(i, el){
		let value = el.value;
		let checked = el.checked;
		
		lst_selected_categories[value] = checked;
	});

	return lst_selected_categories;
};

function get_selected_date_order(){
	
	let element_date_order = $('#home_order_date')[0];
	let selected_date_order = element_date_order.checked;

	return selected_date_order;
};

function get_searched_str(){
	
	let element_search = $('#home_search')[0];
	let searched_str = element_search.value;

	return searched_str;
}

function select_and_order_articles(lst_selected_categories, selected_date_order, searched_str){
	
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

	display_articles(lst_selected_and_ordered_articles);
};

function display_articles(lst_selected_and_ordered_articles){
	
	$('#home_div_articles').empty();

	$.each(lst_selected_and_ordered_articles, function(i, article){
		
		let id = article.id;
		let title = article.title;
		let picture = article.picture;
		let name = article.name;
		let content = article.content;
		let created_at = moment(article.created_at.date).format("DD/MM/YYYY HH:mm");
		let created_on = article.created_on;
		
		// Catégories
		let lst_categories = article.lst_categories;
		let categories_html = '';
		$.each(lst_categories, function(i, category){
			let category_label = data_home.lst_categories.find(cat => cat.id == category).label;
			categories_html += '<span class="badge badge-primary mr-1">'+category_label+'</span>';
		});
		
		// Commentaires
		let lst_comments = article.lst_comments;
		let nb_comments = lst_comments.length;
		let comments_html = '';
		$.each(lst_comments, function(i, comment){

			let com_id = comment.id;
			let com_name = comment.name;
			let com_content = comment.content;
			let com_created_at = moment(comment.created_at.date).format("DD/MM/YYYY HH:mm");
			let com_created_on = comment.created_on;
			
			comments_html += '<div class="media d-block d-md-flex mt-4"><div class="media-body text-center text-md-left md-3 ml-0"><div class="d-flex justify-content-between align-items-center"><div><a class="font-weight-bold mb-0 text-dark" href="/profil/'+com_created_on+'">'+com_name+'</a>, '+com_created_at+'</div><div><a action="/deleteComment/'+com_id+'" title="Supprimer" class="text-dark" onclick="btn_delete_click(this)" data-toggle="modal" data-target="#modalConfirmDelete"><i class="fa fa-trash-alt fa-sm"></i></a></div></div>'+com_content+'</div></div>';
		});
		
		let article_html = '';
		article_html += $('#home_exemple_article')[0].innerHTML;
		
		article_html = article_html
			.replaceAll('[article_id]', id)
			.replace('[article_title]', title)
			.replace('[article_picture]', picture)
			.replace('[article_name]', name)
			.replace('[article_content]', content)
			.replace('[article_date]', created_at)
			.replace('[comments_number]', nb_comments)
			.replace('[article_categories]', categories_html)
			.replace('[article_comments]', comments_html)
			.replace('[article_created_on]', created_on)
		;
		
		$('#home_div_articles').append(article_html);
	});

	$('#home_badge_nbr_article').html(lst_selected_and_ordered_articles.length+" articles");
};

$("#home_search").on("change paste keyup", function(){
   load_articles();
});
 
$('#home_check_all_categories').click(function() {
    $('.home_input_categorie').prop('checked', true);
    load_articles();
});

$('#home_uncheck_all_categories').click(function() {
    $('.home_input_categorie').prop('checked', false);
    load_articles();
});

$('#btn_scroll_to_top').click(function() {
	$('#div_home_fil_actualite').animate({ scrollTop: 0 }, 500);
});

$("#div_home_fil_actualite").scroll(function() {
	if($(this).scrollTop() > 0) {
		if($("#div_scroll_to_top").hasClass("invisible")){
			$('#div_scroll_to_top').removeClass('invisible');
		}
	} else {
		$('#div_scroll_to_top').addClass('invisible');
	}
});

function btn_delete_click(el) {

	let action_val = $(el).attr('action');

	$('#modal_confirm_delete_btn').attr("href", action_val);
}
