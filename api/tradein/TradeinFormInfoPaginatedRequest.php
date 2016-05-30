<?php


namespace app\api\tradein;


use Phpro\SoapClient\Type\RequestInterface;

class TradeinFormInfoPaginatedRequest implements RequestInterface{

    public $sessionId;

    public $startingTradeinFormId;

    public $endingTradeinFormId;

    public $pageSize;

    public $pageNumber;

    public function __construct($sessionId, $startingTradeinForm, $endingTradeinFormId, $pageSize, $pageNumber)
    {
        $this->sessionId = new \SoapParam($sessionId, 'sessionId');
        $this->startingTradeinFormId = new \SoapParam($startingTradeinForm, 'startingTradeinFormId');
        $this->endingTradeinFormId = new \SoapParam($endingTradeinFormId, 'endingTradeinFormId');
        $this->pageSize = new \SoapParam($pageSize, 'pageSize');
        $this->pageNumber = new \SoapParam($pageNumber, 'pageNumber');
    }


}