
<?php
  include 'sonosConstants.php';
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
        
        default:
          $validCommand = false;
          echo("<script>alert('Sonos command \"$cmd\" not supported!')</script>");
      }

      if($validCommand)
      {
        $c = curl_init($url);
        curl_setopt($c, CURLOPT_POST, 1);
        curl_setopt($c, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($c, CURLOPT_POSTFIELDS, $body);
        $response = curl_exec($c);
        curl_close($c);
      }
 }
?>
