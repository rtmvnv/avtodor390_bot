<?php

namespace Rtmvnv\AutodorBot;

use Rtmvnv\AutodorBot\Storage;
use Rtmvnv\AutodorBot\Request;

class Bot
{
    protected $storage;

    public function __construct()
    {
        $this->storage = new Storage();
    }

    public function runOnce()
    {
        try {
            $updates = $this->getUpdates();

            foreach ($updates as $update) {
                $this->handleUpdate($update);
            }
        } catch (\Throwable $th) {
            echo 'EXCEPTION: ' . $th->getMessage() . ' (' . $th->getFile() . ':' . $th->getLine() . ')' . PHP_EOL . PHP_EOL;
        }
    }

    protected function handleUpdate($update)
    {
        $this->storage->setOffset($update->update_id);

        if (isset($update->message)) {
            $this->handleCommand($update);
        } elseif (isset($update->callback_query)) {
            $this->handleButton($update);
        }
    }

    protected function handleCommand($update)
    {
        $text = mb_strtolower(trim($update->message->text));

        echo "INCOMING COMMAND: {$text}" . PHP_EOL . PHP_EOL;

        // Get chat data
        $chat = $this->storage->getChat($update->message->chat->id);

        // Look for a global command
        foreach ($chat->getGlobalCommands() as $key => $value) {
            if (mb_strtolower($key) == $text or '/' . mb_strtolower($key) == $text) {
                echo 'CALLING HANDLER ' . $value->class . PHP_EOL . PHP_EOL;
                $handler = new ('\\Rtmvnv\\AutodorBot\\Commands\\' . $value->class)($chat, $value->context);
                $handler->view($update->message->text);
                $this->storage->setChat($chat);
                return;
            }
        }

        // Invoke the current command handler
        if ($chat->getCurrentCommand() !== false) {
            echo 'CALLING CURRENT ' . $chat->getCurrentCommandClass() . PHP_EOL . PHP_EOL;
            $handler = new ($chat->getCurrentCommandClass())($chat, $chat->getCurrentCommandContext());
            $handler->handle($update->message->text);
            $this->storage->setChat($chat);
            return;
        }
    }

    protected function handleButton($update)
    {
        echo 'INCOMING BUTTON CALLBACK: ' . Helpers::print_json($update, true) . PHP_EOL . PHP_EOL;

        // Confirm Telegram that request is received
        Request::answerCallbackQuery($update->callback_query->id);

        $chat = $this->storage->getChat($update->callback_query->message->chat->id);

        $text = mb_strtolower($update->callback_query->data);
        foreach ($chat->getCallbacks() as $key => $value) {
            if (mb_strtolower($key) == $text or '/' . mb_strtolower($key) == $text) {
                // If callback is awaited
                $class = $value->class;
                echo 'exists: ' . $text . '; class name:' . $class . PHP_EOL;

                $handler = new ('\\Rtmvnv\\AutodorBot\\Buttons\\' . $class)($chat, $value->context);
                $handler->handle();
                $this->storage->setChat($chat);
                return;
            }
        }

        echo 'does not exist: ' . $text . PHP_EOL;
    }

    protected function getUpdates()
    {
        return Request::getUpdates($this->storage->getOffset() + 1);
    }
}
