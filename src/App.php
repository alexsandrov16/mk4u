<?php

namespace Mk4U;

use Mk4U\Http\Request;
use Mk4U\Http\Response;

/**
 * undocumented class
 */
final class App
{
    public function request() : Request
    {
        return new Request();
    }

    public function response() : Response
    {
        return new Response;
    }
}
