<?php
/* @var $scenario Codeception\Scenario */
$I = new \AcceptanceTester\OperatorSteps($scenario);

$I->wantTo('navigate trough pages of tradeins');

$tradeins = $I->haveAListOfTradeins(100);

$I->amInTradeinsListPage();
$I->clickOnNextPage();
$I->seeTradein($tradeins[20]);