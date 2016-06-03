<?php

namespace tests\codeception\frontend\functional;

use common\models\User;
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
$user = $user->lastInserted();

$I->amGoingTo('see that the new user can login');
$I->logout();
$I->seeAmOnPage('site/login');
$I->login($user);
$I->expectTo('see tradeins page');
$I->see('Tradeins','h1');


$I->logout();
$I->asAnAdmin($admin);
$I->amGoingTo('change user password');
$newPass = 'asdf123';
$I->visit('user');
$I->click('a[href="/index-test.php?r=user%2Fupdate&id=' . $user->id . '"]');
$I->submitChangePasswordForm($newPass);
$I->click('#logout-link');
$I->amGoingTo('try to login with new password');
$I->login($user, $newPass);
$I->expectTo('see that user is logged');
$I->see($user->username);
$I->dontSeeLink('Login');


$I->amGoingTo('delete a user');
$I->logout();
$I->asAnAdmin();
$I->visit('user');
$I->see($user->username);
$I->click('a[href="/index-test.php?r=user%2Fdelete&id=' . $user->id . '"]');
$I->dontSee($user->username);
