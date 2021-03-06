<?php

$I = new RailTester($scenario);
$I->wantToTest('Тестируем поиск ЖД билетов поиставщика УФС');

// Подготовительные действия.
$I->expectTo('Вход на сайт');
$I->login();
$I->expectTo('Выбор клиента');
$I->chooseClient();
$I->expectTo('Переход на страницу поска ЖД билетов');
$I->amGoToLookRailTicket();

// Проверяем, что попали на нужный контроллер.
$I->expectTo('выбран нужный поставщик');
$I->seeInCurrentUrl('urail');
$I->seeStepActive('Маршрут');

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
$I->seeStepActive('Поезд');
$I->expectTo('Выбор поезда');
$I->seeTrain('№ 089У');
$I->chooseTrain('089');
$I->seeStepActive('Вагон');

// Выбор вагона.
$I->seeStepActive('Вагон');
$I->expectTo('Выбор вагона');
$I->seeCarriage('12');
$I->seeCarriageSchema('FPK_3/4_V1');
$I->chooseCarriage('123Л');

// Ввод пассажиров
$I->seeStepActive('Пассажиры');