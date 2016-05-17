<?php
namespace AcceptanceTester;



use app\models\Tradein;
use saada\FactoryMuffin\FactoryMuffin;
use tests\codeception\_support\FactoryMuffinTrait;

class OperatorSteps extends \AcceptanceTester
{

    use FactoryMuffinTrait;

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
        codecept_debug($this->fm()->instance(Tradein::class)->getAttributes());
        return $this->fm()->create(Tradein::class, $attr);
    }

    public function seeNextPageButton()
    {
        $this->seeElement('li.next');
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
        $this->seeTradeinAttr($tradein->first_name, 'td');
        $this->seeTradeinAttr($tradein->last_name, 'td');
    }

    public function dontSeeTradein($tradein)
    {
        $this->dontSee($tradein->first_name, 'td');
        $this->dontSee($tradein->last_name, 'td');
    }

    public function seeTradeinAttr($value, $el=null)
    {
        $this->see($value, $el);
    }

    public function searchTradeinsBy($field, $value)
    {
        $this->seeElement('input',['name'=>'TradeinSearch['.$field.']']);
        $this->amOnPage('tradein&TradeinSearch['.$field.']='.$value);
    }

    public function onlySeeTradeinsWith($field, $value, $tradeins)
    {
        //Get tradeins which does not contains the value we want to see
        //Ie. remove tradeins that has $field=>$value
        $tradeinsNotSupposedToSee = array_filter(array_map(function($tradein) use ($field, $value){
            return $tradein->$field != $value ? $tradein : false;
        }, $tradeins));

        $this->seeTradeinAttr($value, 'td');
        $this->dontSeeTradeins($tradeinsNotSupposedToSee);
    }

    public function amInTradeinsDetailsPage($id)
    {
        $this->amOnPage('tradein/view&id='.$id);
    }

    public function seeAllInfoAboutTheTradein($tradein)
    {
        $this->see($tradein->first_name);
        $this->see($tradein->last_name);
        $this->see($tradein->model);
        $this->see($tradein->brand);
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
        $this->fillField('Tradein[model]', $newTradein->model);
        $this->fillField('Tradein[brand]', $newTradein->brand);
    }

    public function submitTradeinForm()
    {
        $this->click('Update');
    }

    public function amOnPage($url)
    {
        return parent::amOnPage($this->baseURL.$url);
    }

    public function getModelDefinitions()
    {
        return [Tradein::class];
    }

    public function clickInEditableButton($fieldName, $order=0, $id=null)
    {
        $this->click('#tradein-'.$order.'-'.$fieldName.'-targ');
    }

    public function fillEditableField($value, $fieldName, $order=0, $id=null)
    {
        $this->fillField('#tradein-'.$order.'-'.$fieldName, $value);
    }

    public function clickEditableSubmit()
    {
        $this->click(".kv-editable-submit");
    }

    public function _after(\Codeception\TestCase $test){
        codecept_debug('----$$$$$$------');
        $this->fm()->deleteSaved();
    }

}