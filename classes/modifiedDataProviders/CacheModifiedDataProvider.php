<?php

namespace App\classes\modifiedDataProviders;

require_once "classes/base/ModifiedDataProvider.php";
require_once "interfaces/DataProviderInterface.php";

use App\classes\base\ModifiedDataProvider;
use App\interfaces\DataProviderInterface;
use DateTime;
use Psr\Cache\CacheItemPoolInterface;


/**
 * Поставщик данных модифицирующий другой поставщик данных загрузкой и сохранением данных в кэш
 */
class CacheModifiedDataProvider extends ModifiedDataProvider
{
    /**
     * @var CacheItemPoolInterface
     */
    private CacheItemPoolInterface $cache;

    /**
     * @param DataProviderInterface $dataProvider
     * @param array|null $params
     */
    public function __construct(DataProviderInterface $dataProvider, array $params = null)
    {
        parent::__construct($dataProvider);
        $this->cache = $params['cache'];
    }

    /**
     * Получить данные из кэша если они актуальные, иначе получить, записать в кэш и вернуть данные из $dataProvider
     *
     * @param array $input
     * @return array
     */
    public function get(array $input): array
    {
        $cacheKey = $this->getCacheKey($input);
        $cacheItem = $this->cache->getItem($cacheKey);
        if ($cacheItem->isHit()) {
            return $cacheItem->get();
        }

        $result = $this->dataProvider->get($input);

        $cacheItem
            ->set($result)
            ->expiresAt(
                (new DateTime())->modify('+1 day')
            );

        return $result;
    }

    /**
     * @param array $input
     * @return false|string
     */
    public function getCacheKey(array $input)
    {
        return json_encode($input);
    }
}
