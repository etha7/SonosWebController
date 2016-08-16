<html>
<head>
  <link rel="stylesheet" type="text/css" href="index.css">
</head>
<body>
  <script>
    var currentVolume=50;
  </script>
  <title>Sonos Controller</title>
  <div id="title"><div>Sonos Controller</div></div>
  <iframe id="sonosAction" style="display:none" src=""></iframe>
  <div id="buttonContainer">
    <div class="commandButton" onclick="sendCommand('play')">Play</div>
    <div class="commandButton" onclick="sendCommand('pause')">Pause</div>
    <div class="commandButton" onclick="sendCommand('previous')">&#9664Previous</div>
    <div class="commandButton" onclick="sendCommand('next')">Next&#9654</div>
    <div class="commandButton" onclick="sendCommand('volume', currentVolume)">Volume Up</div>
  </div>
  <script>
    function sendCommand(cmd, args) {
      if(arguments.length == 2)
      {
        var argsString = encodeURIComponent(JSON.stringify(args));
        document.getElementById("sonosAction").src = "/sonosAction.php?cmd="+cmd+"&args="+argsString;
      }else{
        document.getElementById("sonosAction").src = "/sonosAction.php?cmd="+cmd;
      }

    }
    sendCommand('volume', [currentVolume]);
  </script>
</body>
</html>
