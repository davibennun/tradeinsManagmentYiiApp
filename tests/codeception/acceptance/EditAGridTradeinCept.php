<?php
/* @var $scenario Codeception\Scenario */
$I = new \AcceptanceTester\OperatorSteps($scenario);

$I->wantTo('edit a tradein');
$tradein = $I->haveATradein();
$newFirstContactDate = '10-10-2017';
$newLastContactDate = '10-10-2017';

$I->amInTradeinsListPage();
$I->amDealingWithModel('tradein');
$I->clickOnExpandableTradein($tradein);
$fields = ['first_contact', 'last_contact'];
foreach ($fields as $field) {
        $I->submitEditableDateField($field, $newFirstContactDate);
        $I->seeEditableFieldUpdatedTheUi($newFirstContactDate, $field);
        $I->seeEditableFieldUpdatedTheDatabase($tradein, $field, \DateTime::createFromFormat('m-d-Y', $newFirstContactDate)->format('Y-m-d'));
}


$I->amInTradeinsListPage();
$I->clickOnExpandableTradein($tradein);
$I->submitEditableDropDownField('customeritem_if_new', 'NO');
$I->wait(3);
$I->seeEditableFieldUpdatedTheUi('NO', 'customeritem_if_new');
$I->seeEditableFieldUpdatedTheDatabase($tradein, 'customeritem_if_new', 0);

$I->amInTradeinsListPage();
$I->amDealingWithModel('tradein');
$I->clickOnExpandableTradein($tradein);
$fields = ['first_name','last_name','model','model_number','customeritem_retail_value','customeritem_vendor_offer','customeritem_jomashop_offer','box_papers', 'purchased_from' , 'condition','info_newitem_customer_wants','newitem_cost','newitem_jomashop_currentprice','outofpocket_price'];
foreach($fields as $field) {
    $newTradein = $I->imagineATradein();
    $newFieldValue = $newTradein->$field;
    try {
        $I->submitEditableField($field, $newFieldValue);
    } catch (Exception $e) {
        $I->pauseExecution();
    }

    $I->wait(3);
    $I->seeEditableFieldUpdatedTheUi($newFieldValue, $field);
    $I->seeEditableFieldUpdatedTheDatabase($tradein, $field, $newFieldValue);
}
