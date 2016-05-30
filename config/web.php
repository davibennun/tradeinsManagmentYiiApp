<?php

use app\api\clients\JomaShopClient;
use app\api\tradein\TradeinClient;
use app\components\SoapComponent;
use app\models\Tradein;
use kartik\datecontrol\Module;

$params = require(__DIR__ . '/params.php');

$config = [
    'id' => 'basic',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'defaultRoute'=>'tradein',
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
                      'stream_context' => stream_context_create( [ 'ssl' => ['verify_peer' => false, 'verify_peer_name' => false, 'allow_self_signed' => true] ] ),
                      'location' => 'https://tatooine.jomashop.com/index.php/api/v2_soap',
                      'uri' => 'urn:Mage_Api_Model_Server_V2_HandlerAction'
                  ],
                  'classMaps' => [['Tradein',Tradein::class]]
              ]
          ]
        ],
        'formatter' => [
            'dateFormat' => 'php:m-d-Y',
        ],
        'request' => [
            // !!! insert a secret key in the following (if it is empty) - this is required by cookie validation
            'cookieValidationKey' => 'MLhpvJ8BkGjA8Kc-9JjSubyny3f_P9Y-',
        ],
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        'user' => [
            'identityClass' => 'app\models\User',
            'enableAutoLogin' => true,
        ],
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
        'mailer' => [
            'class' => 'yii\swiftmailer\Mailer',
            // send all mails to a file by default. You have to set
            // 'useFileTransport' to false and configure a transport
            // for the mailer to send real emails.
            'useFileTransport' => true,
        ],
        'log' => [
            'traceLevel' => YII_DEBUG ? 3 : 0,
            'targets' => [
                [
                    'class' => 'yii\log\FileTarget',
                    'levels' => ['error', 'warning'],
                ],
            ],
        ],
        'db' => require(__DIR__ . '/db.php'),
        /*
        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'rules' => [
            ],
        ],
        */
    ],
    'params' => $params,
    'modules' => [
        'gridview' =>  [
            'class' => \kartik\grid\Module::class
        ],
        'datecontrol' =>  [
            'class' => 'kartik\datecontrol\Module',

            // format settings for displaying each date attribute (ICU format example)
            'displaySettings' => [
                Module::FORMAT_DATE => 'php:m-d-Y',
                Module::FORMAT_TIME => 'hh:mm:ss a',
                Module::FORMAT_DATETIME => 'dd-MM-yyyy hh:mm:ss a',
            ],

            // format settings for saving each date attribute (PHP format example)
            'saveSettings' => [
                Module::FORMAT_DATE => 'php:Y-m-d', // saves as unix timestamp
                Module::FORMAT_TIME => 'php:H:i:s',
                Module::FORMAT_DATETIME => 'php:Y-m-d H:i:s',
            ],

            // set your display timezone
            'displayTimezone' => 'America/New_York',

            // set your timezone for date saved to db
            'saveTimezone' => 'America/New_York',

            // automatically use kartik\widgets for each of the above formats
//            'autoWidget' => true,

            // default settings for each widget from kartik\widgets used when autoWidget is true
            'autoWidgetSettings' => [
//                Module::FORMAT_DATE => ['type'=>2, 'pluginOptions'=>['autoclose'=>true]], // example
                Module::FORMAT_DATETIME => [], // setup if needed
                Module::FORMAT_TIME => [], // setup if needed
            ],

            ]
    ],
];

if (YII_ENV_DEV) {
    // configuration adjustments for 'dev' environment
    $config['bootstrap'][] = 'debug';
    $config['modules']['debug'] = [
        'class' => 'yii\debug\Module',
    ];

    $config['bootstrap'][] = 'gii';
    $config['modules']['gii'] = [
        'class' => 'yii\gii\Module',
    ];
}

return $config;
