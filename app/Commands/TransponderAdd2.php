<?php

namespace Rtmvnv\AutodorBot\Commands;

use Rtmvnv\AutodorBot\Commands\Notice;

class TransponderAdd2 extends Command
{
    public function view($error = null)
    {
        if (!empty($error)) {
            $text = $error . PHP_EOL . PHP_EOL;
        }
        $text .= 'Введите последние 4 цифры номера транспондера:' . PHP_EOL;

        $this->sendCommandMessage($text, null);
    }

    public function handle($request)
    {
        $sum = filter_var($request, FILTER_VALIDATE_INT, ['options' => ['min_range' => 1000, 'max_range' => 9999]]);
        if ($sum === false) {
            $this->view('Некорректный ввод.');
            return;
        }

        (new Notice(
            $this->chat,
            [
                'notice' => 'Договор и транспондер не найдены. Обратитесь по телефону <a href="https://avtodor-tr.ru/ru/kompaniya/kontakty/">*2323</a>',
                'class' => 'Transponders'
            ]
        ))->view();
    }
}
