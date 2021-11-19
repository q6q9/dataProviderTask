<?php

namespace App\classes\base;

require_once "interfaces/DataProviderInterface.php";
require_once "interfaces/ModifiedProviderInterface.php";

use App\interfaces\DataProviderInterface;
use App\interfaces\ModifiedProviderInterface;

class ModifiedDataProvider implements DataProviderInterface, ModifiedProviderInterface
{
    protected DataProviderInterface $dataProvider;

    public function __construct(DataProviderInterface $dataProvider, array $params = null)
    {
        $this->dataProvider = $dataProvider;
    }

    public function get(array $input): array
    {
        return $this->dataProvider->get($input);
    }
}