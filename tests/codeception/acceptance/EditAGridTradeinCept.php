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

$I->_configEditable(['modelName' => 'tradein', 'order'=>0]);


$I->amInTradeinsListPage();
$I->submitEditableField('first_name', $newFirstName);
$I->wait(2);
$I->seeEditableFieldUpdatedTheUi($newFirstName);
$I->seeEditableFieldUpdatedTheDatabase($tradein, 'first_name', $newFirstName);

$I->amInTradeinsListPage();
$I->submitEditableField('last_name', $newLastName);
$I->wait(2);
$I->seeEditableFieldUpdatedTheUi($newLastName);
$I->seeEditableFieldUpdatedTheDatabase($tradein, 'last_name', $newLastName);

$I->amInTradeinsListPage();
$I->submitEditableField('first_contact', $newFirstContactDate, ['fieldSuffix'=>'disp']);
$I->wait(2);
$I->seeEditableFieldUpdatedTheUi($newFirstContactDate, 'first_contact');
$I->seeEditableFieldUpdatedTheDatabase($tradein, 'first_contact', $newFirstContactDate);

$I->amInTradeinsListPage();
$I->submitEditableField('last_contact', $newLastContactDate, ['fieldSuffix'=>'disp']);
$I->wait(2);
$I->seeEditableFieldUpdatedTheUi($newLastContactDate);
$I->seeEditableFieldUpdatedTheDatabase($tradein, 'last_contact', $newLastContactDate);

$I->amInTradeinsListPage();
$I->submitEditableField('model_number', $newModelNumber);
$I->wait(3);
$I->seeEditableFieldUpdatedTheUi($newModelNumber);
$I->seeEditableFieldUpdatedTheDatabase($tradein, 'model_number', $newModelNumber);