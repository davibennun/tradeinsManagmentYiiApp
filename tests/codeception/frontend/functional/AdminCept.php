<?php

namespace tests\codeception\frontend\functional;

use tests\codeception\frontend\FunctionalTester;
use tests\codeception\common\_pages\LoginPage;

/* @var $scenario \Codeception\Scenario */

$I = new FunctionalTester($scenario);
$I->wantTo('ensure admin protection works');


$I->amGoingTo('access users page as a guest');
$I->amOnPage('?r=tradein');
$I->expectTo('be redirected to login page');
$I->seeInCurrentUrl('?r=site%2Flogin');

$I->amGoingTo('access users page as a regular user');
$loginPage = LoginPage::openBy($I);
$loginPage->login('erau', 'password_0');
$I->expectTo('see forbidden page');
$I->see('Forbidden');

$I->amGoingTo('access users page as an admin');
$loginPage = LoginPage::openBy($I);
$loginPage->login('erau', 'password_0');
$I->expectTo('see users page');
$I->see('Users');

