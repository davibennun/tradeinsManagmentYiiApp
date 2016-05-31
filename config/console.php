<?php

use app\api\clients\JomaShopClient;
use app\components\SoapComponent;
use app\models\Tradein;

Yii::setAlias('@tests', dirname(__DIR__) . '/tests/codeception');

$params = require(__DIR__ . '/params.php');
$db = require(__DIR__ . '/db.php');

$config = [
    'id' => 'basic-console',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'controllerNamespace' => 'app\commands',
    'components' => [
        'soap' => [
            'class' => SoapComponent::class,
            'clients' => [
                [
                    'clientName' => JomaShopClient::class,
                    'wsdl' => null,
                    'options' => [
                        'cache_wsdl' => WSDL_CACHE_NONE,
                        'trace' => 1,
                        'stream_context' => stream_context_create(['ssl' => ['verify_peer' => false, 'verify_peer_name' => false, 'allow_self_signed' => true]]),
                        'location' => 'https://tatooine.jomashop.com/index.php/api/v2_soap',
                        'uri' => 'urn:Mage_Api_Model_Server_V2_HandlerAction'
                    ],
                    'classMaps' => [['Tradein', Tradein::class]]
                ]
            ]
        ],
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        'log' => [
            'targets' => [
                [
                    'class' => 'yii\log\FileTarget',
                    'levels' => ['error', 'warning'],
                ],
            ],
        ],
        'db' => $db,
    ],
    'params' => $params,
    /*
    'controllerMap' => [
        'fixture' => [ // Fixture generation command line.
            'class' => 'yii\faker\FixtureController',
        ],
    ],
    */
];

if (YII_ENV_DEV) {
    // configuration adjustments for 'dev' environment
    $config['bootstrap'][] = 'gii';
    $config['modules']['gii'] = [
        'class' => 'yii\gii\Module',
    ];
}

return $config;
