<?php

namespace common\api\requests;


use Phpro\SoapClient\Type\RequestInterface;

class TradeinFormInfoPaginatedRequest implements RequestInterface{

    /**
     * @var \SoapParam
     */
    public $sessionId;

    /**
     * @var \SoapParam
     */
    public $startingTradeinFormId;

    /**
     * @var \SoapParam
     */
    public $endingTradeinFormId;

    /**
     * @var \SoapParam
     */
    public $pageSize;

    /**
     * @var \SoapParam
     */
    public $pageNumber;

    public function __construct($sessionId, $startingTradeinForm, $endingTradeinFormId, $pageSize, $pageNumber)
    {
        $this->sessionId = new \SoapParam($sessionId, 'sessionId');
        $this->startingTradeinFormId = new \SoapParam($startingTradeinForm, 'startingTradeinFormId');
        $this->endingTradeinFormId = new \SoapParam($endingTradeinFormId, 'endingTradeinFormId');
        $this->pageSize = new \SoapParam($pageSize, 'pageSize');
        $this->pageNumber = new \SoapParam($pageNumber, 'pageNumber');
    }

    /**
     * @param \SoapParam $startingTradeinFormId
     */
    public function setStartingTradeinFormId($startingTradeinFormId)
    {
        $this->startingTradeinFormId = new \SoapParam($startingTradeinFormId, 'startingTradeinFormId');
    }

}