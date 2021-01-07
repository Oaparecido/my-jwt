#!/usr/bin/env php
<?php

require 'app/Jwt.php';

$message = readline('Message: ');

$object = new Jwt([
    'message' => $message
]);

$encrypt = $object->sign();
$verification = $object->validate($encrypt);
$payload = $object->getPayload($encrypt);

echo '|----------------------------|' . PHP_EOL;
echo '|     --[(* My JWT *)]--     |' . PHP_EOL;
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
echo '|----------------------------|' . PHP_EOL . PHP_EOL;

echo '|----------------------------|' . PHP_EOL;
echo '|    --[(* Payload *)]--     |' . PHP_EOL;
echo '|----------------------------|' . PHP_EOL;
echo '|                            |' . PHP_EOL;

foreach ($payload as $key => $value) {
    if (strlen($value) >= 5)
        $value_min = substr($value, 0, 4) . '...';

    echo "| Key: -------- \e[36m['" . $key . "']\e[0m  |" . PHP_EOL;
    echo "| Message: ---- \e[36m['" . $value_min . "']\e[0m  |" . PHP_EOL;

}

echo '|                            |' . PHP_EOL;
echo '|----------------------------|' . PHP_EOL . PHP_EOL;

$full_line = readline('  Full line ? (y/n) ');

if ($full_line == 'y')
    foreach ($payload as $value)
        echo "  Message: \e[36m'" . $value . "'\e[0m  " . PHP_EOL;