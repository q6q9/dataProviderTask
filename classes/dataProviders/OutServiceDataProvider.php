<?php

namespace App\classes\dataProviders;

use App\interfaces\DataProviderInterface;


class OutServiceDataProvider implements DataProviderInterface
{
    private $host;
    private $user;
    private $password;

    /**
     * @param $host
     * @param $user
     * @param $password
     */
    public function __construct($host, $user, $password)
    {
        $this->host = $host;
        $this->user = $user;
        $this->password = $password;
    }

    /**
     * @param array $input
     *
     * @return array
     */
    public function get(array $input): array
    {
        return rand(0,1)?[]:['data from Out'];// returns a response from external service
    }
}