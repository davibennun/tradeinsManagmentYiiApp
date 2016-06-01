<?php
/* @var $scenario Codeception\Scenario */
$I = new tests\codeception\frontend\Step\Acceptance\OperatorSteps($scenario);

$I->wantTo('List tradeins');
$tradeins = $I->haveAListOfTradeins(5);
$I->amInTradeinsListPage();
$I->seeTradeins($tradeins);