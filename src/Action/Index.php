<?php

namespace Example\Action;

use Aura\Payload\Payload;

class Index
{
    public function __invoke()
    {
        $payload = new Payload();
        $payload->setOutput(['statement' => 'Modus Framework']);
        return $payload;

    }
}