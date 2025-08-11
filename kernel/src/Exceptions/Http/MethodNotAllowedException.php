<?php
namespace meowprd\FelinePHP\Exceptions\Http;

use meowprd\FelinePHP\Exceptions\HttpException;
use meowprd\FelinePHP\Http\Response;

/**
 * Exception thrown when the HTTP method used in the request
 * is not allowed for the targeted route.
 *
 * This exception can handle itself by returning a 405 HTTP response.
 */
class MethodNotAllowedException extends HttpException
{
    /**
     * Handles the exception by returning an HTTP 405 response.
     *
     * @return Response HTTP response with 405 status code and exception message as content.
     */
    public function handle(): Response
    {
        return new Response($this->getMessage(), 405);
    }
}
