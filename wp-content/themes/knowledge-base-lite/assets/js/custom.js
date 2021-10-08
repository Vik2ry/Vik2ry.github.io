function knowledge_base_lite_menu_open_nav() {
	window.knowledge_base_lite_responsiveMenu=true;
	jQuery(".sidenav").addClass('show');
}
function knowledge_base_lite_menu_close_nav() {
	window.knowledge_base_lite_responsiveMenu=false;
 	jQuery(".sidenav").removeClass('show');
}

jQuery(function($){
 	"use strict";
   	jQuery('.main-menu > ul').superfish({
		delay:       500,
		animation:   {opacity:'show',height:'show'},  
		speed:       'fast'
   	});
});

jQuery(document).ready(function () {
	window.knowledge_base_lite_currentfocus=null;
  	knowledge_base_lite_checkfocusdElement();
	var knowledge_base_lite_body = document.querySelector('body');
	knowledge_base_lite_body.addEventListener('keyup', knowledge_base_lite_check_tab_press);
	var knowledge_base_lite_gotoHome = false;
	var knowledge_base_lite_gotoClose = false;
	window.knowledge_base_lite_responsiveMenu=false;
 	function knowledge_base_lite_checkfocusdElement(){
	 	if(window.knowledge_base_lite_currentfocus=document.activeElement.className){
		 	window.knowledge_base_lite_currentfocus=document.activeElement.className;
	 	}
 	}
 	function knowledge_base_lite_check_tab_press(e) {
		"use strict";
		// pick passed event or global event object if passed one is empty
		e = e || event;
		var activeElement;

		if(window.innerWidth < 999){
		if (e.keyCode == 9) {
			if(window.knowledge_base_lite_responsiveMenu){
			if (!e.shiftKey) {
				if(knowledge_base_lite_gotoHome) {
					jQuery( ".main-menu ul:first li:first a:first-child" ).focus();
				}
			}
			if (jQuery("a.closebtn.mobile-menu").is(":focus")) {
				knowledge_base_lite_gotoHome = true;
			} else {
				knowledge_base_lite_gotoHome = false;
			}

		}else{

			if(window.knowledge_base_lite_currentfocus=="responsivetoggle"){
				jQuery( "" ).focus();
			}}}
		}
		if (e.shiftKey && e.keyCode == 9) {
		if(window.innerWidth < 999){
			if(window.knowledge_base_lite_currentfocus=="header-search"){
				jQuery(".responsivetoggle").focus();
			}else{
				if(window.knowledge_base_lite_responsiveMenu){
				if(knowledge_base_lite_gotoClose){
					jQuery("a.closebtn.mobile-menu").focus();
				}
				if (jQuery( ".main-menu ul:first li:first a:first-child" ).is(":focus")) {
					knowledge_base_lite_gotoClose = true;
				} else {
					knowledge_base_lite_gotoClose = false;
				}
			
			}else{

			if(window.knowledge_base_lite_responsiveMenu){
			}}}}
		}
	 	knowledge_base_lite_checkfocusdElement();
	}
});

jQuery('document').ready(function($){
    setTimeout(function () {
		jQuery("#preloader").fadeOut("slow");
    },1000);
});

jQuery(document).ready(function () {
	jQuery(window).scroll(function () {
	    if (jQuery(this).scrollTop() > 100) {
	        jQuery('.scrollup i').fadeIn();
	    } else {
	        jQuery('.scrollup i').fadeOut();
	    }
	});
	jQuery('.scrollup i').click(function () {
	    jQuery("html, body").animate({
	        scrollTop: 0
	    }, 600);
	    return false;
	});
});