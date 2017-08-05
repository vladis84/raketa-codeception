<?php

class mainCest
{

    public function _before(RailTester $I)
    {
        $I->login();
        $I->chooseClient();
    }

    public function _after(RailTester $I)
    {

    }

    // tests
    public function tryToTest(RailTester $I)
    {
        $I->wantToTest('Переход по ссылке rail');
        
        $I->click('[href="/ru/search"]');

        $I->seeElement('[href="/ru/search/rail"]');

        $I->click('[href="/ru/search/rail"]');

        $I->amOnPage('/ru/urail/search');
    }
}
