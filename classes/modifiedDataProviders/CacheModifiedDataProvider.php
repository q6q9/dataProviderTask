<?php

namespace App\classes\modifiedDataProviders;

require_once "classes/base/ModifiedDataProvider.php";
require_once "interfaces/DataProviderInterface.php";

use App\classes\base\ModifiedDataProvider;
use App\interfaces\DataProviderInterface;
use DateTime;

/* use Psr\Cache\CacheItemPoolInterface; */

class CacheModifiedDataProvider extends ModifiedDataProvider
{
    private /* CacheItemPoolInterface; */ $cache;

    public function __construct(DataProviderInterface $dataProvider, array $params = null)
    {
        parent::__construct($dataProvider);
        $this->cache = $params['cache'];
    }

    public function get(array $input): array
    {
        $cacheKey = $this->getCacheKey($input);

        /*$cacheItem = $this->cache->getItem($cacheKey);
        if ($cacheItem->isHit()) {
            return $cacheItem->get();
        }*/
        if (rand(0, 1)) {
            return ['data from Cache'];
        }
        $result = $this->dataProvider->get($input);
        /*
        $cacheItem
            ->set($result)
            ->expiresAt(
                (new DateTime())->modify('+1 day')
            );
        */

        return $result;
    }

    public function getCacheKey(array $input)
    {
        return json_encode($input);
    }
}
