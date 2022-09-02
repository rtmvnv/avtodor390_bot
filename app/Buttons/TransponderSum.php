<?php

namespace Rtmvnv\AutodorBot\Buttons;

use Rtmvnv\AutodorBot\Commands\TransponderSum as TransponderSumCommand;

class TransponderSum extends Button
{
    public function caption()
    {
        return 'Пополнить транспондер ' . $this->context->account;
    }

    public function callbackData()
    {
        return 'transponder_sum_' . $this->context->account;
    }

    public function handle()
    {
        (new TransponderSumCommand(
            $this->chat,
            ['account' => $this->context->account]
        ))->view();
    }
}
