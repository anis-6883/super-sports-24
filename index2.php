<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <link href="https://vjs.zencdn.net/7.17.0/video-js.css" rel="stylesheet">
    <!-- ^^ video.js stylesheet ^^ -->
    <title>Video.JS test</title>
  </head>
  <body>
    <video autoplay controls id="player"
           class="video-js">
      <!-- <source src=> -->
    </video>

    <script src="https://vjs.zencdn.net/7.17.0/video.min.js"></script>
    <!-- ^^ video.js script ^^ -->
    <script type="text/javascript">
      var player = videojs('player')
      videojs.xhr({
        url: "https://s1.123zcast.com:8050/hls/ptvpk.m3u8",
        headers: {
          'Referer': 'https://123zcast.com/'
        }
      }, (err, response, body) => {
        if(err) throw err;
        if( response.statusCode === 200 ) {
          player.src(body)
        } else {
          console.error(response)
        }
      })
    </script>
  </body>
</html>
