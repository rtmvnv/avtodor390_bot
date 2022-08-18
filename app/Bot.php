<?php

namespace Rtmvnv\AutodorBot;

use stdClass;

class Bot
{
    protected $storage;

    function __construct()
    {
        $this->storage = json_decode(@file_get_contents(getcwd() . DIRECTORY_SEPARATOR . 'storage.json'));
        if (empty($this->storage)) {
            $this->storage = new stdClass();
            $this->storage->offset = 0;
            $this->storage->chats = new stdClass();
        }
    }

    public function runOnce()
    {
        try {
            $updates = $this->getUpdates();

            foreach ($updates as $update) {

                if (isset($update['message'])) {
                    $this->respondMessage($update);
                } elseif (isset($update['callback_query']))
                {
                    $this->respondCallbackQuery($update);
                }

            }
        } catch (\Throwable $th) {
            echo 'EXCEPTION: ' . $th->getMessage() . ' (' . $th->getFile() . ':' . $th->getLine() . ')' . PHP_EOL . PHP_EOL;
        }
    }

    protected function respondMessage($update)
    {
        $text = trim($update['message']['text']);

        // echo json_encode($update, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES) . PHP_EOL . PHP_EOL;
        echo "NEW UPDATE: {$text}" . PHP_EOL . PHP_EOL;

        $this->storage->offset = $update['update_id'];

        // Get chat session data
        $chatId = $update['message']['chat']['id'];
        if (empty($this->storage->chats->$chatId)) {
            $this->storage->chats->$chatId = new stdClass;
            $this->storage->chats->$chatId->command = 'Start';
            $this->storage->chats->$chatId->session = [];
        }
        $chat = $this->storage->chats->$chatId;

        $this->writeStorage();

        // Firstly process global commands
        if ($text === '/start') {
            $commandName = 'Start';
        } elseif ($text === '0') {
            $commandName = 'Start';
        } elseif ($text === '/transponder') {
            $commandName = 'Transponder';
        } elseif ($text === '/ckad') {
            $commandName = 'Ckad';
        } elseif ($text === '/emergency') {
            $commandName = 'Emergency';
        } elseif ($text === '/feedback') {
            $commandName = 'Feedback';
        } elseif ($text === '/help') {
            $commandName = 'Help';
        } else {
            $commandName = isset($chat->command) ? $chat->command : 'Start';
        }

        echo 'CALLING ' . $commandName . '::controller()' . PHP_EOL . PHP_EOL;
        list(
            $this->storage->chats->$chatId->session,
            $this->storage->chats->$chatId->command,
            $message,
        ) = call_user_func(__NAMESPACE__ . '\\Commands\\' . $commandName . '::controller', $chat->session, $text);

        $this->writeStorage();

        $message['chat_id'] = $chatId;
        $this->makeRequest('sendMessage', $message);
    }

    protected function respondCallbackQuery($update)
    {
        print_r($update);
    }
    
    protected function writeStorage()
    {
        $result = file_put_contents(
            getcwd() . DIRECTORY_SEPARATOR . 'storage.json',
            json_encode($this->storage, JSON_PRETTY_PRINT |  JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES)
        );
        echo 'SAVED STORAGE: ' . json_encode($this->storage, JSON_PRETTY_PRINT |  JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES) . PHP_EOL . PHP_EOL;
    }

    protected function getUpdates()
    {
        $data = [
            'offset' => $this->storage->offset + 1,
            'allowed_updates' => ['message', 'callback_query'],
        ];
        return $this->makeRequest('getUpdates', $data);
    }

    protected function makeRequest($command, $data = null)
    {
        // if ($command != 'getUpdates') {
            echo 'REQUEST: ' . json_encode(['command' => $command, 'data' => $data], JSON_PRETTY_PRINT |  JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES) . PHP_EOL . PHP_EOL;
        // }

        $token = $_ENV['TELEGRAM_TOKEN'];
        $url = "https://api.telegram.org/bot{$token}/";

        $client = new \GuzzleHttp\Client();
        $response = $client->request('POST', $url . $command, [
            'json' => $data,
            'headers' => [
                'Accept'     => 'application/json',
            ]
        ]);

        if ($response->getStatusCode() != 200) {
            throw new Exception("HTTP status code <> 200", 1);
        }
        $result = json_decode($response->getBody(), true, 100, JSON_THROW_ON_ERROR | JSON_OBJECT_AS_ARRAY);
        if (!$result) {
            throw new Exception("Can't decode JSON from result", 1);
        }
        if (!$result['ok']) {
            throw new Exception("Result is not OK", 1);
        }
        return $result['result'];
    }
}
