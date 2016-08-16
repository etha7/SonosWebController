<html>
<head>
  <link rel="stylesheet" type="text/css" href="index.css">
</head>
<body>
  <title>Sonos Controller</title>
  <div id="title"><div>Sonos Controller</div></div>
  <iframe id="sonosAction" style="display:none" src=""></iframe>
  <div id="buttonContainer">
    <div class="commandButton" onclick="sendCommand('play')">Play!</div>
    <div class="commandButton" onclick="sendCommand('pause')">Pause!</div>
  </div>
  <script>
    function sendCommand(cmd) {
      document.getElementById("sonosAction").src = "/sonosAction.php?cmd="+cmd;
    }
  </script>
</body>
</html>
