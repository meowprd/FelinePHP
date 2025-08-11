<?php
namespace meowprd\FelinePHP\Exceptions;

use meowprd\FelinePHP\Http\Response;

/**
 * Base HTTP exception class.
 *
 * Provides a default handler to generate an HTTP response
 * with the exception message and status code.
 */
class HttpException extends \Exception
{
    /**
     * Handle the exception by returning an HTTP response.
     *
     * The response content is a JSON string containing the error message.
     * If the exception code is not set, defaults to HTTP 500 status code.
     *
     * @return Response HTTP response containing JSON error message.
     */
    public function handle(): Response
    {
        $statusCode = $this->getCode() ?: 500;
        $content = [
            'error' => $this->getMessage(),
        ];

        $json = json_encode($content, JSON_UNESCAPED_UNICODE);

        return new Response($json, $statusCode, ['Content-Type' => 'application/json']);
    }
}
