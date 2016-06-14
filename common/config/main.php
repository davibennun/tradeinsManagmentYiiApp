<?php
use common\api\clients\JomaShopClient;
use common\api\components\SoapComponent;
use common\models\Tradein;

return [
    'vendorPath' => dirname(dirname(__DIR__)) . '/vendor',
    'components' => [
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
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
                        'location' => true ? 'https://jomashop.com/index.php/api/v2_soap' : 'https://tatooine.jomashop.com/index.php/api/v2_soap',
                        'uri' => 'urn:Mage_Api_Model_Server_V2_HandlerAction'
                    ],
                    'classMaps' => [['Tradein', Tradein::class]]
                ]
            ]
        ],
    ],
];
