<?php

namespace Example\Responder;

use Aura\Payload_Interface\PayloadInterface;
use Modus\Responder\Web;

class Index extends Web
{
    public function process(PayloadInterface $payload)
    {
        $this->template->setLayout('layout');
        $this->template->setView('index');
        $this->template->setData($payload->getOutput());

        $this->useTemplateForContent();
    }
}