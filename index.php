#!/usr/bin/env php
<?php

require "app/Jwt.php";

$message = readline("Message: ");

$object = new Jwt([
    'message' => $message
]);

$encrypt = $object->sign();

echo "Message encrypted:" . $encrypt . PHP_EOL;

echo json_encode($object->validate($encrypt));
