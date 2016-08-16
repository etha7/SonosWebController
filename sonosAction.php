
<?php
  include 'sonosConstants.php';
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
