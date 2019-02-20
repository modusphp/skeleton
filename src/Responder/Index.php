<?php

namespace Example\Responder;

use Aura\Payload_Interface\PayloadInterface;
use Aura\View\View;
use Modus\Response\Response;
use Modus\Response\Interfaces\HtmlGenerator;

class Index implements HtmlGenerator
{
    public function __construct(
        View $template
    ) {
        $this->template = $template;
    }

    public function checkContentResponseType()
    {
        return [
            'text/html' => 'generateHtml',
        ];
    }

    public function generateHtml(PayloadInterface $payload)
    {
        $this->template->setLayout('layout');
        $this->template->setView('index');
        $this->template->setData($payload->getOutput());

        $response = new \Zend\Diactoros\Response\HtmlResponse($this->template->__invoke());
        return $response;
    }
}
