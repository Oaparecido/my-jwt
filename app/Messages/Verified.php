<?php

namespace App\Messages;

use App\Lib\Jwt;

class Verified
{
    private $verification;

    public function __construct(string $encrypt, Jwt $jwt)
    {
        $this->verification = $jwt->validate($encrypt);
    }

    public function getMessage()
    {
//        var_dump($this->verification);
        echo '|----------------------------|' . PHP_EOL;
        echo "|     \e[34m[--(* My JWT *)--]\e[0m     |" . PHP_EOL;
        echo '|----------------------------|' . PHP_EOL;
        echo '|                            |' . PHP_EOL;

        if ($this->verification['payload'])
            echo "| [✅] Payload: \e[92mVerified\e[0m     |" . PHP_EOL;
        else
            echo "| [🚨] Payload: \e[91mNot verified\e[0m |" . PHP_EOL;

        if ($this->verification['secret'])
            echo "| [✅] Secret:  \e[92mVerified\e[0m     |" . PHP_EOL;
        else
            echo "| [🚨] Secret:  \e[91mNot verified\e[0m |" . PHP_EOL;

        if ($this->verification['header'])
            echo "| [✅] Header:  \e[92mVerified\e[0m     |" . PHP_EOL;
        else
            echo "| [🚨] Header:  \e[91mNot verified\e[0m |" . PHP_EOL;

        echo '|                            |' . PHP_EOL;
        echo '|----------------------------|' . PHP_EOL . PHP_EOL . PHP_EOL;
    }

    /**
     * @return string|string[]|null
     */
    public function getEncrypt()
    {
        return $this->encrypt;
    }
}