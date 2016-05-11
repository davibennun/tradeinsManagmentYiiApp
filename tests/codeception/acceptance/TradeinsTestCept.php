<?php

$I = new \AcceptanceTester\OperatorSteps($scenario);


$I->wantTo('list tradeins');
    $tradeins = $I->haveAListOfTradeins(5);
    $I->amInTradeinsListPage();
    $I->seeTradeins($tradeins);

$I->wantTo('navigate trough pages of tradeins');
    $tradeins = $I->haveAListOfTradeins(100);
    $I->amInTradeinsListPage();
    $I->clickOnNextPage();
    $I->seeTradein($tradeins[20]);

$I->wantTo('filter tradeins by watch, model, brand and value');
    $tradeins = $I->haveAListOfTradeins(100);
    $tradein = $tradeins[0];
    $I->amInTradeinsListPage();

    $I->searchTradeinsBy('watch', $tradein->watch);
    $I->onlySeeTradeinsWith('watch', $tradein->watch, $tradeins);

    $I->searchTradeinsBy('model', $tradein->model);
    $I->onlySeeTradeinsWith('model', $tradein->model, $tradeins);

    $I->searchTradeinsBy('brand', $tradein->brand);
    $I->onlySeeTradeinsWith('brand', $tradein->brand, $tradeins);

    $I->searchTradeinsBy('value', $tradein->value);
    $I->onlySeeTradeinsWith('value', $tradein->value, $tradeins);


$I->wantTo('view all details about a tradein');
    $tradein = $I->haveATradein();
    $I->amInTradeinsDetailsPage($tradein->id);
    $I->seeAllInfoAboutTheTradein($tradein);

$I->wantTo('edit a tradein');
    $tradein = $I->haveATradein();
    $newTradein = $I->imagineATradein();
    $I->amOnTradeinEditPage($tradein->id);
    $I->fillTradeinForm($newTradein);
    $I->submitTradeinForm();
    $I->seeAllInfoAboutTheTradein($tradein);
