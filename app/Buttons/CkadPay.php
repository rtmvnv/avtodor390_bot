<?php

namespace Rtmvnv\AutodorBot\Buttons;

use Rtmvnv\AutodorBot\Commands\PaymentMethod;

class CkadPay extends Button
{
    public function caption()
    {
        return "Оплатить {$this->context->sum_nett} руб. за {$this->context->vehicle}";
    }

    public function callbackData()
    {
        return "ckad_pay_{$this->context->vehicle}";
    }

    public function handle()
    {
        (new PaymentMethod($this->chat, $this->context))->view();
    }
}
