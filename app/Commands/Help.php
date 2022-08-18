<?php

namespace Rtmvnv\AutodorBot\Commands;

class Help extends Command
{
    public static function view($session)
    {
        $response = 'Автодор. Сервис оплаты' . PHP_EOL;
        $response .= PHP_EOL;
        $response .= 'Для возврата к началу чата в любой момент отправьте сообщение /start или 0.';
        $keyboard = [
            [
                ['text' => 'Начать заново'],
            ],
        ];

        return self::buildResponse($session, $response, $keyboard);
    }

    public static function controller($session, $request)
    {
        return Start::view($session);
    }
}