#!/usr/bin/env php
<?php

require_once 'vendor/autoload.php';

use App\Lib\Jwt;
use App\Messages\Expire;
use App\Messages\Payload;
use App\Messages\Verified;

$message = readline('Message: ');

$object = new Jwt([
    'message' => $message
]);

$encrypt = $object->sign();
$verification = $object->validate($encrypt);
$payload_credential = $object->getPayload($encrypt);

$verified = new Verified($verification);
$payload = new Payload($payload_credential);
$expire = new Expire();

$verified->getMessage();
$payload->getMessage();
$payload->getCompleteMessage();
die();

echo "  \e[34m[--(* Expire Token *)--]\e[0m" . PHP_EOL;

$count = 0;
while ($count !== 6){
    $token = $object->refresh();

    $expire->getMessage($count, $token, $encrypt);

    $count++;
}

