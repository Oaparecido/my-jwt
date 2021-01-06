#!/usr/bin/env php
<?php

require "app/Jwt.php";

$message = readline("Message: ");


$object = new Jwt([
    'message' => $message
]);

echo $object->sign();
