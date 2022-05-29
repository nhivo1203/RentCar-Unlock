<?php

namespace Nhivonfq\Unlock\Controllers\API;

use Nhivonfq\Unlock\Http\Request;
use Nhivonfq\Unlock\Http\Response;
use Nhivonfq\Unlock\Repository\CarRepository;

class GetCarController
{

    private Request $request;
    private Response $response;


    public function __construct(
        Request       $request,
        Response      $response,
    )
    {
        $this->request = $request;
        $this->response = $response;
    }

    public function getAllCar():Response
    {
        $carRepository = new CarRepository();

        return $this->response->toJson([
            'data' => $carRepository->getAll()
        ], Response::HTTP_OK);
    }
}
