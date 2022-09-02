<?php
namespace Rtmvnv\AutodorBot;

use Rtmvnv\AutodorBot\Chat;

class Storage
{
    protected $storage = null; // Decoded storage
    protected $chats = []; // Object pool for chat instances

    protected function read()
    {
        $this->storage = json_decode(@file_get_contents($_ENV['STORAGE_FILE']));
        if (empty($this->storage)) {
            $this->storage = (object)[];
            $this->storage->offset = 0;
            $this->storage->chats = (object)[];
        }
    }

    public function write()
    {
        $result = file_put_contents(
            $_ENV['STORAGE_FILE'],
            json_encode($this->storage, JSON_PRETTY_PRINT |  JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES)
        );
        if ($result === false) {
            throw new Exception("Error writing storage", 1);
        }
    }

    public function getOffset()
    {
        $this->read();
        return $this->storage->offset;
    }

    public function setOffset($value)
    {
        $this->read();
        $this->storage->offset = $value;
        $this->write();
    }

    public function getChat($chatId)
    {
        $this->read();

        // If there is no such chat in storage create a new chat
        if (!isset($this->storage->chats->$chatId)) {
            return Chat::newChat($chatId);
        }

        // If an instance of chat doesn't exist yet in the object pool - create one
        if (!isset($this->chats[$chatId])) {
            $this->chats[$chatId] = new Chat($this->storage->chats->$chatId);
        }

        return $this->chats[$chatId];
    }

    public function setChat(Chat $chat)
    {
        $this->read();
        $chatId = $chat->getChatId();
        $this->storage->chats->$chatId = $chat->getRaw();
        $this->write();
        echo 'SAVED CHAT: ' . json_encode($chat->getRaw(), JSON_PRETTY_PRINT |  JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES) . PHP_EOL . PHP_EOL;

    }
}
