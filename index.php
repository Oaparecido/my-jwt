#!/usr/bin/env php
<?php

require_once 'vendor/autoload.php';

use App\Lib\Jwt;

$message = readline('Message: ');

$object = new Jwt([
    'message' => $message
]);

$encrypt = $object->sign();
$verification = $object->validate($encrypt);
$payload = $object->getPayload($encrypt);

echo '|----------------------------|' . PHP_EOL;
echo "|     \e[34m[--(* My JWT *)--]\e[0m     |" . PHP_EOL;
echo '|----------------------------|' . PHP_EOL;
echo '|                            |' . PHP_EOL;

if ($verification['payload'])
    echo "| [✅] Payload: \e[92mVerified\e[0m     |" . PHP_EOL;
else
    echo "| [🚨] Payload: \e[91mNot verified\e[0m |" . PHP_EOL;

if ($verification['secret'])
    echo "| [✅] Secret:  \e[92mVerified\e[0m     |" . PHP_EOL;
else
    echo "| [🚨] Secret:  \e[91mNot verified\e[0m |" . PHP_EOL;

if ($verification['secret'])
    echo "| [✅] Header:  \e[92mVerified\e[0m     |" . PHP_EOL;
else
    echo "| [🚨] Header:  \e[91mNot verified\e[0m |" . PHP_EOL;

echo '|                            |' . PHP_EOL;
echo '|----------------------------|' . PHP_EOL . PHP_EOL . PHP_EOL;

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

