<?php

namespace Rtmvnv\AutodorBot\Commands;

class Feedback extends Command
{
    public static function view($session)
    {
        $response = 'Запрос на обратную связь принят, Вам скоро перезвонят...';
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