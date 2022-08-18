<?php

namespace Rtmvnv\AutodorBot\Commands;

abstract class Command
{
    public static function view($session)
    {
        $response = 'This command is not implemented yet';
        $keyboard = [
            [
                ['text' => 'Button1'],
                ['text' => 'Button2'],
            ], [
                ['text' => 'Button3'],
            ],
        ];

        return self::buildResponse($session, $response, $keyboard);
    }

    public static function controller($session, $request)
    {
        return self::view($session);
    }

    protected static function buildResponse($session, $text, $keyboard = [])
    {
        $message = [
            'text' => $text,
            'reply_markup' => [],
            'parse_mode' => 'HTML',
        ];

        if (empty($keyboard)) {
            // $message['reply_markup']['remove_keyboard'] = true;
        } else {
            // $message['reply_markup']['resize_keyboard'] = true;
            // $message['reply_markup']['one_time_keyboard'] = true;
            // $message['reply_markup']['keyboard'] = $keyboard;
            $message['reply_markup']['inline_keyboard'] = [
                [
                    ['text' => 'test', 'callback_data' => 'someString']
                ]
            ];
        }

        return [
            $session,
            (new \ReflectionClass(get_called_class()))->getShortName(),
            $message,
        ];
    }
}