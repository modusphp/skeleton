<?php

namespace Example\Responder;

use Modus\Responder\Web;

class Index extends Web
{
    public function process(array $results = [])
    {
        $this->template->setLayout('layout');
        $this->template->setView('index');
        $this->template->setData($results);

        $this->useTemplateForContent();
    }
}