<?php
namespace tests\codeception\frontend\Step\Functional;

use common\models\User;
use tests\codeception\frontend\FactoryMuffinTrait;

class OperatorSteps extends \tests\codeception\frontend\FunctionalTester
{

    use FactoryMuffinTrait;

    public $urlPrefix = '?r=';

    public function asAGuest()
    {
        $I = $this;
    }

    public function asAnUser($user=null)
    {
        if( !$user )
            $user = $this->haveAnUser();

        $this->login($user);

        return $user;
    }

    public function asAnAdmin($user=null)
    {
        if( !$user )
            $user = $this->haveAnAdmin();

        $this->login($user);

        return $user;
    }

    public function login($user, $pass=null)
    {
        $this->visit('site/login');
        $this->fillLoginForm($user, $pass);
        return $user;
    }



    public function fillLoginForm($user, $pass=null)
    {
        $this->fillField('#loginform-username', $user->username);
        $this->fillField('#loginform-password', $pass ? $pass : '123456');
        $this->click('login-button');
    }

    public function visit($url)
    {
        $this->amOnPage($this->urlPrefix . urlencode($url));
    }

    public function seeAmOnPage($url)
    {
        $this->seeInCurrentUrl($this->urlPrefix . urlencode($url));
    }

    public function submitUserCreationForm($user=null)
    {
        $user = $this->imagineAnUser();
        $this->visit('user/create');
        $this->fillField('input[name="UserCreate[username]"]', $user->username);
        $this->fillField('input[name="UserCreate[email]"]', $user->email);
        $this->fillField('input[name="UserCreate[password]"]', '123456');
        $this->fillField('input[name="UserCreate[password_repeat]"]', '123456');
        $this->click('Create');

        return $user;
    }

    public function logout()
    {
        $this->click('#logout-link');
    }


    public function imagineAnUser($attr=[])
    {
        return $this->fm()->instance(User::class, $attr);
    }

    public function haveAnUser($attr=[])
    {
        $attr = array_merge($this->imagineAnUser()->getAttributes(), $attr, ['role' => User::ROLE_ADMIN]);
        return $this->fm()->create(User::class, $attr);
    }

    public function haveAnAdmin($attr=[])
    {
        $attr = array_merge($this->imagineAnUser()->getAttributes(), $attr, ['role' => User::ROLE_ADMIN]);
        codecept_debug($attr);
        return $this->fm()->create(User::class, $attr);
    }

    public function seeUserInDatabase($user)
    {
        $this->seeRecord('common\models\User', [
            'username' => $user->username,
            'email' => $user->email
        ]);
    }

    public function getModelDefinitions()
    {
        return [User::class];
    }

}