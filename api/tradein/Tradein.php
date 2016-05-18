<?php

namespace app\api\tradein;

use Phpro\SoapClient\Type\ResultInterface;

class Tradein implements ResultInterface
{

    /**
     * @var integer
     */
    protected $id;

    /**
     * @var string
     */
    protected $first_name;

    /**
     * @var string
     */
    protected $model;

    public function getFullName()
    {
        return $this->first_name.' '.$this->model;
    }

    public function __get($var){
        return uniqid();
    }

    public function getErrors(){
        return [];
    }
}