<?php
/* @var $scenario Codeception\Scenario */
$I = new \AcceptanceTester\OperatorSteps($scenario);

$I->wantTo('edit a tradein');
$tradein = $I->haveATradein();
$newFirstContactDate = '10-10-2017';
$newFirstContactDateMysql = '2017-10-10';
$I->_configEditable(['modelName' => 'tradein']);

$I->amInTradeinsListPage();
$I->_configEditable(['order'=>0]);
$I->submitEditableDateField('first_contact', $newFirstContactDate);
$I->wait(3);
$I->seeEditableFieldUpdatedTheUi($newFirstContactDate);
$I->seeEditableFieldUpdatedTheDatabase($tradein, 'first_contact', $newFirstContactDateMysql);


$newFirstContactDate = '11-11-2011';
$newFirstContactDateMysql = '2011-11-11';

$I->amInTradeinsDetailsPage($tradein->id);
$I->_configEditable(['order' => null]);
$I->submitEditableDateField('first_contact', $newFirstContactDate);
$I->wait(3);
$I->seeEditableFieldUpdatedTheUi($newFirstContactDate);
$I->seeEditableFieldUpdatedTheDatabase($tradein, 'first_contact', $newFirstContactDateMysql);