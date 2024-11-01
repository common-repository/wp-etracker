
var a=document.getElementsByTagName("video");

for (var i = 0; i<a.length; i++) {
	a[0].addEventListener("play", function(){
		
		_etracker.sendEvent(new et_VideoStartEvent(a[0].id));
		//ET_Event.videoStart('Demo', 'Vid');

	});
	a[0].addEventListener("pause", function(){
		_etracker.sendEvent(new et_VideoPauseEvent(a[0].id));
	});
}
function trc_url_extension(urle){

	var v=urle.split('.');
	var extension=['AIFF','AIF','AU','AVI','BAT','BMP','CLASS', 'JAVA','CSV','CVS','DBF','DIF','DOC' ,'DOCX',
	'EPS','EXE','FM3','GIF','HQX','HTM' ,'HTML','MAC','MAP','MDB','MID' ,'MIDI',
	'MOV' ,'QT','MTB', 'MTW','PDF','P65','T65','PNG','PPT' ,'PPTX','PSD','PSP','QXD','RA',
	'RTF','SIT','TAR','TIF','TXT','WAV','WK3','WKS','WPD' ,'WP5','XLS' ,'XLSX','ZIP'];

	var searchfor=v[v.length-1].toUpperCase();

	if ( extension.indexOf(searchfor) != -1 ) {
		return true;
	}
	else{
		return false;
	}

	
}


var linksw=document.getElementsByTagName('a');
var datal={};
j=0;
for (var i =0 ; i <  linksw.length ; i++) {
	var hrefi=linksw[i].href;

	if ( trc_url_extension(linksw[i].href) == true ) {
		datal[j]={
			index : linksw[i],
			html : linksw[i].innerHTML, 
		};
		j++;

	}
}

for (var d=0;d<j;d++){
	var s=datal[d].html;
	
	datal[d].index.addEventListener("click", function(s){
		//ET_Event.download();
		_etracker.sendEvent(et_DownloadEvent(this.innerHTML));
	
	});
}

jQuery(document).ready(function($){
	
  $( "a[class^='wpdm-download-']" ).click(function () {
  	var link=$(this).attr('onclick').substring(15).split("'");   
   //ET_Event.galleryView(link[0]);
   _etracker.sendEvent(et_GalleryViewEvent(link[0]));
   
});
})