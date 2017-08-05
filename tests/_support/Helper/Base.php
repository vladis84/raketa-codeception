<?php

namespace Helper;

/**
 * Базовые методы для всех suites
 */
class Base extends \Codeception\Module
{
    protected $requiredFields = ['login', 'password', 'clientId'];

    /**
     * Авторизация.
     * @param int $login
     * @param int $password
     */
    public function login($login = null, $password = null)
    {
        $I = $this->getActor();
        $I->amOnPage('/');

        if (is_null($login) && is_null($password)) {
            $login    = $this->config['login'];
            $password = $this->config['password'];
        }

        $I->fillField('username', $login);
        $I->fillField('password', $password);
        $I->click('[type=submit]');
        $I->seeLink('Выход', '/ru/auth/logout');
    }

    /**
     *
     * @param type $clientId
     */
    public function chooseClient($clientId = null)
    {
        if (is_null($clientId)) {
            $clientId = $this->config['clientId'];
        }

        $I = $this->getActor();

        $I->amOnPage('/selectemployee/selectclient?client=' . $clientId);

        $I->see('Тест IT-отдел', '#subclient_list_link');
    }

    /**
     * @return \Codeception\Module\WebDriver
     */
    private function getActor()
    {
        return $this->getModule('WebDriver');
    }
}
