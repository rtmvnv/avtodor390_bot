<?php

namespace Rtmvnv\AutodorBot\Commands;

class PaymentMethod extends Command
{
    public function view($error = null)
    {
        $text = $this->context->comment . PHP_EOL;
        $text .= "Комиссия {$this->context->comission}%." . PHP_EOL;
        $text .= "Сумма к оплате {$this->context->sum_gross} руб." . PHP_EOL;
        $text .= PHP_EOL;
        $text .= 'Выберите способ оплаты:' . PHP_EOL;

        $keyboard = [
            [$this->addInlineButton('PaymentMobile', $this->context)],
            [$this->addInlineButton('PaymentCard', $this->context)],
        ];
        $this->sendInlineMessage($text, $keyboard);
    }
}
