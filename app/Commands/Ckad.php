<?php

namespace Rtmvnv\AutodorBot\Commands;

class Ckad extends Command
{
    public static function view($session)
    {
        $response = 'Задолженность для автомобиля А123ВС123 - 120 руб.' . PHP_EOL;
        $response .= 'Задолженность для автомобиля В234СН234 - 227 руб.' . PHP_EOL;
        $response .= PHP_EOL;
        $response .= 'Выберите задолженность для оплаты:' . PHP_EOL;
        $response .= '/1 Оплатить все' . PHP_EOL;
        $response .= '/2 Оплатить А123ВС123' . PHP_EOL;
        $response .= '/3 Оплатить В234СН234' . PHP_EOL;
        $response .= '/8 Добавить автомобиль';
        $response .= '/9 Удалить автомобиль';

        $keyboard = [
            [
                ['text' => '1'],
                ['text' => '2'],
                ['text' => '3'],
            ], [
                ['text' => 'Добавить автомобиль'],
                ['text' => 'Удалить автомобиль'],
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

            case 'Добавить автомобиль':
            case '/8':
            case '8':
                return Start::view($session);
                break;

            case 'Удалить автомобиль':
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