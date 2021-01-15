<?php


namespace App\Messages;


use App\Lib\Jwt;

class Expire
{
    private $object;

    public function __construct()
    {
        $this->object = new Jwt();
    }

    public function getMessage($count, $token, $encrypt)
    {
        sleep(1);

        if ($count % 2 === 0) {
            echo PHP_EOL;
            echo "  \e[33mRefresh Token...\e[0m" . PHP_EOL;
            sleep(2);

            $change = $this->object->verifyToken($token, $encrypt);

            if ($change) {
                echo "  [✅] Token modified!" . PHP_EOL;
            }
        }
    }
}