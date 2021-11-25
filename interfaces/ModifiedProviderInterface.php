<?php

namespace App\interfaces;

interface ModifiedProviderInterface
{
    /**
     * @param DataProviderInterface $dataProvider
     * @param array|null $params
     */
    public function __construct(DataProviderInterface $dataProvider, array $params = null);
}