<?php


namespace app\components;


/**
 * Interface MapperInterface
 * @package app\components
 */
interface MapperInterface {


    /**
     * @param mixed $result
     * @return mixed
     */
    public function map($result);


}