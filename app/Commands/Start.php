<?php

namespace Rtmvnv\AutodorBot\Commands;

class Start extends Command
{
    public static function view($session)
    {
        $response = '<i>(прототип)</i>' . PHP_EOL;
        $response .= 'Баланс транспондера: 748 руб.' . PHP_EOL;
        $response .= 'Задолженность по ЦКАД: 347 руб.' . PHP_EOL;
        $response .=  PHP_EOL;
        $response .=  'Выберите действие' . PHP_EOL;
        $response .= '/1 Транспондер' . PHP_EOL;
        $response .= '/2 ЦКАД' . PHP_EOL;
        $response .= '/3 Аварийный комиссар' . PHP_EOL;
        $response .= '/4 Обратная связь' . PHP_EOL;
        $response .= '/0 О сервисе' . PHP_EOL;

        $keyboard = [
            [
                ['text' => 'Транспондер'],
                ['text' => 'ЦКАД'],
            ], [
                ['text' => 'Аварийный комиссар'],
                ['text' => 'Обратная связь'],
            ],
        ];

        return self::buildResponse($session, $response, $keyboard);
    }

    public static function controller($session, $request)
    {
        switch ($request) {
            case 'Транспондер':
            case '/1':
            case '1':
                return Transponder::view($session);
                break;

            case 'ЦКАД':
            case '/2':
            case '2':
                return Ckad::view($session);
                break;

            case 'Аварийный комиссар':
            case '/3':
            case '3':
                return Emergency::view($session);
                break;

            case 'Обратная связь':
            case '/4':
            case '4':
                return Feedback::view($session);
                break;

            case 'О сервисе':
            case '/help':
            case '/0':
            case '0':
                return Help::view($session);
                break;

            default:
                return self::view($session);
                break;
        }
    }
}
