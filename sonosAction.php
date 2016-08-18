
<?php
  include 'sonosConstants.php';
  error_reporting(E_ALL ^ E_WARNING);
  function str_insert($str, $search, $insert){
    $index = strpos($str, $search);
    if($index === false){
        return $str;
    }
    return substr_replace($str, $search.$insert, $index, strlen($search));
  }

  $validCommand = true;
  if(isset($_GET['cmd']))
  {
      $cmd = $_GET['cmd'];
      switch($cmd) {
        case 'play':
          $url = $URL_AV;
          $body = $BODY_PLAY;
          $headers = $HEADERS_PLAY;
          break;
        case 'pause':
          $url = $URL_AV;
          $body = $BODY_PAUSE;
          $headers = $HEADERS_PAUSE;
          break;
        case 'next':
          $url = $URL_AV;
          $body = $BODY_NEXT;
          $headers = $HEADERS_NEXT;
          break;
        case 'previous':
          $url = $URL_AV;
          $body = $BODY_PREVIOUS;
          $headers = $HEADERS_PREVIOUS;
          break;
        case 'volume':
          $url = $URL_RENDER;
          $body = $BODY_VOLUME;
          $headers = $HEADERS_VOLUME;
          $args = json_decode($_GET['args']);
          $body = str_insert($body, '<DesiredVolume>', $args[0]);
          $index = array_search("CONTENT-LENGTH: ", $headers);
          $headers[$index] = $headers[$index].strlen($body);
          break;
        case 'discover':
          $validCommand = false;

          //Set connection data
          $multicast_address = "239.255.255.250";
          $local_address = "192.168.1.110";
          //$multicast_address = "233.0.0.0";

          $to_port = 1900;
          $from_port = 1901;
          $sock = socket_create(AF_INET, SOCK_DGRAM, SOL_UDP);
          socket_set_option($sock, SOL_SOCKET, SO_BROADCAST,1);

          //Search for valid port starting from 1901 inclusive
          $invalidPort = true;
          while($invalidPort){
            if(socket_bind($sock, $local_address, $from_port))
              $invalidPort= false;
            else
              $from_port++;
          }

          //Create  and send discovery UDP request
          $buffer = "M-SEARCH * HTTP/1.1\r\nHOST: $multicast_address\r\nMAN:  \"ssdp:discover\"\r\nMX: 1\r\nST: upnp:rootdevice\r\n\r\n";
          $r = socket_sendto($sock, $buffer, strlen($buffer), 0, $multicast_address, $to_port);

          //Listen on local address's port 1900 for return
          $matches = array();
          $notFound = true;
          while($notFound){
            socket_recvfrom($sock, $receiveBuffer, 800, 0, $local_address, $from_port);
            preg_match("/LOCATION: http:\/\/(\d*\.\d*\.\d*\.\d*:\d*).*Sonos.*/s",$receiveBuffer,$matches);
            if(count($matches) >= 2)
              $notFound = false;
          }
          echo($matches[1]);
          break;
        default:
          $validCommand = false;
          //echo("<script>alert('Sonos command \"$cmd\" not supported!')</script>");
      }

      if($validCommand)
      {
        $url = 'http://'.$_GET['ip'].$url;
        $c = curl_init($url);
        curl_setopt($c, CURLOPT_POST, 1);
        curl_setopt($c, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($c, CURLOPT_POSTFIELDS, $body);
        $response = curl_exec($c);
        curl_close($c);
      }
 }
?>
