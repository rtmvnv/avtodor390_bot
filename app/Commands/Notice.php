<?php

namespace Rtmvnv\AutodorBot\Commands;

class Notice extends Command
{
    public function view()
    {
        $this->sendInlineMessage(
            $this->context->notice,
            [
                [
                    $this->addInlineButton(
                        $this->context->class,
                        isset($this->context->saved_context)?$this->context->saved_context:null
                    )
                ]
            ]
        );
    }
}
