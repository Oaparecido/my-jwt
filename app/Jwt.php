#!/usr/bin/env php
<?php

class Jwt
{

    private $payload = [];

    private $secret = '';
    private $header = ['alg' => 'SHA256', 'typ' => 'JWT'];

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
        $this->secret = $this->randString();

        $this->payload = array_merge([
            'exp' => (new DateTime("now"))->getTimestamp(),
            'uid' => 1
        ], $this->payload);

        $header = base64_encode(json_encode($this->header));
        $payload = base64_encode(json_encode($this->payload));
        $secret = hash_hmac('sha256', $header . '.'. $payload, $this->secret, true);

        $signature = $header . '.' . $payload . '.' . base64_encode($secret);
        $signature = preg_replace('/[^a-zA-Z0-9".]/', '', $signature);

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

    public function refresh()
    {
        $token = '';
        for ($i = 0; $i < 3; $i++) {
            sleep(1);
            echo '  ' . ($i + 1) . '... ';

            if ($i === 2) {
                echo PHP_EOL;
                echo "  \e[33mRefresh Token...\e[0m" . PHP_EOL;
                sleep(2);
                $token = $this->sign();
            }
        }
        return $token;
    }

//    public function progressBar($done, $total, $info="", $width=50): string
//    {
//        $perc = round(($done * 100) / $total);
//        $bar = round(($width * $perc) / 100);
//        return sprintf("%s%%[%s>%s]%s\r", $perc, str_repeat("=", $bar), str_repeat(" ", $width-$bar), $info);
//    }
}
