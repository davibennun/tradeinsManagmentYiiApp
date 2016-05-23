<?php
/* @var $scenario Codeception\Scenario */
$I = new \AcceptanceTester\OperatorSteps($scenario);


$I->wantTo('search tradeins by first and last name, contact dates and model number');
$tradeins = $I->haveAListOfTradeins(3);
$tradein = $tradeins[0];

$I->amInTradeinsListPage();
$I->searchTradeinsBy('first_name', $tradein->first_name);
$I->onlySeeTradeinsWith('first_name', $tradein->first_name, $tradeins);

$I->amInTradeinsListPage();
$I->searchTradeinsBy('last_name', $tradein->last_name);
$I->onlySeeTradeinsWith('last_name', $tradein->last_name, $tradeins);

$I->amInTradeinsListPage();
$I->searchTradeinsBy('model_number', $tradein->model_number);
$I->onlySeeTradeinsWith('model_number', $tradein->model_number, $tradeins);

$I->amInTradeinsListPage();
$humanDate = \DateTime::createFromFormat('Y-m-d',$tradein->first_contact)->format('d-m-Y');
$I->searchTradeinsByDate('first_contact', $humanDate);
$I->onlySeeTradeinsWith('first_contact', $humanDate, $tradeins);

$I->amInTradeinsListPage();
$humanDate = \DateTime::createFromFormat('Y-m-d', $tradein->last_contact)->format('d-m-Y');
$I->searchTradeinsByDate('last_contact', $humanDate);
$I->onlySeeTradeinsWith('last_contact', $humanDate, $tradeins);

