<?php

namespace App\interfaces;

interface DataProviderInterface
{
    /**
     * @param array $input
     * @return array
     */
    public function get(array $input): array;
}