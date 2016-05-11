<?php
/* @var $scenario Codeception\Scenario */
$I = new \AcceptanceTester\OperatorSteps($scenario);


$I->wantTo('search tradeins by watch, model, brand and value');
$tradeins = $I->haveAListOfTradeins(3);
$tradein = $tradeins[0];
$I->amInTradeinsListPage();

$I->searchTradeinsBy('first_name', $tradein->first_name);
$I->onlySeeTradeinsWith('first_name', $tradein->first_name, $tradeins);
//
//$I->searchTradeinsBy('second_name', $tradein->second_name);
//$I->onlySeeTradeinsWith('second_name', $tradein->second_name, $tradeins);
//
//$I->searchTradeinsBy('watch', $tradein->watch);
//$I->onlySeeTradeinsWith('watch', $tradein->watch, $tradeins);
//
//$I->searchTradeinsBy('model', $tradein->model);
//$I->onlySeeTradeinsWith('model', $tradein->model, $tradeins);
//
//$I->searchTradeinsBy('brand', $tradein->brand);
//$I->onlySeeTradeinsWith('brand', $tradein->brand, $tradeins);
//
//$I->searchTradeinsBy('value', $tradein->value);
//$I->onlySeeTradeinsWith('value', $tradein->value, $tradeins);