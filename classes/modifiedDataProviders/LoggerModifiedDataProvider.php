<?php

namespace App\classes\dataProviders;

require_once "classes/base/ModifiedDataProvider.php";
require_once "interfaces/DataProviderInterface.php";

use App\classes\base\ModifiedDataProvider;
use App\interfaces\DataProviderInterface;
use Exception;
/*  use Psr\Log\LoggerInterface;*/


class LoggerModifiedDataProvider extends ModifiedDataProvider
{
    private /* LoggerInterface */ $logger;

    public function __construct(DataProviderInterface $dataProvider, array $params = null)
    {
        parent::__construct($dataProvider);
        $this->logger = $params['logger'];
    }

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
