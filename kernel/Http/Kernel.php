<?php

namespace meowprd\FelinePHP\Http;

/**
 * Application kernel.
 *
 * The kernel is responsible for handling an incoming HTTP request
 * and producing an HTTP response.
 */
class Kernel
{
    /**
     * Handles an HTTP request and returns a response.
     *
     * @param Request $request The HTTP request object.
     * @return Response The HTTP response object.
     */
    public function handle(Request $request): Response
    {
        $content = 'hello, world!';
        return new Response($content);
    }
}
