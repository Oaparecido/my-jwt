<?php


namespace App\Messages;


use App\Lib\Jwt;

class Payload
{
    private $payload;

    public function __construct(array $payload)
    {
        $this->payload = $payload;
    }

    public function getMessage()
    {
        echo "  \e[34m[--(* Payload *)--]\e[0m";
        echo PHP_EOL;

        foreach ($this->payload as $key => $value) {
            echo "  [O] Key: -------- \e[36m['" . $key . "']\e[0m  " . PHP_EOL;
            echo "  [O] Message: ---- \e[36m['" . $value . "']\e[0m  " . PHP_EOL;
        }
    }

    public function getCompleteMessage() {

        echo PHP_EOL;
        $full_line = readline('  Show complete message!? (y/n) ');
        echo PHP_EOL;
        if ($full_line == 'y')
            foreach ($this->payload as $value)
                echo "  [O] Message: \e[36m'" . $value . "'\e[0m  " . PHP_EOL;

    }
}