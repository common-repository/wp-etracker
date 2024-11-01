
jQuery(document).ready(function($){
	
   $(document).ajaxStop(function(){	
   		alert(window.key);
		et_eC_Wrapper(window.key,window.pagename,window.area, window.url);
		et_cc_wrapper(window.key, {cc_pagename:window.pagename});
    });
}
);