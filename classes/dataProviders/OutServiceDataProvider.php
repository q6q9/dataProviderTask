<?php

namespace App\classes\dataProviders;

use App\interfaces\DataProviderInterface;

/**
 * Поставщик данных из стороннего сервиса
 */
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
     * Получить данные из стороннего сервиса.
     *
     * @param array $input
     * @return array|string[]
     */
    public function get(array $input): array
    {
        // returns a response from external service
    }
}