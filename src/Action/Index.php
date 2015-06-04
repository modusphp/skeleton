<?php

namespace Example\Action;

use Aura\Payload\Payload;

class Index
{
    public function index()
    {
        $payload = new Payload();
        $payload->setOutput(['statement' => 'Modus Framework']);
        return $payload;

    }
}