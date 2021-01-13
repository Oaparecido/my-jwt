<?php


namespace App\Messages;


use App\Lib\Jwt;

class Payload
{
    private $payload;

    public function __construct(Jwt $jwt)
    {
        $this->payload = $jwt->getPayload();
        echo $this->payload;
        die();
    }

    public function getMessage()
    {
        $value_min = '';

        echo "  \e[34m[--(* Payload *)--]\e[0m";
        echo PHP_EOL;

        foreach ($this->payload as $key => $value) {
            if (strlen($value) >= 10)
                $value_min = substr($value, 0, 10) . '...';

            echo "  [O] Key: -------- \e[36m['" . $key . "']\e[0m  " . PHP_EOL;
            echo "  [O] Message: ---- \e[36m['" . $value_min . "']\e[0m  " . PHP_EOL;
        }
    }
}