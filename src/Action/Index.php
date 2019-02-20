<?php

namespace Example\Action;

use Aura\Payload\Payload;
use Psr\Http\Message\ServerRequestInterface;

class Index
{
    protected $request;

    public function __construct(ServerRequestInterface $request)
    {
        $this->request = $request;
    }

    public function __invoke()
    {
        $payload = new Payload();
        $payload->setOutput(['statement' => 'Modus Framework']);
        return $payload;

    }
}
