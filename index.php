<html>
<head>
  <link rel="stylesheet" type="text/css" href="index.css">
  <title>Sonos Controller</title>
</head>
<body>
  <div id="title"><div>Sonos Controller</div></div>
  <div id="buttonContainer">
    <div class="commandButton" onclick="sendCommand('play')">Play</div>
    <div class="commandButton" onclick="sendCommand('pause')">Pause</div>
    <div class="commandButton" onclick="sendCommand('previous')">&#9664 Previous</div>
    <div class="commandButton" onclick="sendCommand('next')">Next &#9654</div>
    <div class="commandButton" onclick="sendCommand('volume', [currentVolume+=5])">Volume Up</div>
    <div class="commandButton" onclick="sendCommand('volume', [currentVolume-=5])">Volume Down</div>
    <div class="commandButton" onclick="sendCommand('discover', undefined, setIP)">Discover New Device</div>
  </div>
  <div id="ip">
  </div>
  <script>
    var currentVolume=20;
    var ip = null;

    sendCommand('discover', undefined, setIP);
    sendCommand('volume', [currentVolume]);
    function sendCommand(cmd, args, func)
    {
          var url = "sonosAction.php"
          if (args != undefined) args = encodeURIComponent(JSON.stringify(args));
          else args = "";
          if(func == undefined) func = function(){};
          get(url, {"cmd": cmd, "args": args, "ip": ip}, func);
    }

    function get(url, data, callback) {
      var dataString = ""
      for (key in data) dataString += key + "=" + data[key] + "&"

      var r = new XMLHttpRequest()
      r.open("GET", url + "?" + dataString, true)
      r.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
      r.onreadystatechange = function() {
        if (r.readyState == 4 && callback != undefined) callback(r.responseText)
      }
      r.send()
    }
    function setIP(response){
      ip = response;
      document.getElementById('ip').innerHTML = "The IP of the current Sonos speaker is "+ip;
    }

  </script>
</body>
</html>
