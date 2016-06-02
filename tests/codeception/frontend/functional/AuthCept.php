<?php

namespace tests\codeception\frontend\functional;

use tests\codeception\frontend\FunctionalTester;
use tests\codeception\common\_pages\LoginPage;

/* @var $scenario \Codeception\Scenario */

$I = new FunctionalTester($scenario);
$I->wantTo('ensure auth works');

$loginPage = LoginPage::openBy($I);

$I->amGoingTo('access trade-ins page as a guest');
$I->amOnPage('index.php?r=tradeins/index');
$I->expectTo('be redirected to login page');
$I->seeInCurrentUrl('index.php?r=site/index');

$I->amGoingTo('access trade-ins page as a registered user');
$loginPage->login('erau', 'password_0');
$I->expectTo('see tradeins index page');
$I->seeInCurrentUrl('index.php?r=tradeins/index');

