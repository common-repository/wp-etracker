

jQuery(document).ready(function($){
  

  $( "div[id^='gallery-']" ).children('figure').children('div').children('a').children('img').click(function () {
   var imgsrc=$(this).attr('src');
   var names=imgsrc.split('/');
   _etracker.sendEvent(et_GalleryViewEvent(names[names.length-1]));
    /*ET_Event.galleryView(names[names.length-1]);*/
   
});

  /**
  *
  ****************** @ Support for NextGen Plugin *******************
  * => click part
  */ 
   $( "div[id^='ngg-gallery']" ).children('div').children('div').children('a').children('img').click(function () {
   var imgsrc=$(this).attr('src');
   var names=imgsrc.split('/');
   _etracker.sendEvent(et_GalleryViewEvent(names[names.length-1]));
   /*ET_Event.galleryView(names[names.length-1]);*/
   
});
   //*end nextgen click part


   /**
  *
  * => next part
  */ 
   $( document).on('click',"span[id^='fancybox-right-ico']",function () {
   
   var imgsrc=$('#fancybox-img').attr('src');
   var names=imgsrc.split('/');
   _etracker.sendEvent(et_GalleryNextEvent(names[names.length-1]));
   /*ET_Event.galleryNext(names[names.length-1]);*/
   

});

   
   //*end nextgen next part

   /**
  *
  * => Previous part
  */ 
   $( document ).on('click',"span[id^='fancybox-left-ico']",function () {
    
   var imgsrc=$('#fancybox-img').attr('src');
   var names=imgsrc.split('/');
    _etracker.sendEvent(et_GalleryPreviousEvent(names[names.length-1]));
   /*ET_Event.galleryPrevious(names[names.length-1]);*/
   
});
   //*end nextgen Previous part

/**
  ****@ img browser slideshow type
  * => click part  
  */ 
   $( "div[id^='ngg-imagebrowser']" ).children('div').children('a').children('img').click(function () {
   var imgsrc=$(this).attr('src');
   var names=imgsrc.split('/');
   _etracker.sendEvent(et_GalleryViewEvent(names[names.length-1]));
   /*ET_Event.galleryView(names[names.length-1]);*/
   
});
   //*end nextgen click part


   /**
  *
  * => next part
  */ 
   $( document ).on('click',"a[id^='ngg-next']",function () {
   var imgsrc=$(this).attr('href');
   var names=imgsrc.split('/');
   _etracker.sendEvent(et_GalleryNextEvent(names[names.length-1]));
   /*ET_Event.galleryNext(names[names.length-1]);*/
   
});
   //*end  next part

   /**
  *
  * => Previous part
  */ 
   $( document ).on('click',"a[id^='ngg-prev']",function () {
   var imgsrc=$(this).attr('href');
   var names=imgsrc.split('/');
   _etracker.sendEvent(et_GalleryPreviousEvent(names[names.length-1]));
   /*ET_Event.galleryPrevious(names[names.length-1]);*/
   
});
   //*end nextgen Previous part



/**
  *
  **************** @ Support for Photo Galery Plugin *******************
  *- Thumbnails theme 
  *=> click part 
  */ 
   $( "form[id^='gal_front_form']" ).children('div').children('div').children('a').children('span').children('span').children('span').children('img').click(function () {
   var imgsrc=$(this).attr('src');
   var names=imgsrc.split('/');
   _etracker.sendEvent(et_GalleryViewEvent(names[names.length-1]));
   /*ET_Event.galleryView(names[names.length-1]);*/
   
});
   //*end  click part

    /**
  *
  * => next part
  */ 
   $( document ).on('click','#spider_popup_right',function () {
   
   var imgsrc=$('#fancybox-img').attr('src');
   var names=imgsrc.split('/');
   _etracker.sendEvent(et_GalleryNextEvent(names[names.length-1]));
  /* ET_Event.galleryNext(names[names.length-1]);*/
   
});
   //*end nextgen next part

   /**
  *
  * => Previous part
  */ 
   $(document ).on('click','#spider_popup_left',function () {
 
   var imgsrc=$(this).attr('href');
   var names=imgsrc.split('/');
   _etracker.sendEvent(et_GalleryPreviousEvent(names[names.length-1]));
   /*ET_Event.galleryPrevious(names[names.length-1]);*/
   
});
   //*end nextgen Previous part


   /*
   * -slideshow
   * =>next part
   */
    $( document ).on('click',"a[id^='spider_slideshow_right']",function () {
   
   var imgsrc=$("img[id^='bwg_slideshow_image']" ).attr('src');
   var names=imgsrc.split('/');
_etracker.sendEvent(et_GalleryNextEvent(names[names.length-1]));
   /*ET_Event.galleryNext(names[names.length-1]);*/
   
});
   //*end nextgen next part 


    /**
  *
  * => Previous part
  */ 
   $( document ).on('click',"a[id^='spider_slideshow_left']",function () {
   var imgsrc=$("img[id^='bwg_slideshow_image']" ).attr('src');
   var names=imgsrc.split('/');
   _etracker.sendEvent(et_GalleryPreviousEvent(names[names.length-1]));
  /* ET_Event.galleryPrevious(names[names.length-1]);*/
   
});
   //*end  Previous part

  /* ->Browser
  * => click part
  */ 
   $( "form[id^='gal_front_form']" ).children('div').children('div').children('div').children('div').children('div').children('a').children('img').click(function () {
  
   var imgsrc=$(this).attr('src');
   var names=imgsrc.split('/');
   _etracker.sendEvent(et_GalleryViewEvent(names[names.length-1]));
  /* ET_Event.galleryView(names[names.length-1]);*/
   
});
   //*end  click part


   /*
   * 
   * =>next part
   */

   $( "a[class^='prev-page']" ).click(function () {
   
   var imgsrc=$( this ).attr('href');
   var names=imgsrc.split('/');
   _etracker.sendEvent(et_GalleryNextEvent(names[names.length-1]));
   /*ET_Event.galleryNext(names[names.length-1]);*/
   
});
   //*end nextgen next part 


    /**
  *
  * => Previous part
  */ 
   $( "a[class^='next-page']" ).click(function () {
   var imgsrc=$(this).attr('href');
   var names=imgsrc.split('/');
  _etracker.sendEvent(et_GalleryPreviousEvent(names[names.length-1]));
  /* ET_Event.galleryPrevious(names[names.length-1]);*/
   
});
   //*end nextgen Previous part


   /**
  *
  **************** @ Support for Envira Galery Plugin *******************
  *
  *=> click part 
  */ 
   $( "a[class^='envira-gallery']" ).children('img').click(function () {

   var imgsrc=$(this).attr('src');
   var names=imgsrc.split('/');
   _etracker.sendEvent(et_GalleryViewEvent(names[names.length-1]));
   /*ET_Event.galleryView(names[names.length-1]);*/
   
});
   //*end  click part


    /*
   * =>next part
   */
    $( document ).on('click',"a[id^='envirabox-right']",function () {
   
   var imgsrc=$("img[id^='envirabox-img']" ).attr('src');
   var names=imgsrc.split('/');
   _etracker.sendEvent(et_GalleryNextEvent(names[names.length-1]));
   /*ET_Event.galleryNext(names[names.length-1]);*/
   
});
   //*end nextgen next part 


    /**
  *
  * => Previous part
  */ 
   $( document ).on('click',"a[id^='envirabox-left']",function () {
   var imgsrc=$("img[id^='envirabox-img']" ).attr('src');
   var names=imgsrc.split('/');
   _etracker.sendEvent(et_GalleryPreviousEvent(names[names.length-1]));
   /*ET_Event.galleryPrevious(names[names.length-1]);*/
   
});
   //*end  Previous part

/*
* ***************** @player for compact audio plugin **********************
*/
    $( "div[class^='sc_player_container']" ).children('input').click(function () {
    	 if ($(this).attr('class').indexOf('play')!=-1) {
        _etracker.sendEvent(et_AudioStartEvent('video'));
    	 	/*ET_Event.audioStart('video', '');*/
    	 } 
    	 else{
        _etracker.sendEvent(et_AudioPauseEvent('video'));
    	 	/*ET_Event.audioPause('video');*/
    	 }


    	 	
   	});

 

});

   

  