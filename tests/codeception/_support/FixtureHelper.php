<?php
namespace tests\codeception\_support;

use Codeception\Module;
use yii\test\FixtureTrait;
use app\models\Tradein;
use yii\test\InitDbFixture;
use tests\codeception\fixtures\TradeinFixture;
use saada\FactoryMuffin\FactoryInterface;


class FixtureHelper extends Module
{
    use FixtureTrait {
        loadFixtures as public;
        fixtures as public;
        globalFixtures as public;
        createFixtures as public;
        unloadFixtures as protected;
        getFixtures as public;
        getFixture as public;
    }
    /**
    * Method called before any suite tests run. Loads User fixture login user
    * to use in acceptance and functional tests.
    * @param array $settings
    */
    public function _beforeSuite($settings = [])
    {
        $this->loadFixtures();
    }

    /**
    * Method is called after all suite tests run
    */
    public function _afterSuite()
    {
        $this->unloadFixtures();
    }

    /**
    * @inheritdoc
    */
    public function fixtures()
    {
        return [
            'tradein' => [
                'class' => TradeinFixture::className(),
                'templateFile' => '@tests/codeception/templates/tradein.php'
            ]
            // Add your fixtures here
//            'objs '=> ['class'=>TradeinFixture::className()],  // access via key name
//            ['class'=>TradeinFixture::className()],     // no access via key name
        ];
    }

    /**
    * @inheritdoc
    */
    public function globalFixtures()
    {
        return [
            InitDbFixture::className(),
        ];
    }
}