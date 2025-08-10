<?php

namespace meowprd\FelinePHP\Http;

/**
 * Represents an HTTP response.
 *
 * Encapsulates the HTTP status code, headers, and body content.
 * Provides a fluent interface for building and sending the response.
 */
class Response
{
    /**
     * @param mixed                  $content    The response body content (string, numeric, or object convertible to string).
     * @param int                    $statusCode HTTP status code (default 200).
     * @param array<string, string>  $headers    HTTP headers as an associative array: ['Header-Name' => 'Value'].
     */
    public function __construct(
        private mixed $content,
        private int $statusCode = 200,
        private array $headers = []
    ) {}

    /**
     * Sets the HTTP status code.
     *
     * @param int $statusCode
     * @return $this
     */
    public function setStatusCode(int $statusCode): self
    {
        $this->statusCode = $statusCode;
        return $this;
    }

    /**
     * Sets or replaces a header.
     *
     * @param string $name
     * @param string $value
     * @return $this
     */
    public function setHeader(string $name, string $value): self
    {
        $this->headers[$name] = $value;
        return $this;
    }

    /**
     * Sets multiple headers at once.
     *
     * @param array<string, string> $headers
     * @return $this
     */
    public function setHeaders(array $headers): self
    {
        foreach ($headers as $name => $value) {
            $this->headers[$name] = $value;
        }
        return $this;
    }

    /**
     * Sets the response body content.
     *
     * @param mixed $content
     * @return $this
     */
    public function setContent(mixed $content): self
    {
        $this->content = $content;
        return $this;
    }

    /**
     * Sends the HTTP response to the client.
     *
     * This method sets the HTTP status code, outputs all headers,
     * and then echoes the response body content.
     *
     * @return void
     */
    public function send(): void
    {
        http_response_code($this->statusCode);
        foreach ($this->headers as $name => $value) {
            header("$name: $value");
        }
        echo $this->content;
    }
}
