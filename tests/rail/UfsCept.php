<?php

$I = new RailTester($scenario);
$I->wantToTest('Тестируем поиск ЖД билетов поиставщика УФС');

// Подготовительные действия.
$I->login();
$I->expectTo('Выбор клиента');
$I->chooseClient();
$I->expectTo('Переход на страницу поска ЖД билетов');
$I->amGoToLookRailTicket();

// Проверяем, что попали на нужный контроллер.
$I->expectTo('выбран нужный поставщик');
$I->seeInCurrentUrl('urail');

// Валидация формы маршрута пассажира.
$I->expectTo('Валидация формы маршрута пассажира');
$I->dontSeeElement('.errors');
$I->click('#findTicket');
$I->seeElement('.errors');

// Просмотр списка поездов.
$I->expectTo('Просмотр списка поездов');
$I->dontSeeElement('.report-trains');
$I->fillPassengerRoute('Екатеринбург', 'Москва', '2017-08-20');
$I->seeElement('.report-trains');

// Выбор поезда.
$I->expectTo('Выбор поезда');
$I->seeElement("//*[contains(text(), '№ 089У')]");
$I->click("//a[contains(@href, 'flightNumber=089')]");