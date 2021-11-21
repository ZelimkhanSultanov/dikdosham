jQuery(document).ready(readyDoc);

function readyDoc() {
	jQuery("#dosh_block #translate_btn, #dosh_block #enter_icon").click(translator);
	jQuery("#dosh_block #word").keypress(function(e){
		if (e.keyCode==13) translator();
	});
 
	jQuery("#dosh_block #word").focus();

	jQuery("#dosh_block #logo, #dosh_block #dosham").click(doshamInfo);

	footerHeight();
}

function translator() {

	var preloader = "<div class='preloader'><img src='../images/load.gif'></div>";
	var errorNoWord = '<span id="error_no_word">Вы не ввели слово.</span>';
	var errorTranslate = '<span id="error_translate">Слово не найдено в базовых словарях.</span>';
	
	jQuery("#dosham_info").hide();
	jQuery("#errors-block").html("").fadeOut(200);
	jQuery("#word").keydown(function(){	
			jQuery("#errors-block").html("").fadeOut(200);	
		});
	var word = jQuery("#word").val();
	var lang = 'ru';
	
	if (word === '') {
		jQuery("#result").fadeOut(200);
		jQuery("#errors-block").html(errorNoWord).fadeOut(200);
		jQuery("#errors-block").html(errorNoWord).show(100);
		jQuery("#word").focus();
		jQuery("#word").keydown(function(){	
			jQuery("#errors-block").html("").fadeOut(200);	
		});
	}
	else {
	jQuery.ajax({
 			type: "POST",
 			url: "../dosh.php",
 			data: {word:word,lang:lang},
 			beforeSend: function() {
 				jQuery("#result").html(preloader).slideDown(200);
 			},

 			success: function(data) {
 				if (data != 0) {
 					// Получение списка словарей
 					jQuery.ajax({
 						type: "POST",
 						url: "../dosh.php",
 						data: {dict:1},
 						success: function(dicts) {
 							var dict = JSON.parse(dicts);
 							var mass = JSON.parse(data);
 							jQuery("#result").html('');
 							for (var j=0; j<dict.length; j++) {
 								var dict_name = dict[j]["name_ru"];
 								var dict_table = dict[j]["dict_table_name"];
 								if (mass[dict_table]) {
 									jQuery("#result").append('<h2 class="dict_header">'+dict_name+'</h2>');
 									for (var i=0; i<mass[dict_table].length; i++) {
 										var slovo = mass[dict_table][i]['word'];
 										var perevod = mass[dict_table][i]['translate'];
 										jQuery("#result").append('<div class="slovo">'+slovo+' <span class="open_perevod">смотреть перевод</span></div><div class="perevod"> '+perevod+'</div>');
 									}
 								}	
 							}

 							jQuery('#result').hide().slideDown(200);

 							function togg() {
 								jQuery(this).next('.perevod').toggle(200);
 							}
 							jQuery('#result .slovo').click(togg);
 						}
 					});

 					
 					
 					jQuery("#errors-block").html("").fadeOut(200);
 					jQuery("#result").fadeIn(200);
 				}
 				else {
 					jQuery("#result").hide();
 					jQuery("#errors-block").html(errorTranslate).fadeIn();
 					jQuery("#word").focus();
 				}
 			}
 		});
	}
}

function doshamInfo() {
	jQuery("#dosh_block #word").val("");
	jQuery("#dosh_block #word").focus();
	jQuery("#dosh_block #result").hide();
	jQuery("#dosh_block #dosham_info").show();
	jQuery("#errors-block").html("");hide();
}

function footerHeight() {
	var footerH = $('footer').height() + 10;
	$('#result, #dosham_info').css('marginBottom', footerH+'px');
}
