<?php

/* PLAY */
$URL_AV = 'http://192.168.1.143:1400/MediaRenderer/AVTransport/Control';
$BODY_PLAY = '<s:Envelope
    xmlns:s="http://schemas.xmlsoap.org/soap/envelope/"
    s:encodingStyle="http://schemas.xmlsoap.org/soap/encoding/">
    <s:Body>
        <u:Play
            xmlns:u="urn:schemas-upnp-org:service:AVTransport:1">
            <InstanceID>0</InstanceID>
            <Speed>1</Speed>
            </u:Play>
        </s:Body>
    </s:Envelope>';
$HEADERS_PLAY = array('CONNECTION: close', 'ACCEPT-ENCODING: gzip', 'HOST: 192.168.1.143:1400',
               'USER-AGENT: Linux UPnP/1.0 Sonos/32.11-30162 (WDCR:Microsoft Windows NT 6.1.7601 Service Pack 1)',
               'CONTENT-LENGTH: '.strlen($BODY_PLAY), 'CONTENT-TYPE: text/xml;charset="utf-8"',
               'X-SONOS-TARGET-UDN: uuid:RINCON_5CAAFD793EDC01400',
               'SOAPACTION: "urn:schemas-upnp-org:service:AVTransport:1#Play"'
               );

/* PAUSE */
$BODY_PAUSE = '<s:Envelope
    xmlns:s="http://schemas.xmlsoap.org/soap/envelope/"
    s:encodingStyle="http://schemas.xmlsoap.org/soap/encoding/">
    <s:Body>
        <u:Pause
            xmlns:u="urn:schemas-upnp-org:service:AVTransport:1">
            <InstanceID>0</InstanceID>
            <Speed>1</Speed>
            </u:Pause>
        </s:Body>
    </s:Envelope>';
$HEADERS_PAUSE = array('CONNECTION: close', 'ACCEPT-ENCODING: gzip', 'HOST: 192.168.1.143:1400',
               'USER-AGENT: Linux UPnP/1.0 Sonos/32.11-30162 (WDCR:Microsoft Windows NT 6.1.7601 Service Pack 1)',
               'CONTENT-LENGTH: '.strlen($BODY_PAUSE), 'CONTENT-TYPE: text/xml;charset="utf-8"',
               'X-SONOS-TARGET-UDN: uuid:RINCON_5CAAFD793EDC01400',
               'SOAPACTION: "urn:schemas-upnp-org:service:AVTransport:1#Pause"'
               );

/* SET VOLUME */
$BODY_VOLUME = '<s:Envelope
    xmlns:s="http://schemas.xmlsoap.org/soap/envelope/"
    s:encodingStyle="http://schemas.xmlsoap.org/soap/encoding/">
    <s:Body>
        <u:SetVolume
            xmlns:u="urn:schemas-upnp-org:service:AVTransport:1">
            <InstanceID>0</InstanceID>
            <Channel>Master</Channel>
            <DesiredVolume></DesiredVolume>
            </u:SetVolume>
        </s:Body>
    </s:Envelope>';
$HEADERS_VOLUME = array('CONNECTION: close', 'ACCEPT-ENCODING: gzip', 'HOST: 192.168.1.143:1400',
               'USER-AGENT: Linux UPnP/1.0 Sonos/32.11-30162 (WDCR:Microsoft Windows NT 6.1.7601 Service Pack 1)',
               'CONTENT-LENGTH: '.strlen($BODY_PAUSE), 'CONTENT-TYPE: text/xml;charset="utf-8"',
               'X-SONOS-TARGET-UDN: uuid:RINCON_5CAAFD793EDC01400',
               'SOAPACTION: "urn:schemas-upnp-org:service:AVTransport:1#Pause"'
               );
 ?>
