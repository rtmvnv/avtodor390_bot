<?php

namespace Rtmvnv\AutodorBot\Buttons;

use Rtmvnv\AutodorBot\Commands\Feedback as FeedbackCommand;

class Feedback extends Button
{
    public function caption()
    {
        return "\u{1F4DE} Обратная связь";
    }

    public function callbackData()
    {
        return 'feedback';
    }

    public function handle()
    {
        (new FeedbackCommand($this->chat, null))->view();
    }
}