<?php

namespace Rtmvnv\AutodorBot\Commands;

use Rtmvnv\AutodorBot\Commands\TransponderAdd2;

class TransponderAdd extends Command
{
    public function view($error = null)
    {
        if (empty($error)) {
            $text = 'Добавление транспондера' . PHP_EOL;
        } else {
            $text = $error . PHP_EOL;
        }
        $text .= PHP_EOL;
        $text .= 'Введите номер лицевого счета транспондера:' . PHP_EOL;
        $text .= "\u{2328}\u{1F4BD}\u{2795}";

        $this->sendCommandMessage($text, null);
    }

    public function handle($request)
    {
        $sum = filter_var($request, FILTER_VALIDATE_INT, ['options' => ['min_range' => 0]]);
        if ($sum === false) {
            $this->view('Некорректный номера лицевого счета транспондера.');
            return;
        }

        $this->context->account = $request;
        (new TransponderAdd2($this->chat, $this->context))->view();
    }
}
