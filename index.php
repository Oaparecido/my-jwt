#!/usr/bin/env php
<?php

require_once 'vendor/autoload.php';

use App\Lib\Jwt;
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

$verified->getMessage();
$payload->getMessage();
$payload->getCompleteMessage();
die();

echo "  \e[34m[--(* Expire Token *)--]\e[0m" . PHP_EOL;

$count = 0;
while ($count !== 6){
    $token = $object->refresh();

    sleep(1);

    if ($count % 2 === 0) {
        echo PHP_EOL;
        echo "  \e[33mRefresh Token...\e[0m" . PHP_EOL;
        sleep(2);

        $change = $object->verifyToken($token, $encrypt);

        if ($change) {
            echo "  [✅] Token modified!" . PHP_EOL;
        }
    }

    $count++;
}

