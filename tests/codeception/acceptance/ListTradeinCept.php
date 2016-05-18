<?php
/* @var $scenario Codeception\Scenario */
$I = new \AcceptanceTester\OperatorSteps($scenario);

$I->wantTo('List tradeins');
$tradeins = $I->haveAListOfTradeins(5);
$I->amInTradeinsListPage();
$I->seeTradeins($tradeins);