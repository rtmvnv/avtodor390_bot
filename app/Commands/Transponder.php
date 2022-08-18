<?php

namespace Rtmvnv\AutodorBot\Commands;

class Transponder extends Command
{
    public static function view($session)
    {
        $response = '<b>Транспондеры</b>' . PHP_EOL;
        $response .= 'Баланс транспондера 983247: <b>420 руб.</b>' . PHP_EOL;
        $response .= 'Баланс транспондера 648304: <b>328 руб.</b>' . PHP_EOL;
        $response .= PHP_EOL;
        $response .= 'Выберите действие:' . PHP_EOL;
        $response .= '/1 Пополнить 983247' . PHP_EOL;
        $response .= '/2 Пополнить 648304' . PHP_EOL;
        $response .= '/8 Добавить транспондер' . PHP_EOL;
        $response .= '/9 Удалить транспондер';

        $keyboard = [
            [
                ['text' => '1'],
                ['text' => '2'],
            ], [
                ['text' => 'Добавить'],
                ['text' => 'Удалить'],
                ['text' => 'Назад'],
            ],
        ];

        return self::buildResponse($session, $response, $keyboard);
    }

    public static function controller($session, $request)
    {
        switch ($request) {
            case '/1':
            case '1':
                return Start::view($session);
                break;

            case '/2':
            case '2':
                return Start::view($session);
                break;

            case 'Добавить транспондер':
            case '/8':
            case '8':
                return Start::view($session);
                break;

            case 'Удалить транспондер':
            case '/9':
            case '9':
                return Start::view($session);
                break;

            default:
                return self::view($session);
                break;
        }
    }
}