<?php

namespace Rtmvnv\AutodorBot\Commands;

use Rtmvnv\AutodorBot\Commands\PaymentMethod;

class TransponderSum extends Command
{
    public function view($error = null)
    {
        if (empty($error)) {
            $text = 'Пополнение транспондера ' . $this->context->account . PHP_EOL;
        } else {
            $text = $error . PHP_EOL;
        }
        $text .= PHP_EOL;
        $text .= 'Введите сумму от 100 руб.:' . PHP_EOL;

        $this->sendCommandMessage($text, null);
    }

    public function handle($request)
    {
        $sum = filter_var($request, FILTER_VALIDATE_INT);
        if ($sum === false) {
            return $this->view('Некорректная сумма');
        }

        if ($sum < 100) {
            return $this->view('Сумма должна быть не меньше 100 руб.');
        }

        if ($sum > 15000) {
            return $this->view('Сумма должна быть не больше 15.000 руб.');
        }

        $this->context->purpose = 'transponder';
        $this->context->sum_nett = $sum;
        $this->context->comission = 2;
        $this->context->sum_gross = $sum * (100 + $this->context->comission) / 100;
        $this->context->comment = "Пополнение баланса транспондера {$this->context->account}.";

        (new PaymentMethod($this->chat, $this->context))->view();
    }
}
