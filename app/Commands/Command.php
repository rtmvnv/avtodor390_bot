<?php

namespace Rtmvnv\AutodorBot\Commands;

use Rtmvnv\AutodorBot\Chat;
use Rtmvnv\AutodorBot\Request;

abstract class Command
{
    protected $chat;
    protected $context;

    public function __construct(Chat $chat, $context)
    {
        $this->chat = $chat;
        $this->context = (object)$context;
    }

    public function view()
    {
    }

    public function handle($request)
    {

    }

    protected function addInlineButton($class, $context)
    {
        $button = new ('\\Rtmvnv\\AutodorBot\\Buttons\\' . $class)($this->chat, $context);
        $this->chat->addCallback($button->callbackData(), $class, $context);

        return [
            'text' => $button->caption(),
            'callback_data' => $button->callbackData(),
        ];
    }

    protected function addReplyButton($caption)
    {
        return ['text' => $caption];
    }

    protected function addGlobalCommand($request, $class, $context)
    {
        $this->chat->addGlobalCommand($request, $class, $context);

        return ['text' => $request];
    }

    protected function sendCommandMessage($text, $keyboard)
    {
        Request::sendCommandMessage($this->chat, $text, $keyboard);
        $this->chat->setCurrentCommand((new \ReflectionClass($this))->getShortName(), $this->context);
    }

    protected function sendInlineMessage($text, $keyboard)
    {
        $this->chat->unsetCurrentCommand();
        Request::sendInlineMessage($this->chat, $text, $keyboard);
    }
}