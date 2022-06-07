<?php

namespace Nhivonfq\Unlock\Transfer;

use JsonException;
use Nhivonfq\Unlock\Http\Request;

class RequestTransfer
{
    private Request $request;

    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    public function getBody(): array
    {
        $body = [];

        if ($this->request->getMethod() === 'post') {
            foreach ($_POST as $key => $value) {
                $body[$key] = filter_input(INPUT_POST, $key, FILTER_SANITIZE_SPECIAL_CHARS);
            }
        }
        return $body;
    }

    /**
     * @return mixed
     * @throws JsonException
     */
    public function getRequestJsonBody(): mixed
    {
        $data = file_get_contents('php://input');

        return json_decode($data, true, 512, JSON_THROW_ON_ERROR);
    }
}
