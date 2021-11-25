<?php

namespace App\classes\base;

require_once "interfaces/DataProviderInterface.php";
require_once "interfaces/ModifiedProviderInterface.php";

use App\interfaces\DataProviderInterface;
use App\interfaces\ModifiedProviderInterface;

/**
 * Базовый класс - Поставщик данных модифицирующий другой поставщик данных
 */
class ModifiedDataProvider implements DataProviderInterface, ModifiedProviderInterface
{
    /**
     * @var DataProviderInterface
     */
    protected DataProviderInterface $dataProvider;

    /**
     * @param DataProviderInterface $dataProvider
     * @param array|null $params
     */
    public function __construct(DataProviderInterface $dataProvider, array $params = null)
    {
        $this->dataProvider = $dataProvider;
    }

    /**
     * @param array $input
     * @return array
     */
    public function get(array $input): array
    {
        return $this->dataProvider->get($input);
    }
}