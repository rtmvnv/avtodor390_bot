<?php

namespace Rtmvnv\AutodorBot;

class Chat
{
    protected $chat;

    public static function newChat($chatId)
    {
        $data = (object)[];
        $data->chat_id = $chatId;
        $data->callbacks = (object)[];
        $data->global_commands = (object)[];
        $data->current_command = (object)[];
        $data->current_command->class = 'Start';
        $data->current_command->context = null;
        return new Chat($data);
    }

    public function __construct($chat = null)
    {
        $this->chat = $chat;
    }

    public function getRaw()
    {
        return $this->chat;
    }

    public function getChatId()
    {
        return $this->chat->chat_id;
    }

    public function getCurrentCommand()
    {
        return $this->chat->current_command;
    }

    public function setCurrentCommand($class, $context)
    {
        $this->chat->current_command = (object)[];
        $this->chat->current_command->class = $class;
        $this->chat->current_command->context = $context;
    }

    public function unsetCurrentCommand()
    {
        return $this->chat->current_command = false;
    }

    public function getCurrentCommandClass()
    {
        return __NAMESPACE__ . '\\Commands\\' . $this->chat->current_command->class;
    }

    public function getCurrentCommandContext()
    {
        return $this->chat->current_command->context;
    }

    public function getCallbacks()
    {
        return $this->chat->callbacks;
    }

    public function addCallback($callbackData, $class, $context)
    {
        $this->chat->callbacks->$callbackData = (object)[];
        $this->chat->callbacks->$callbackData->class = $class;
        $this->chat->callbacks->$callbackData->context = $context;
    }

    public function unsetCallback($callbackData)
    {
        unset($this->chat->callbacks->$callbackData);
    }

    public function unsetAllCallbacks()
    {
        return $this->chat->callbacks = (object)[];
    }

    public function getGlobalCommands()
    {
        return $this->chat->global_commands;
    }

    public function addGlobalCommand($request, $class, $context)
    {
        $this->chat->global_commands->$request = (object)[];
        $this->chat->global_commands->$request->class = $class;
        $this->chat->global_commands->$request->context = $context;
    }
}
