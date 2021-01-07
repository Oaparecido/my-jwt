#!/usr/bin/env php
<?php

require "app/Jwt.php";

$message = readline("Message: ");

$object = new Jwt([
    'message' => $message
]);

$encrypt = $object->sign();

echo "" . PHP_EOL;
echo "Message encrypted:" . $encrypt . PHP_EOL;

if ($object->validate($encrypt))
    echo "\e[92mVerified" . PHP_EOL;
