jQuery(document).ready(readyDoc);

function readyDoc() {
	jQuery("#dosh_block #translate_btn, #dosh_block #enter_icon").click(translator);
	jQuery("#dosh_block #word").keypress(function(e){
		if (e.keyCode==13) translator();
	});

	jQuery("#dosh_block_mini").click(function(){
		jQuery("html,body").animate({scrollTop: '0px'}, 300);   
		jQuery("html, body").css("overflow","hidden");
		jQuery("#dosh_block_bg, #dosh_block0").fadeIn(300);
		jQuery("#dosh_block #word").focus();
		sizeBlocks();
	});

	jQuery("div#dosh_block_bg, #close_dosham").click(function(){
		jQuery("html, body").css("overflow","");
		jQuery("#dosh_block_bg,#dosh_block0").fadeOut(300);	
	});

	jQuery("#dosh_block #logo, #dosh_block #dosham").click(doshamInfo);

	jQuery(window).resize(sizeBlocks);
}

function translator() {
	jQuery("#dosham_info").hide();
	jQuery("#dosh_block #error_no_word").fadeOut(200);	
	jQuery("#dosh_block #word").keydown(function(){	
			jQuery("#dosh_block #error_no_word").fadeOut(200);	
		});
	var word = jQuery("#dosh_block #word").val();
	
	if (word == '') {
		jQuery("#dosh_block #result").fadeOut(200);
		jQuery("#dosh_block #error_translate").fadeOut(200);
		jQuery("#dosh_block #error_translate").show(100);
		jQuery("#dosh_block #word").focus();
		jQuery("#dosh_block #word").keydown(function(){	
			jQuery("#dosh_block #error_translate, #dosh_block #error_no_word").fadeOut(200);	
		});
	}
	else {
	jQuery.ajax({
 			type: "POST",
 			url: "/dikdosham/dosh.php",
 			data: {word:word},
 			beforeSend: function() {
 				jQuery("#dosh_block #result").html(" \
 					<div style='width:128px;margin:auto;padding:50px;'> \
 					<img src='/dikdosham/images/load0.gif' width='128' height='128'/> \
 					</div>").slideDown(200);
 			},

 			success: function(data) {
 				if (data != 0) {
 					// Получение списка словарей
 					jQuery.ajax({
 						type: "POST",
 						url: "/dikdosham/dosh.php",
 						data: {dict:1},
 						success: function(dicts) {
 							var dict = JSON.parse(dicts);
 							var mass = JSON.parse(data);
 							jQuery("#dosh_block #result").html('');
 							for (var j=0; j<dict.length; j++) {
 								var dict_name = dict[j]["name"];
 								var dict_table = dict[j]["dict_table_name"];
 								if (mass[dict_table]) {
 									jQuery("#dosh_block #result").append('<h2 class="dict_header">'+dict_name+'</h2>');
 									for (var i=0; i<mass[dict_table].length; i++) {
 										var slovo = mass[dict_table][i]['word'];
 										var perevod = mass[dict_table][i]['translate'];
 										jQuery("#dosh_block #result").append('<div class="slovo">'+slovo+' </div><div class="perevod"> '+perevod+'</div>');
 									}
 								}	
 							}

 							jQuery('#dosh_block #result').hide().slideDown(200);

 							function togg() {
 								jQuery(this).next('.perevod').toggle(200);
 							}
 							jQuery('#dosh_block #result .slovo').mouseenter(togg);
 							jQuery('#dosh_block #result .slovo').mouseleave(togg);

 							jQuery('#dosh_block #result .slovo').toggle(
 								function() {
 									jQuery(this).unbind('mouseenter',togg);
 									jQuery(this).unbind('mouseleave',togg);
 								},
 								function() {
 									// jQuery(this).next('.perevod').toggle(200);
 									// jQuery(this).mouseleave(function(){
 									// 	jQuery(this).unbind('mouseleave');
 									// });
 									jQuery(this).bind('mouseenter',togg);
 									jQuery(this).bind('mouseleave',togg);
 									
 								}
 							);
 						}
 					});

 					
 					
 					jQuery("#dosh_block #error_translate").fadeOut(200);
 					jQuery("#dosh_block #result").fadeIn(200);
 				}
 				else {
 					jQuery("#dosh_block #result").hide();
 					jQuery("#dosh_block #error_no_word").fadeIn();
 					jQuery("#dosh_block #word").focus();
 				}
 			}
 		});
	}
}

function sizeBlocks() {
	var wordWidth = jQuery("#dosh_block").width()-jQuery("#dosh_block #translate_btn").width()-33;
	jQuery("#dosh_block #word").css("width",wordWidth);

	var left = jQuery(window).width()/2-jQuery("#dosh_block0").width()/2;
	var top = jQuery(window).height()/2-jQuery("#dosh_block0").height()/2-20;
	jQuery("#dosh_block0").css({"left":left,"top":top});

	var resultHeight = jQuery("#dosh_block").height()-jQuery("#dosh_block header").height()-jQuery("#dosh_block #dosh_form").height()-70;
	jQuery("#dosh_block #result").css("maxHeight",resultHeight);
}

function doshamInfo() {
	jQuery("#dosh_block #word").val("");
	jQuery("#dosh_block #word").focus();
	jQuery("#dosh_block #result").hide();
	jQuery("#dosh_block #dosham_info").show();
	jQuery("#dosh_block #error_translate,#dosh_block #error_no_word").hide();
}
