<?php


namespace AcceptanceTester;


trait EditableStepsTrait {

    protected $optConfig = [
        'modelName'=>'',
        'order'=>null,
        'fieldSuffix'=>null
    ];

    public function amDealingWithModel($model)
    {
        $this->optConfig['modelName'] = $model;
    }

    public function amDealingWithAGrid()
    {
        $this->optConfig['order'] = 0;
    }

    public function amNotDealingWithAGrid()
    {
        $this->optConfig['order'] = null;
    }

    public function submitEditableDateField($field, $value, $opt = [])
    {
        $this->editEditableField($field, $value, array_merge(['fieldSuffix' => 'disp'], $opt));
        $this->click('body');
        $this->wait(1);
        $this->clickEditableSubmit($field);
    }

    public function submitEditableDropDownField($field, $value, $opt=[])
    {
        $this->clickInEditableButton($field, $opt);
        $this->wait(2);

        extract(array_merge($this->optConfig, $opt));
        $sel = '#' . $modelName . '-' . ($this->_chk($order) ? $order . '-' : '') . $field;
        $this->selectOption($sel, $value);

        $this->clickEditableSubmit($field);
    }

    public function submitEditableField($field, $value, $opt=[])
    {
        $this->editEditableField($field, $value, $opt);
        $this->clickEditableSubmit($field);
    }

    public function editEditableField($field, $value, $opt=[])
    {
        $this->clickInEditableButton($field, $opt);
        $this->wait(2);

        $this->fillEditableField($field, $value, $opt);
        $this->wait(1);
    }


    public function seeEditableFieldUpdatedTheUi($value, $fieldName=null,$opt=[])
    {
        if($fieldName){
            extract(array_merge($this->optConfig, $opt));
            $sel = '#' . $modelName . '-' . ($this->_chk($order) ? $order . '-' : '') . $fieldName . '-targ';
        }else{
            $sel = 'button';
        }
        $this->waitForText($value, 5, $sel);
    }

    public function seeEditableFieldUpdatedTheDatabase($model, $attr, $value)
    {
        $model->refresh();
        $this->assertEquals($model->$attr, $value);
    }

    public function clickInEditableButton($fieldName,$opt=[])
    {
        extract(array_merge($this->optConfig, $opt));
        $id = '#' . $modelName . '-' . ($this->_chk($order) ? $order . '-' : '') . $fieldName;
        $this->scrollTo(['css' => $id . '-targ'], null, -200);
        $this->wait(1);
        $this->click($id . '-targ');
    }

    public function fillEditableField($fieldName, $value, $opt=[])
    {
        extract(array_merge($this->optConfig, $opt));
        $fieldId = '#'.$modelName.'-'. ( $this->_chk($order) ? $order.'-' : '') . $fieldName . ($fieldSuffix ? '-'.$fieldSuffix : '');
        $this->fillField($fieldId, $value);
        if($fieldSuffix == 'disp') $fieldId = substr($fieldId, 0, -5);
        $this->executeJs(sprintf('$("%s").val("%s");', $fieldId, $value));
    }

    public function clickEditableSubmit($fieldName, $opt=[])
    {
        extract(array_merge($this->optConfig, $opt));
        $id = '#' . $modelName . '-' . ($this->_chk($order) ? $order . '-' : '') . $fieldName;
        $this->scrollTo(['css' => $id . '-cont'], null, -200);
        $this->wait(1);
        $this->click($id.'-cont .kv-editable-submit');
    }

    public function seeValidationError($fieldName, $opt=[])
    {
        extract(array_merge($this->optConfig, $opt));
        $this->waitForElement('#' . $modelName . '-' . ($this->_chk($order) ? $order . '-' : '') . $fieldName . '-cont .has-error', 5);
    }

    public function makeIdSelector($modelName=nul, $order=null)
    {
        $id = '#'.$modelName ? $modelName : $this->optConfigConfig['modelName'];
        $id = $id.'-';
    }

    public function clickOnExpandableTradein($tradein)
    {
        $tr = 'tr[data-key="' . $tradein->id . '"]';
        $this->scrollTo(['css' => $tr]);
        $this->wait(1);
        $this->click($tr);
        $this->wait(1);
        $this->optConfig['order'] = $this->grabAttributeFrom('.kv-expand-detail-row','data-index');
    }

    public function seeRowIsUpdated($field, $value, $opt=[])
    {
        extract(array_merge($this->optConfig, $opt));
        $this->see($value, '#td-' . $modelName . '-' . ($this->_chk($order) ? $order . '-' : '') . $field . '');
    }


    public function _configEditable($opt)
    {
        $this->optConfig = array_merge($this->optConfig, $opt);
    }

    public function getConfig($key=null)
    {
        return $key ? $this->optConfig[$key] : $this->optConfig;
    }

    public function _chk($val)
    {
        return $val !== null && $val !== '';
    }


}