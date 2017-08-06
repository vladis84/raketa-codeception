<?php

/**
 * Inherited Methods
 * @method void wantToTest($text)
 * @method void wantTo($text)
 * @method void execute($callable)
 * @method void expectTo($prediction)
 * @method void expect($prediction)
 * @method void amGoingTo($argumentation)
 * @method void am($role)
 * @method void lookForwardTo($achieveValue)
 * @method void comment($description)
 * @method \Codeception\Lib\Friend haveFriend($name, $actorClass = NULL)
 *
 * @SuppressWarnings(PHPMD)
 */
class RailTester extends \Codeception\Actor
{

    use _generated\RailTesterActions;

    /**
     * Заполнение маршрута пассажира (откуда, куда, когда).
     * @param string  $departureStation Станция отправления
     * @param string  $arrivalStation   Станция прибытия
     * @param string  $departureDate    Дата отправления
     */
    public function fillPassengerRoute($departureStation, $arrivalStation, $departureDate)
    {
        $I = $this;

        $I->fillQsearch('#departureStationName', $departureStation);

        $I->fillQsearch('#arrivalStationName', $arrivalStation);

        $I->executeJS("$('[name*=departureDate]').val('{$departureDate}')");

        $I->click('#findTicket');
    }

    /**
     * Переход на страницу поиска ЖД билетов
     */
    public function amGoToLookRailTicket()
    {
        $I = $this;

        $I->click('[href="/ru/search"]');

        $I->seeElement('[href="/ru/search/rail"]');

        $I->click('[href="/ru/search/rail"]');
    }

    /**
     * Проверяем что находимся на нужном шаге ()
     * @param string $step Название шага
     */
    public function seeStepActive($step)
    {
        $I = $this;

        $I->see($step, '.railway-step .active');
    }

    /**
     * @param string $flightNumber
     */
    public function seeTrain($flightNumber)
    {
        $I = $this;

        $I->seeElement("//*[contains(text(), '{$flightNumber}')]");
    }

    /**
     * @param string $carriageNumber
     */
    public function seeCarriage($carriageNumber)
    {
        $I = $this;

        $I->seeElement("//*[contains(text(), '{$carriageNumber}')]");
    }



    /**
     * Выбор поезда.
     * @param string $flightNumber
     */
    public function chooseTrain($flightNumber)
    {
        $I = $this;

        $I->click("//a[@class='nextStep' and contains(@href, 'flightNumber={$flightNumber}')]");
    }

    /**
     * Выбор поезда.
     * @param string $carriageNumber
     */
    public function chooseCarriage($carriageNumber)
    {
        $I = $this;

        $escapedCarriageNumber = urlencode($carriageNumber);

        $I->click("//a[contains(@href, '{$escapedCarriageNumber}')]");
    }

    /**
     * Проверяем схему вагона.
     * 
     * @param string $code
     */
    public function seeCarriageSchema($code)
    {
        $I = $this;

        $I->seeElement("g[data-name='{$code}']");
    }
}
