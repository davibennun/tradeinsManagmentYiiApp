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



$I->amInTradeinsListPage();
$I->clickOnExpandableTradein($tradein);
$I->submitEditableField('first_name', $newFirstName);
$I->wait(2);
$I->seeEditableFieldUpdatedTheUi($newFirstName, 'first_name');
$I->seeEditableFieldUpdatedTheDatabase($tradein, 'first_name', $newFirstName);


$I->amInTradeinsListPage();
$I->clickOnExpandableTradein($tradein);
$I->submitEditableField('last_name', $newLastName);
$I->wait(2);
$I->seeEditableFieldUpdatedTheUi($newLastName, 'last_name');
$I->seeEditableFieldUpdatedTheDatabase($tradein, 'last_name', $newLastName);

$I->amInTradeinsListPage();
$I->clickOnExpandableTradein($tradein);
$order = $I->getConfig('order');
$I->clickInEditableButton('first_contact');
$I->wait(2);
$I->fillEditableField('first_contact', $newFirstContactDate, ['order'=>null,'fieldSuffix'=>'disp']);
$I->wait(1);
$I->clickEditableSubmit('first_contact');
$I->wait(3);
$I->seeEditableFieldUpdatedTheUi($newFirstContactDate, 'first_contact', ['order'=>$order]);
$I->seeEditableFieldUpdatedTheDatabase($tradein, 'first_contact', \DateTime::createFromFormat('m-d-Y',$newFirstContactDate)->format('Y-m-d'));

$I->amInTradeinsListPage();
$I->clickOnExpandableTradein($tradein);
$order = $I->getConfig('order');
$I->clickInEditableButton('last_contact');
$I->wait(2);
$I->fillEditableField('last_contact', $newLastContactDate, ['order'=>null,'fieldSuffix'=>'disp']);
$I->wait(1);
$I->clickEditableSubmit('last_contact');
$I->wait(3);
$I->seeEditableFieldUpdatedTheUi($newLastContactDate, 'last_contact', ['order'=>$order]);
$I->seeEditableFieldUpdatedTheDatabase($tradein, 'last_contact', \DateTime::createFromFormat('m-d-Y',$newLastContactDate)->format('Y-m-d'));


$I->amInTradeinsListPage();
$I->clickOnExpandableTradein($tradein);
$I->submitEditableField('model_number', $newModelNumber);
$I->wait(3);
$I->seeEditableFieldUpdatedTheUi($newModelNumber, 'model_number');
$I->seeEditableFieldUpdatedTheDatabase($tradein, 'model_number', $newModelNumber);