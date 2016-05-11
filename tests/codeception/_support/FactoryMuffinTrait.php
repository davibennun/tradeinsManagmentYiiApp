<?php
namespace tests\codeception\_support;

use saada\FactoryMuffin\FactoryMuffin;

trait FactoryMuffinTrait
{

    protected static $factoryMuffinInstance;

    public function fm()
    {
        if (!static::$factoryMuffinInstance)
            static::$factoryMuffinInstance = new FactoryMuffin($this->getModelDefinitions());

        return static::$factoryMuffinInstance;
    }

}