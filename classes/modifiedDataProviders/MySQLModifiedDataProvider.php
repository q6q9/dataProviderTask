<?php

namespace App\classes\dataProviders;

require_once "classes/base/ModifiedDataProvider.php";
require_once "interfaces/DataProviderInterface.php";

use App\classes\base\ModifiedDataProvider;
use App\interfaces\DataProviderInterface;
/* use mysqli; */


class MySQLModifiedDataProvider extends ModifiedDataProvider
{
    private /* mysqli */ $db;

    public function __construct(DataProviderInterface $dataProvider, array $params = null)
    {
        parent::__construct($dataProvider);
        $this->db = $params['db'];
    }

    public function get(array $input): array
    {
        //$result = $this->db->query('SELECT * from table_name');
        $result = rand(0,1)?[]:['data from MySQL'];
        if ($result) {
            return $result; //$result->fetch_assoc();
        }
        return $this->dataProvider->get($input);
    }
}
