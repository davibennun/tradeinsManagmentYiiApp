<?php
/* @var $scenario Codeception\Scenario */
$I = new \AcceptanceTester\OperatorSteps($scenario);

$I->wantTo('edit a tradein');
$tradein = $I->haveATradein();
$newTradein = $I->haveATradein();
$I->amOnTradeinEditPage($tradein->id);
$I->fillTradeinForm($newTradein);
$I->submitTradeinForm();
$I->seeAllInfoAboutTheTradein($newTradein);