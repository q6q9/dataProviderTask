<?php

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
        ['db' => new mysqli("example.com", "user", "password", "database")]
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
}


main();