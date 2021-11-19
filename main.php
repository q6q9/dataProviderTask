<?php
/*
Предисловие:
  Разработчика попросили получить данные из стороннего сервиса.
  Данные необходимо было кешировать, ошибки логировать.
  Разработчик с задачей справился, ниже предоставлен его код.

Задание:
- Решение рабочее, но довольно грубое. Требуется доработать код так,
  чтобы можно было быстро добавить дополнительные звенья в цепочку вызова.
  Например чтобы вместо текущего "Cache -> Сторонний сервис", можно было сделать
  "Cache -> MySQL -> Сторонний сервис" без особых проблем.

- В целом, провести рефакторинг, основываясь, что актуальная версии php 8.0

(Готово решение завернуть в secret gist или какой-либо приватный репозиторий)
Решение:
*/

require_once "classes/base/ModifiedDataProvider.php";
require_once "classes/dataProviders/OutServiceDataProvider.php";
require_once "classes/modifiedDataProviders/CacheModifiedDataProvider.php";
require_once "classes/modifiedDataProviders/LoggerModifiedDataProvider.php";
require_once "classes/modifiedDataProviders/MySQLModifiedDataProvider.php";
require_once "interfaces/DataProviderInterface.php";
require_once "interfaces/ModifiedProviderInterface.php";

use App\classes\dataProviders\LoggerModifiedDataProvider;
use App\classes\dataProviders\MySQLModifiedDataProvider;
use App\classes\dataProviders\OutServiceDataProvider;
use App\classes\modifiedDataProviders\CacheModifiedDataProvider;


function main()
{
    $outServiceDataProvider = new OutServiceDataProvider('host', 'user', 'password');

    $mySQLModifiedDataProvider = new MySQLModifiedDataProvider(
        $outServiceDataProvider,
        ['db' => /* new mysqli */ array("example.com", "user", "password", "database")]
    );

    $cacheModifiedDataProvider = new CacheModifiedDataProvider(
        $mySQLModifiedDataProvider,
        ['cache' => [/*Объект CacheItemPoolInterface*/]]
    );

    $loggerModifiedDataProvider = new LoggerModifiedDataProvider(
        $cacheModifiedDataProvider,
        ['logger' => [/*Объект LoggerInterface*/]]
    );

    $result = $loggerModifiedDataProvider->get([/*Входные параметры*/]);
    var_dump($result);
}


main();