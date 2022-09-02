<?php

namespace Rtmvnv\AutodorBot\Buttons;

use Rtmvnv\AutodorBot\Chat;

abstract class Button
{
    protected $chat;
    protected $context;

    abstract public function caption();
    abstract public function callbackData();
    abstract public function handle();

    public function __construct(Chat $chat, $context)
    {
        $this->chat = $chat;
        $this->context = (object)$context;
    }

    protected function unsetCallback()
    {
        $this->chat->unsetCallback($this->callbackData());
    }
}