#!/usr/bin/env php
<?php

class Jwt {

    private $payload = [];

    public function __construct(array $payload)
    {
        $this->payload = $payload;
    }

    public function randString()
    {
        $chars = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890!@#$%*()';
        $length_chars = strlen($chars);
        $rand_string = '';
        for ($i = 0; $i < 20; $i++) {
            $rand_string .= $chars[rand(20, $length_chars - 1)];
        }

        return $rand_string;
    }

    public function sign()
    {
        $secret = $this->randString();
        $header = base64_encode(json_encode(['alg' => 'SHA256', 'typ' => 'JWT']));
        $payload = base64_encode(json_encode($this->payload));
        $signature = $header . '.' . $payload . '.' . base64_encode($secret);

        $signature = str_replace('=', '', $signature);
        return $signature;
    }

    public function validate(string $credentials)
    {
        $credentials = explode('.', $credentials);

        $header = json_decode(base64_decode($credentials[0]), true);
        $payload = json_decode(base64_decode($credentials[1]), true);
        $secret = base64_decode($credentials[2]);

        $response = [
            'header' => $header,
            'payload'  => $payload,
            'secret' => $secret
        ];

        return $response;
    }
}
