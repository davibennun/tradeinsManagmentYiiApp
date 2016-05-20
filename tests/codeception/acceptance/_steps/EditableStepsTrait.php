<?php


namespace AcceptanceTester;


trait EditableStepsTrait {

    protected $optConfig = [
        'modelName'=>'',
        'order'=>null,
        'fieldSuffix'=>null
    ];

    public function submitEditableDateField($field, $value, $opt = [])
    {
        $this->editEditableField($field, $value, array_merge(['fieldSuffix' => 'disp'], $opt));
        $this->click('body');
        $this->wait(1);
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
        $this->see($value, $sel);
    }

    public function seeEditableFieldUpdatedTheDatabase($model, $attr, $value)
    {
        $model->refresh();
        $this->assertEquals($model->$attr, $value);
    }

    public function clickInEditableButton($fieldName,$opt=[])
    {
        extract(array_merge($this->optConfig, $opt));
        $this->click('#' . $modelName . '-' . ($this->_chk($order) ? $order . '-' : '') . $fieldName . '-targ');
    }

    public function fillEditableField($fieldName, $value, $opt=[])
    {
        extract(array_merge($this->optConfig, $opt));
        $fieldId = '#'.$modelName.'-'. ( $this->_chk($order) ? $order.'-' : '') . $fieldName . ($fieldSuffix ? '-'.$fieldSuffix : '');
        $this->fillField($fieldId, $value);
    }

    public function clickEditableSubmit($fieldName, $opt=[])
    {
        extract(array_merge($this->optConfig, $opt));
        $this->click('#'.$modelName.'-'. ($this->_chk($order) ? $order . '-' : '').$fieldName.'-cont .kv-editable-submit');
    }

    public function makeIdSelector($modelName=nul, $order=null)
    {
        $id = '#'.$modelName ? $modelName : $this->optConfigConfig['modelName'];
        $id = $id.'-';

    }

    public function _configEditable($opt)
    {
        $this->optConfig = array_merge($this->optConfig, $opt);
    }

    public function _chk($val)
    {
        return $val !== null && $val !== '';
    }


}