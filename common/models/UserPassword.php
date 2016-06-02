<?php


namespace common\models;

use yii\base\Model;

class UserPassword extends User{

    public $password;
    public $password_repeat;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            ['password', 'required'],
            ['password', 'compare'],
            ['password', 'string'],

            ['password_repeat', 'safe']
        ];
    }

    public function savePassword()
    {
        $this->setPassword($this->password);
        $this->removePasswordResetToken();
        return $this->save(false);
    }


}