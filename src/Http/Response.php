<?php

namespace Nhivonfq\Unlock\Http;


class Response
{
    public const HTTP_OK = 200;
    public const HTTP_NOT_FOUND = 404;
    public const HTTP_BAD_REQUEST = 503;
    public const HTTP_INTERNAL_SERVER_ERROR = 500;
    public const HTTP_UNAUTHENTIC = 401;
    public const HTTP_UNAUTHORIZED = 403;

    private ?string $template = null;
    private int $statusCode;
    private ?string $redirectUrl = null;
    private ?array $data = null;
    private array $headers = [];

    /**
     * @param array $data
     * @param int $statusCode
     * @return $this
     */

    public function toJson(array $data, int $statusCode = self::HTTP_BAD_REQUEST): self
    {
        $this->setStatusCode($statusCode);
        $this->setData([...$data]);
        return $this;
    }

    /**
     * @return string|null
     */
    public function getTemplate(): ?string
    {
        return $this->template;
    }

    /**
     * @param string|null $template
     */
    public function setTemplate(?string $template): void
    {
        $this->template = $template;
    }


    /**
     * @return int
     */
    public function getStatusCode(): int
    {
        return $this->statusCode;
    }

    /**
     * @param int $statusCode
     */
    public function setStatusCode(int $statusCode): void
    {
        $this->statusCode = $statusCode;
    }

    /**
     * @return string|null
     */
    public function getRedirectUrl(): ?string
    {
        return $this->redirectUrl;
    }

    /**
     * @param string|null $redirectUrl
     */
    public function setRedirectUrl(?string $redirectUrl): void
    {
        $this->redirectUrl = $redirectUrl;
    }

    /**
     * @return array|null
     */
    public function getData(): ?array
    {
        return $this->data;
    }

    /**
     * @param array|null $data
     */
    public function setData(?array $data): void
    {
        $this->data = $data;
    }

    /**
     * @return array
     */
    public function getHeaders(): array
    {
        return $this->headers;
    }

    /**
     * @param array $headers
     */
    public function setHeaders(array $headers): void
    {
        $this->headers = $headers;
    }



    public function renderView(string $template, array $data = null): self
    {
        $this->setTemplate($template);
        if ($data !== null) {
            $this->setData([...$data]);
        } else {
            $this->setData(null);
        }

        return $this;
    }

    public function redirect(string $url): self
    {
        $this->setRedirectUrl($url);
        return $this;
    }
}

