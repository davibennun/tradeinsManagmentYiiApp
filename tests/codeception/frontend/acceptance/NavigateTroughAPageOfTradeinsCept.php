<?php
/* @var $scenario Codeception\Scenario */
$I = new tests\codeception\frontend\Step\Acceptance\OperatorSteps($scenario);

$I->wantTo('navigate trough pages of tradeins');

$tradeins = $I->haveAListOfTradeins(50);

$I->amInTradeinsListPage();
$I->seeNextPageButton();