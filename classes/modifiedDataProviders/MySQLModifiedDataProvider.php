<?php

namespace App\classes\dataProviders;

require_once "classes/base/ModifiedDataProvider.php";
require_once "interfaces/DataProviderInterface.php";

use App\classes\base\ModifiedDataProvider;
use App\interfaces\DataProviderInterface;
use mysqli;

/**
 * Поставщик данных модифицирующий другой поставщик данных,
 * который возвращает (при успехе) данные из БД MySQL,
 * иначе данныеиз $dataProvider
 */
class MySQLModifiedDataProvider extends ModifiedDataProvider
{
    /**
     * @var mysqli
     */
    private mysqli $db;

    /**
     * @param DataProviderInterface $dataProvider
     * @param array|null $params
     */
    public function __construct(DataProviderInterface $dataProvider, array $params = null)
    {
        parent::__construct($dataProvider);
        $this->db = $params['db'];
    }

    /**
     * Получить данные (при успехе) из БД MySQL, иначе из $dataProvider
     *
     * @param array $input
     * @return array
     */
    public function get(array $input): array
    {
        $result = $this->db->query('SELECT * from table_name');
        if ($result) {
            $result->fetch_assoc();
        }
        return $this->dataProvider->get($input);
    }
}
