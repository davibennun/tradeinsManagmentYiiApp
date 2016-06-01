<?php


namespace common\api\components;


/**
 * Interface MapperInterface
 * @package components
 */
interface MapperInterface {


    /**
     * @param mixed $result
     * @return mixed
     */
    public function map($result);


}