<?php
/* @var $scenario Codeception\Scenario */
$I = new \AcceptanceTester\OperatorSteps($scenario);

$I->wantTo('edit a tradein');
$tradein = $I->haveATradein();
$newFirstName = 'NAME';
$newLastName = 'LAST';
$newFirstContactDate = '10-10-2017';
$newLastContactDate = '10-10-2017';
$newModelNumber = '11111111';


//$I->amInTradeinsListPage();
//$I->clickOnExpandableTradein($tradein);
//$order = $I->getConfig('order');
//$I->clickInEditableButton('first_contact');
//$I->wait(2);
//$I->fillEditableField('first_contact', $newFirstContactDate, ['order'=>null,'fieldSuffix'=>'disp']);
//$I->wait(1);
//$I->clickEditableSubmit('first_contact');
//$I->wait(3);
//$I->seeEditableFieldUpdatedTheUi($newFirstContactDate, 'first_contact', ['order'=>$order]);
//$I->seeEditableFieldUpdatedTheDatabase($tradein, 'first_contact', \DateTime::createFromFormat('m-d-Y',$newFirstContactDate)->format('Y-m-d'));
//
//$I->amInTradeinsListPage();
//$I->clickOnExpandableTradein($tradein);
//$order = $I->getConfig('order');
//$I->clickInEditableButton('last_contact');
//$I->wait(2);
//$I->fillEditableField('last_contact', $newLastContactDate, ['order'=>null,'fieldSuffix'=>'disp']);
//$I->wait(1);
//$I->clickEditableSubmit('last_contact');
//$I->wait(3);
//$I->seeEditableFieldUpdatedTheUi($newLastContactDate, 'last_contact', ['order'=>$order]);
//$I->seeEditableFieldUpdatedTheDatabase($tradein, 'last_contact', \DateTime::createFromFormat('m-d-Y',$newLastContactDate)->format('Y-m-d'));


$I->amInTradeinsListPage();
$I->clickOnExpandableTradein($tradein);
$fields = ['first_name','last_name','model','model_number','customeritem_retail_value','customeritem_vendor_offer','customeritem_jomashop_offer','box_papers', 'purchased_from' , 'condition','info_newitem_customer_wants','newitem_cost','newitem_jomashop_currentprice','outofpocket_price'];
foreach($fields as $field) {
    $newTradein = $I->imagineATradein();
    $newFieldValue = $newTradein->$field;
    $I->amDealingWithModel('tradein');
    $I->submitEditableField($field, $newFieldValue);
    $I->wait(3);
    $I->seeEditableFieldUpdatedTheUi($newFieldValue, $field);
    $I->seeEditableFieldUpdatedTheDatabase($tradein, $field, $newFieldValue);
}
