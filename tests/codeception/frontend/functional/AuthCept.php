<?php

namespace tests\codeception\frontend\functional;

use tests\codeception\frontend\FunctionalTester;
use tests\codeception\common\_pages\LoginPage;

/* @var $scenario \Codeception\Scenario */

$I = new FunctionalTester($scenario);
$I->wantTo('ensure auth works');


$I->amGoingTo('access trade-ins page as a guest');
$I->amOnPage('?r=tradein');
$I->expectTo('be redirected to login page');
$I->seeInCurrentUrl('?r=site%2Flogin');

$I->amGoingTo('access trade-ins page as a registered user');
$loginPage = LoginPage::openBy($I);
$loginPage->login('erau', 'password_0');
$I->expectTo('see tradeins index page');
$I->seeInCurrentUrl('?r=tradein');

