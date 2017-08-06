<?php

namespace Helper;

/**
 * Базовые методы для всех suites
 */
class BaseHelper extends \Codeception\Module
{
    protected $requiredFields = ['login', 'password', 'client'];

    /**
     * Авторизация.
     * @param int $login
     * @param int $password
     */
    public function login($login = null, $password = null)
    {
        $I = $this->getWebDriver();
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
     * @param type $client
     */
    public function chooseClient($client = null)
    {
        if (is_null($client)) {
            $client = $this->config['client'];
        }

        $I = $this->getWebDriver();

        $I->click('#subclient_list_link');
        $this->fillQsearch('#select_client_name', $client);
        $I->waitForText($client, 30, '#subclient_list_link');
        $I->see($client, '#subclient_list_link');
    }

    /**
     * Заполнение поля Qsearch.
     * @param string $selector
     * @param string $text
     */
    public function fillQsearch($selector, $text)
    {
        $I = $this->getWebDriver();

        $I->fillField($selector, $text);

        $I->waitForElement("//a[contains(text(),'{$text}')]");

        $I->click("//a[contains(text(),'{$text}')]");
    }

    /**
     * @return \Codeception\Module\WebDriver
     */
    protected function getWebDriver()
    {
        /* @var $module \Codeception\Module\WebDriver */
        $module = $this->getModule('WebDriver');

        if (!$module->webDriver) {
            $module->_initializeSession();
        }

        return $module;
    }
}
