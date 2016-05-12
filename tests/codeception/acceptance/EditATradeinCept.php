<?php
/* @var $scenario Codeception\Scenario */
$I = new \AcceptanceTester\OperatorSteps($scenario);

$I->wantTo('edit a tradein');
$tradein = $I->haveATradein();
$I->amInTradeinsListPage();

$I->clickInEditableButton('first_name');
$I->wait(1);

$I->fillEditableField('NAME', 'first_name');

$I->clickEditableSubmit();

$I->wait(3);

$I->see('NAME','button');