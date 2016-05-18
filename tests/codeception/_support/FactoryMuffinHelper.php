<?php
namespace tests\codeception\_support;

use Codeception\Module;
use saada\FactoryMuffin\FactoryMuffin;

class FactoryMuffinHelper extends Module
{

    protected static $factoryMuffinInstance;

    public function fm()
    {
        if (!static::$factoryMuffinInstance)
            static::$factoryMuffinInstance = new FactoryMuffin($this->getModelDefinitions());

        return static::$factoryMuffinInstance;
    }

}