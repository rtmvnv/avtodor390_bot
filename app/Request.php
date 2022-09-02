<?php

namespace Rtmvnv\AutodorBot;

use Rtmvnv\AutodorBot\Chat;

class Request
{
    public static function setMyCommands($commands, $optional = [])
    {
        return self::request(
            'setMyCommands',
            array_merge($optional, ['commands' => $commands])
        );
    }

    public static function answerCallbackQuery($callback_query_id, $optional = [])
    {
        return self::request(
            'answerCallbackQuery',
            array_merge($optional, ['callback_query_id' => $callback_query_id])
        );
    }

    public static function deleteMessage(Chat $chat, $message_id)
    {
        return self::request(
            'deleteMessage',
            ['chat_id' => $chat->getChatId(), 'message_id' => $message_id]
        );
    }

    public static function sendCommandMessage(Chat $chat, $text, $keyboard = [])
    {
        $message = (object)[];
        $message->chat_id = $chat->getChatId();
        $message->text = $text;
        $message->parse_mode = 'HTML';
        $message->reply_markup = (object)[];

        if (empty($keyboard)) {
            $message->reply_markup->remove_keyboard = true;
        } else {
            $message->reply_markup->resize_keyboard = true;
            $message->reply_markup->one_time_keyboard = true;
            $message->reply_markup->keyboard = $keyboard;
        }

        $response = self::request('sendMessage', $message);
        return $response->message_id;
    }

    public static function sendInlineMessage(Chat $chat, $text, $keyboard = [])
    {
        $message = (object)[];
        $message->chat_id = $chat->getChatId();
        $message->text = $text;
        $message->parse_mode = 'HTML';
        $message->reply_markup = (object)[];
        if (!empty($keyboard)) {
            $message->reply_markup->inline_keyboard = $keyboard;
        }

        $response = self::request('sendMessage', $message);
        return $response->message_id;
    }

    public static function sendMessage($message)
    {
        return self::request('sendMessage', $message);
    }

    public static function getUpdates($offset)
    {
        return self::request('getUpdates', [
            'offset' => $offset,
            'allowed_updates' => ['message', 'callback_query'],
        ]);
    }

    public static function request($command, $body = null)
    {
        if ($command != 'getUpdates') {
            echo 'OUTGOING_REQUEST: ' . json_encode(['command' => $command, 'body' => $body], JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES) . PHP_EOL . PHP_EOL;
        }

        $token = $_ENV['TELEGRAM_TOKEN'];
        $url = "https://api.telegram.org/bot{$token}/";

        $client = new \GuzzleHttp\Client();
        $response = $client->request('POST', $url . $command, [
            'json' => $body,
            'headers' => [
                'Accept' => 'application/json',
            ]
        ]);

        if ($response->getStatusCode() != 200) {
            throw new Exception("HTTP status code <> 200", 1);
        }
        $result = json_decode($response->getBody(), false, 100, JSON_THROW_ON_ERROR);
        if (!$result) {
            throw new Exception("Can't decode JSON from result", 1);
        }
        if (!$result->ok) {
            throw new Exception("Result is not OK", 1);
        }

        if ($command != 'getUpdates') {
            echo 'OUTGOING_RESPONSE: ' . Helpers::print_json($result, true) . PHP_EOL . PHP_EOL;
        }
        return $result->result;
    }
}
