<?php
/* @var $scenario Codeception\Scenario */
$I = new \AcceptanceTester\OperatorSteps($scenario);

$I->wantTo('edit a tradein');
$tradein = $I->haveATradein();
$newFirstContactDate = '10-10-2017';
$newFirstContactDateMysql = '2017-10-10';

$I->amInTradeinsDetailsPage($tradein->id);

$I->submitEditableField('first_name', 'NAME');
$I->wait(3);
$I->seeEditableFieldUpdatedTheUi('NAME', 'first_name');
$I->seeEditableFieldUpdatedTheDatabase($tradein, 'first_name', 'NAME');

$I->submitEditableField('last_name', 'LAST_NAME');
$I->wait(3);
$I->seeEditableFieldUpdatedTheUi('LAST_NAME', 'last_name');
$I->seeEditableFieldUpdatedTheDatabase($tradein, 'last_name', 'LAST_NAME');

$I->submitEditableField('internal_notes', 'INTERNAL_NOTES');
$I->wait(3);
$I->seeEditableFieldUpdatedTheUi('INTERNAL_NOTES', 'internal_notes');
$I->seeEditableFieldUpdatedTheDatabase($tradein, 'internal_notes', 'INTERNAL_NOTES');

$I->submitEditableDateField('first_contact', $newFirstContactDate);
$I->wait(3);
$I->seeEditableFieldUpdatedTheUi($newFirstContactDate, 'first_contact');
$I->seeEditableFieldUpdatedTheDatabase($tradein, 'first_contact', $newFirstContactDateMysql);

$I->submitEditableDateField('last_contact', '11-11-1991');
$I->wait(3);
$I->seeEditableFieldUpdatedTheUi('11-11-1991', 'last_contact');
$I->seeEditableFieldUpdatedTheDatabase($tradein, 'last_contact', '1991-11-11');

$I->submitEditableField('contact_notes', 'CONTACT_NOTES');
$I->wait(3);
$I->seeEditableFieldUpdatedTheUi('CONTACT_NOTES', 'contact_notes');
$I->seeEditableFieldUpdatedTheDatabase($tradein, 'contact_notes', 'CONTACT_NOTES');

$I->submitEditableField('shipping_label', 'SHIPPING_LABEL');
$I->wait(3);
$I->seeEditableFieldUpdatedTheUi('SHIPPING_LABEL', 'shipping_label');
$I->seeEditableFieldUpdatedTheDatabase($tradein, 'shipping_label', 'SHIPPING_LABEL');

$I->submitEditableField('email', 'email@email.com');
$I->wait(3);
$I->seeEditableFieldUpdatedTheUi('email@email.com', 'email');
$I->seeEditableFieldUpdatedTheDatabase($tradein, 'email', 'email@email.com');

$I->submitEditableField('phone', 'PHONE');
$I->wait(3);
$I->seeEditableFieldUpdatedTheUi('PHONE', 'phone');
$I->seeEditableFieldUpdatedTheDatabase($tradein, 'phone', 'PHONE');

$I->submitEditableField('brand', 'BRAND');
$I->wait(3);
$I->seeEditableFieldUpdatedTheUi('BRAND', 'brand');
$I->seeEditableFieldUpdatedTheDatabase($tradein, 'brand', 'BRAND');

$I->submitEditableField('other_brand', 'OTHER_BRAND');
$I->wait(3);
$I->seeEditableFieldUpdatedTheUi('OTHER_BRAND', 'other_brand');
$I->seeEditableFieldUpdatedTheDatabase($tradein, 'other_brand', 'OTHER_BRAND');

$I->submitEditableField('model', 'MODEL');
$I->wait(3);
$I->seeEditableFieldUpdatedTheUi('MODEL', 'model');
$I->seeEditableFieldUpdatedTheDatabase($tradein, 'model', 'MODEL');

$I->submitEditableField('model_number', 'MODEL_NUMBER');
$I->wait(3);
$I->seeEditableFieldUpdatedTheUi('MODEL_NUMBER', 'model_number');
$I->seeEditableFieldUpdatedTheDatabase($tradein, 'model_number', 'MODEL_NUMBER');