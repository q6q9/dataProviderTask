<?php

namespace App\classes\dataProviders;

require_once "classes/base/ModifiedDataProvider.php";
require_once "interfaces/DataProviderInterface.php";

use App\classes\base\ModifiedDataProvider;
use App\interfaces\DataProviderInterface;
use Exception;
use Psr\Log\LoggerInterface;

/**
 * Поставщик данных модифицирующий другой поставщик данных логированием ошибок
 */
class LoggerModifiedDataProvider extends ModifiedDataProvider
{
    /**
     * @var LoggerInterface|mixed
     */
    private LoggerInterface $logger;

    /**
     * @param DataProviderInterface $dataProvider
     * @param array|null $params
     */
    public function __construct(DataProviderInterface $dataProvider, array $params = null)
    {
        parent::__construct($dataProvider);
        $this->logger = $params['logger'];
    }

    /**
     * Получить данные из $dataProvider, в случае ошибки происходит ее логирование
     *
     * @param array $input
     * @return array
     */
    public function get(array $input): array
    {
        try {
            return $this->dataProvider->get($input);
        } catch (Exception $e) {
            $this->logger->critical('Error');
            return [];
        }
    }
}
