<?php


use Codeception\Test\Unit;

class LoginTest extends Unit
{
    /**
     * @var \FunctionalTester
     */
    protected $tester;

    protected function _before()
    {
    }

    protected function _after()
    {
    }

    public function testLogin()
    {
        $this->login();
        $this->tester->see('Pulpit');
    }

    public function testLogout()
    {
        $this->login();
        $this->tester->click('#logout');
        $this->tester->see('Nie wylogowuj mnie');

    }

    private function login()
    {
        $this->tester->amOnPage('/');
        $this->tester->fillField('_username', 'mathil');
        $this->tester->fillField('_password', 'mathil');
        $this->tester->click('_submit');
    }
}