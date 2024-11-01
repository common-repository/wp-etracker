

var tag = document.createElement('script');
tag.src = "https://www.youtube.com/iframe_api";
var firstScriptTag = document.getElementsByTagName('script')[0];
firstScriptTag.parentNode.insertBefore(tag, firstScriptTag);

var iframee=document.getElementsByTagName("iframe");





var ide='trc-player';

for (var i =0; i < iframee.length; i++) {
  
  if (youtube_parser(iframee[i].src) > 0 || vimeo_parser(iframee[i].src) > 0 ) {
  iframee[i].id=ide+i; 
  }
  var url=iframee[i].src;
  var urlsapi=url+'&enablejsapi=1';
  if (youtube_parser(url) > 0) {
  iframee[i].src=urlsapi;
  }

  else if(vimeo_parser(iframee[i].src) > 0){
    iframee[i].src=url;
  }
}


var player ;


function onYouTubeIframeAPIReady() {
  for (var j =0; j <= iframee.length-1; j++) {
   
    if (youtube_parser(iframee[j].src)>0) {
    player = new YT.Player(ide+j, {
      width: 1,
      events: {
        'onReady': function(){

        },
        'onStateChange': function(event){
          switch(event.data) {
            case 0:
            $c=2;
            break;
            case 1: 
            _etracker.sendEvent(new et_VideoStartEvent(event.target.j.videoData.title));
            //ET_Event.videoStart(event.target.j.videoData.title);
            break;
            case 2:
            _etracker.sendEvent(new et_VideoPauseEvent(event.target.j.videoData.title));
            /*ET_Event.videoPause(event.target.j.videoData.title);*/
          }
        }
      }
    });
}
  }

}

for (var v =0; v < iframee.length; v++) {
  if ( vimeo_parser(iframee[v].src) > 0 ) {
     var iframe = document.getElementById(ide+v);
    var player = new Vimeo.Player(iframe);
    var title1;
    player.getVideoTitle().then(function(title) {
      title1=title;
    }).catch(function(error) {
     alert(error);
    });

    player.on('play', function() {
      _etracker.sendEvent(new et_VideoStartEvent(title1));
        /*ET_Event.videoStart(title1);*/
    });

    player.on('pause', function() {
      _etracker.sendEvent(new et_VideoPauseEvent(title1));
       /*ET_Event.videoPause(title1);*/
    });

  }
}


  
function youtube_parser(url){
  return url.indexOf("youtube");
}

function vimeo_parser(url){
  return url.indexOf("vimeo");
}
