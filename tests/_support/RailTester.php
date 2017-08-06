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
}
