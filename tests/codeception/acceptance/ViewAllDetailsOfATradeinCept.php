<?php
/* @var $scenario Codeception\Scenario */
$I = new \AcceptanceTester\OperatorSteps($scenario);

$I->wantTo('view all details about a tradein');
$tradein = $I->haveATradein();
$I->amInTradeinsDetailsPage($tradein->id);
$I->seeAllInfoAboutTheTradein($tradein);