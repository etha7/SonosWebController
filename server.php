<html>
<body>
  <title>Sonos Controller</title>
  <iframe id="sonosAction" style="display:none" src=""></iframe>
  <div onclick="sendCommand('play')">Play!</div>
  <div onclick="sendCommand('pause')">Pause!</div>
  <script>
    function sendCommand(cmd) {
      document.getElementById("sonosAction").src = "http://localhost/sonosAction.php?cmd="+cmd;
    }
  </script>
</body>
</html>
