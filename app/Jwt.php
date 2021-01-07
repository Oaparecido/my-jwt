#!/usr/bin/env php
<?php

class Jwt {

    private $payload = [];
    private $secret = '';
    private $header = ['alg' => 'SHA256', 'typ' => 'JWT'];

    public function __construct(array $payload)
    {
        $this->payload = $payload;
        $this->secret = $this->randString();
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
        $secret = $this->secret;
        $header = base64_encode(json_encode($this->header));
        $payload = base64_encode(json_encode($this->payload));
        $signature = $header . '.' . $payload . '.' . base64_encode($secret);

        $signature = str_replace('=', '', $signature);
        return $signature;
    }

    public function validate(string $credentials): array
    {
        $credentials = explode('.', $credentials);

        $header = json_decode(base64_decode($credentials[0]), true);
        $payload = json_decode(base64_decode($credentials[1]), true);
        $secret = base64_decode($credentials[2]);

        $response = [
            'header' => true,
            'payload' => true,
            'secret' => true,
        ];

        if ($payload !== $this->payload)
            $response['payload'] = false;
        if ($secret !== $this->secret)
            $response['secret'] = false;
        if ($header !== $this->header)
            $response['header'] = false;

        return $response;
    }

    public function getPayload(string $credentials)
    {
        $credentials = explode('.', $credentials);

        return json_decode(base64_decode($credentials[1]), true);
    }
}
