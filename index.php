<html>
<head>
  <link rel="stylesheet" type="text/css" href="index.css">
  <title>Sonos Controller</title>
</head>
<body>
  <script>
    var currentVolume=20;
  </script>
  <div id="title"><div>Sonos Controller</div></div>
  <iframe id="sonosAction" style="display:none" src=""></iframe>
  <div id="buttonContainer">
    <div class="commandButton" onclick="sendCommand('play')">Play</div>
    <div class="commandButton" onclick="sendCommand('pause')">Pause</div>
    <div class="commandButton" onclick="sendCommand('previous')">&#9664Previous</div>
    <div class="commandButton" onclick="sendCommand('next')">Next&#9654</div>
    <div class="commandButton" onclick="sendCommand('volume', [currentVolume+=5])">Volume Up</div>
    <div class="commandButton" onclick="sendCommand('volume', [currentVolume-=5])">Volume Down</div>
  </div>
  <script>
    function sendCommand(cmd, args) {
        var url = "/sonosAction.php?cmd="+cmd;
        if(args != undefined)
          url +="&args="+encodeURIComponent(JSON.stringify(args));
        document.getElementById("sonosAction").src = url;
    }
    sendCommand('volume', [currentVolume]);
  </script>
</body>
</html>
