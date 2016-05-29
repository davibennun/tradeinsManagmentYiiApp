<?php
namespace AcceptanceTester;



use app\models\Tradein;
use saada\FactoryMuffin\FactoryMuffin;
use tests\codeception\_support\FactoryMuffinTrait;

class OperatorSteps extends \AcceptanceTester
{

    use EditableStepsTrait, FactoryMuffinTrait;

    public $baseURL = 'index-test.php?r=';

    public function amInTradeinsListPage()
    {
        $this->amOnPage('tradein');
        $this->amDealingWithAGrid();
        $this->amDealingWithModel('tradein');
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

    public function searchTradeinsByDate($field, $value)
    {
        $idInputHidden = sprintf('#%ssearch-%s', 'tradein', $field);
        $idInputText = $idInputHidden.'-disp';
        $this->fillField($idInputText, $value);
        $this->executeJs(sprintf('$("%s").val("%s");',$idInputHidden, $value));
        $this->executeJS(sprintf('$("%s").change();',$idInputText));
        $this->wait(5);

    }

    public function searchTradeinsBy($field, $value)
    {
        $inputName = sprintf('TradeinSearch[%s]', $field);
        $input = sprintf('input[name="%s"]',$inputName);
        $this->fillField($input, $value);
        $this->executeJs(sprintf('$(\'%s\').val("%s");', $input, $value));
        $this->executeJS(sprintf('$(\'%s\').change();', $input));
        $this->pressKey($input, \WebDriverKeys::ENTER);
        $this->wait(5);
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

    public function onlySeeTradeinInGrid($tradein)
    {
        $this->see($tradein->first_name, "#tradein-0-first_name-targ");
        $this->see($tradein->last_name, "#tradein-0-last_name-targ");
        $this->see(\DateTime::createFromFormat('Y-m-d',$tradein->first_contact)->format('m-d-Y'), "#tradein-0-first_contact-targ");
        $this->see(\DateTime::createFromFormat('Y-m-d',$tradein->last_contact)->format('m-d-Y'), "#tradein-0-last_contact-targ");
        $this->see($tradein->model_number, "#tradein-0-model_number-targ");
        $this->dontSee("#tradein-1-first_name-targ");
    }


    public function amInTradeinsDetailsPage($id)
    {
        $this->amOnPage('tradein/view&id='.$id);
        $this->amNotDealingWithAGrid();
        $this->amDealingWithModel('tradein');
    }

    public function seeAllInfoAboutTheTradein($tradein)
    {
        $this->see($tradein->first_name);
        $this->see($tradein->last_name);
        $this->see($tradein->model_number);
        $this->see($tradein->brand);
    }

    public function imagineATradein($attr=[])
    {
        return $this->fm()->instance(Tradein::class, $attr);
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

    public function seeImages($images)
    {
        foreach ($images as $image) {
            $this->seeElement('//img[@src="' . $image . '"]');
        }
    }

    public function dontSeeImages($images)
    {
        foreach ($images as $image) {
            $this->dontSeeElement('img[src="' . $image . '"]');
        }
    }

    public function deleteImage($image)
    {
        $sel = 'button[data-key="' . $image . '"]';
        $this->scrollTo($sel, null, -200);
        $this->click($sel);
    }


}