<?php
namespace AcceptanceTester;



use app\models\Tradein;
use saada\FactoryMuffin\FactoryMuffin;

class OperatorSteps extends \AcceptanceTester
{

    public $baseURL = 'index-test.php?r=';

    public function amInTradeinsListPage()
    {
        $this->amOnPage('tradein');
    }


    public function haveAListOfTradeins($qty)
    {
        $tradeins = [];
        foreach(range(1, $qty) as $i){
            $tradeins[] = $this->haveATradein();
        }
        return $tradeins;

//        return array_map([$this, 'haveATradein'], range(1, $qty));
    }

    public function haveATradein($attr=[])
    {
        $fm = new FactoryMuffin([Tradein::class]);
        return $fm->create(Tradein::class, $attr);
    }

    public function clickOnNextPage()
    {
        $this->click('li.next');
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
        $this->see($tradein->value, 'td');
    }

    public function dontSeeTradein($tradein)
    {
        $this->dontSee($tradein->watch, 'td');
        $this->dontSee($tradein->model, 'td');
        $this->dontSee($tradein->brand, 'td');
        $this->dontSee($tradein->value, 'td');
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
        $this->amOnPage('tradein/view&id='.$id);
    }

    public function seeAllInfoAboutTheTradein($tradein)
    {
        $this->see($tradein->first_name);
        $this->see($tradein->last_name);
        $this->see($tradein->watch);
        $this->see($tradein->model);
        $this->see($tradein->brand);
        $this->see($tradein->value);
    }

    public function imagineATradein()
    {
    }

    public function amOnTradeinEditPage($tradeinId)
    {
        $this->amOnPage('tradein/update&id='.$tradeinId);
    }

    public function fillTradeinForm($newTradein)
    {
        $this->fillField('Tradein[first_name]', $newTradein->first_name);
        $this->fillField('Tradein[last_name]', $newTradein->last_name);
        $this->fillField('Tradein[watch]', $newTradein->watch);
        $this->fillField('Tradein[model]', $newTradein->model);
        $this->fillField('Tradein[brand]', $newTradein->brand);
        $this->fillField('Tradein[value]', $newTradein->value);
    }

    public function submitTradeinForm()
    {
        $this->click('Update');
    }

    public function amOnPage($url)
    {
        return parent::amOnPage($this->baseURL.$url);
    }


}