<?php
/* @var $scenario Codeception\Scenario */
$I = new \AcceptanceTester\OperatorSteps($scenario);

$I->wantTo('edit a tradein');
$tradein = $I->haveATradein();
$newTradein = $I->haveATradein();
$I->amInTradeinsListPage();
$I->click('#tradein-0-first_name-targ');
$I->wait(1);
$I->fillField('#tradein-0-first_name', 'NAME');
$I->click(".kv-editable-submit");
$I->wait(2);
$I->see('NAME','button');