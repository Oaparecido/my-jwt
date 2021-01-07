#!/usr/bin/env php
<?php

require "app/Jwt.php";

$message = readline("Message: ");

$object = new Jwt([
    'message' => $message
]);

$encrypt = $object->sign();

echo "|----------------------------|" . PHP_EOL;
echo "|     --[(* My JWT *)]--     |" . PHP_EOL;
echo "|----------------------------|" . PHP_EOL;
echo "|                            |" . PHP_EOL;

if ($object->validate($encrypt))
    echo "| [✅] Payload: \e[92mVerified\e[0m     |" . PHP_EOL;
else
    echo "| [🚨] Payload: \e[91mNot verified\e[0m |" . PHP_EOL;

echo "| [🚨] Header:  \e[91mNot verified\e[0m |" . PHP_EOL;
echo "| [🚨] Secret:  \e[91mNot verified\e[0m |" . PHP_EOL;
echo "|                            |" . PHP_EOL;
echo "|----------------------------|" . PHP_EOL;