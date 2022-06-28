// https://developers.google.com/youtube/player_parameters#Manual_IFrame_Embeds

// Load the IFrame Player API code asynchronously.
var tag = document.createElement('script');
tag.src = "https://www.youtube.com/player_api";
var firstScriptTag = document.getElementsByTagName('script')[0];
firstScriptTag.parentNode.insertBefore(tag, firstScriptTag);

// Replace the 'ytplayer' element with an <iframe> and
// YouTube player after the API code downloads.
var player,
    players = [],
    flexsliderInit = false;

function onYouTubePlayerAPIReady() {
//  player = new YT.Player('js-youtube_1');
  players[0] = new YT.Player('js-youtube_1');
  players[0].addEventListener('onStateChange', 'funcListener');
  if ( ! flexsliderInit ) {
    initFlexslider();
  }
}

function funcListener(event){
  console.log('funcListener');
  console.log(event.data);
  if (event.data === -1 || event.data === 1 ){
    console.log('buffering / playing');
  }
  else if (event.data === 2 || event.data === 0){
    console.log('paused / stopped');
  }
}

function initFlexslider() {
  flexsliderInit = true;
  console.log('--------------');
  console.log('initFlexslider');
  // Call fitVid before FlexSlider initializes, so the proper initial height can be retrieved.
  $(".flexslider")
    .fitVids()
    .flexslider({
      animation: "slide",
      video: true,
      useCSS: false,
      //    smoothHeight: true,
      slideshowSpeed: 3000,
      pauseOnHover: true,
      before: function(slider) {
//        console.log('-----------------------');
//        console.log('flexslider BEFORE fired');
        pausePlayers();
      }
    });
}


function flexsliderPause() {
  console.log('---------------');
  console.log('flexsliderPause');
  $(".flexslider").flexslider("pause");
}

function flexsliderPlay() {
  console.log('--------------');
  console.log('flexsliderPlay');
  $(".flexslider").flexslider("play");
}

function pausePlayers() {
  console.log('------------');
  console.log('pausePlayers');
  players[0].pauseVideo();
/*  for (key in players) {
    players[0].pauseVideo();
  }*/
/*  for (key in vimeoPlayers) {
    vimeoPlayers[key].api('pause');
  }*/
}