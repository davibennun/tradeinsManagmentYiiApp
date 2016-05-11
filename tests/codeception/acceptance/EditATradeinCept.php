<?php
/* @var $scenario Codeception\Scenario */
$I = new \AcceptanceTester\OperatorSteps($scenario);

$I->wantTo('edit a tradein');
$tradein = $I->haveATradein();
$newTradein = $I->imagineATradein();
$I->amOnTradeinEditPage($tradein->id);
$I->fillTradeinForm($newTradein);
$I->submitTradeinForm();
$I->seeAllInfoAboutTheTradein($tradein);