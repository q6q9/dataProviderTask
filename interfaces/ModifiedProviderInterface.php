<?php

namespace App\interfaces;

interface ModifiedProviderInterface
{
    public function __construct(DataProviderInterface $dataProvider, array $params = null);
}