<?php
namespace meowprd\FelinePHP\Exceptions\Http;

use meowprd\FelinePHP\Exceptions\HttpException;
use meowprd\FelinePHP\Http\Response;

/**
 * Exception thrown when no matching route is found for the HTTP request.
 *
 * This exception can handle itself by returning a 404 HTTP response.
 */
class RouteNotFoundException extends HttpException
{
    /**
     * Handles the exception by returning an HTTP 404 response.
     *
     * @return Response HTTP response with 404 status code and exception message as content.
     */
    public function handle(): Response
    {
        return new Response($this->getMessage(), 404);
    }
}
