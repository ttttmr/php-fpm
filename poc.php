<?php
$client = stream_socket_client('unix:///run/php/php7.3-fpm.sock', $errno, $errstr);
if (!$client) {
        $client = stream_socket_client('tcp://127.0.0.1:9000', $errno, $errstr);
        if (!$client) {
                die("connect to server fail: $errno - $errstr");
        }
}

$payload = file_get_contents('payload.txt');
fwrite($client, $payload);
$re = fread($client, 1024);
echo $re;
fclose($client);
