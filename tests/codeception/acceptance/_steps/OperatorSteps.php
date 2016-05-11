<?php
namespace AcceptanceTester;

class OperatorSteps extends \AcceptanceTester
{

    function __construct()
    {

    }

    public function amInTradeinsListPage()
    {
        $this->amOnPage('tradeins');
    }


    public function haveAListOfTradeins($int)
    {
    }

    public function clickOnNextPage()
    {
        $this->click('.next-page');
    }

    public function seeTradeins($tradeins)
    {
        array_map([$this, 'seeTradein'], $tradeins);
    }

    public function dontSeeTradeins($tradeins)
    {
        array_map([$this, 'dontSeeTradein'], $tradeins);
    }

    public function seeTradein($tradein)
    {
        $this->see($tradein->watch, 'td');
        $this->see($tradein->model, 'td');
        $this->see($tradein->brand, 'td');
    }

    public function dontSeeTradein($tradein)
    {
        $this->dontSee($tradein->watch, 'td');
        $this->dontSee($tradein->model, 'td');
        $this->dontSee($tradein->brand, 'td');
    }

    public function haveATradein()
    {
    }

    public function searchTradeinsBy($field, $value)
    {
        $this->fillField('search-field-'.$field, $value);
    }

    public function onlySeeTradeinsWith($field, $value, $tradeins)
    {
        //Get tradeins which does not contains the value we want to see
        $tradeinsNotSupposedToSee = array_map(function($tradein) use ($value){
            return $tradein->$field != $value;
        }, $tradeins);

        $this->seeTradein($value) && $this->dontSeeTradeins($tradeinsNotSupposedToSee);
    }

    public function amInTradeinsDetailsPage($id)
    {
        $this->amOnPage('tradeins/'.$id);
    }

    public function seeAllInfoAboutTheTradein($tradein)
    {
        $this->see($tradein->first_name);
        $this->see($tradein->last_name);
        $this->see($tradein->watch);
        $this->see($tradein->model);
        $this->see($tradein->brand);
    }

    public function imagineATradein()
    {
    }

    public function amOnTradeinEditPage($tradeinId)
    {
        $this->am('tradein/update/', $tradeinId);
    }

    public function fillTradeinForm($newTradein)
    {
        $this->fillField('first_name', $newTradein->first_name);
        $this->fillField('last_name', $newTradein->last_name);
        $this->fillField('watch', $newTradein->watch);
        $this->fillField('model', $newTradein->model);
        $this->fillField('brand', $newTradein->brand);
    }

    public function submitTradeinForm()
    {
        $this->click('Submit');
    }


}