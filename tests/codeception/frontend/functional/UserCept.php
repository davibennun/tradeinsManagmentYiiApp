<?php

namespace tests\codeception\frontend\functional;

use tests\codeception\frontend\FunctionalTester;
use tests\codeception\common\_pages\LoginPage;

/* @var $scenario \Codeception\Scenario */

$I = new \tests\codeception\frontend\Step\Functional\OperatorSteps($scenario);

$I->wantTo('ensure user management works');

$admin = $I->asAnAdmin();
$I->amGoingTo('create an user');
$I->visit('user/create');
$I->expectTo('see user form');
$user = $I->submitUserCreationForm();
$I->expectTo('see user was created successfully');
$I->see('User created successfully');
$I->seeUserInDatabase($user);


$I->amGoingTo('see that the new user can login');
$I->logout();
$I->seeAmOnPage('site/login');
$I->login($user);
$I->expectTo('see tradeins page');
$I->see('Tradeins','h1');

//$I->logout();
//$I->asAnAdmin($admin);
//$I->amGoingTo('change user password');
//$newPass = 'asdf123';
//$I->amOnPage('user');
//$I->click('a[href="/index-test.php?r=user%2Fdelete&id='.$user->id.'"]');
//$I->submitChangePasswordForm($newPass);
//$I->click('#logout');
//$I->amGoingTo('try to login with new password');
//$loginPage->login($user->username, $newPass);
//$I->expectTo('see that user is logged');
//$I->see('Logout', 'form button[type=submit]');
//$I->dontSeeLink('Login');

//
//$I->amGoingTo('change username');
//$loginPage = LoginPage::openBy($I);
//$loginPage->login('erau', 'password_0');
//$I->expectTo('see users page');
//$I->see('Users');

