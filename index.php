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

$verified = new Verified($encrypt, (new Jwt()));
$verified->getMessage();
die();
$payload = new Payload($object);
$payload->getMessage();
//$encrypt = $object->sign();
//$verification = $object->validate($encrypt);
//$payload = $object->getPayload($encrypt);
die();

echo "  \e[34m[--(* Payload *)--]\e[0m" . PHP_EOL;
echo PHP_EOL;

foreach ($payload as $key => $value) {
    if (strlen($value) >= 10)
        $value_min = substr($value, 0, 10) . '...';

    echo "  [O] Key: -------- \e[36m['" . $key . "']\e[0m  " . PHP_EOL;
    echo "  [O] Message: ---- \e[36m['" . $value_min . "']\e[0m  " . PHP_EOL;

}

echo PHP_EOL;
$full_line = readline('  Show complete message!? (y/n) ');
echo PHP_EOL;
if ($full_line == 'y')
    foreach ($payload as $value)
        echo "  [O] Message: \e[36m'" . $value . "'\e[0m  " . PHP_EOL;

echo PHP_EOL . PHP_EOL;
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

