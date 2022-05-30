<?php

namespace Nhivonfq\Unlock\Controllers\API;

use Nhivonfq\Unlock\Http\Request;
use Nhivonfq\Unlock\Http\Response;
use Nhivonfq\Unlock\Repository\CarRepository;
use Nhivonfq\Unlock\Transformer\CarTransformer;

class GetCarController
{

    private Request $request;
    private Response $response;
    private CarTransformer $carTransformer;

    public function __construct(
        Request        $request,
        Response       $response,
        CarTransformer $carTransformer
    )
    {
        $this->request = $request;
        $this->response = $response;
        $this->carTransformer = $carTransformer;
    }

    public function getAllCar(): Response
    {
        $carRepository = new CarRepository();
        $cars = $carRepository->getAll();
        $carsData = [];
        foreach ($cars as $car){
            $carsData[] = $this->carTransformer->toArray($car);
        }
        if (!$this->request->isPost()) {
            return $this->response->toJson([
                'data' => $carsData
            ], Response::HTTP_OK);
        }
        return $this->response->toJson([
            'error' => 'Bad Request'
        ], Response::HTTP_BAD_REQUEST);
    }
}
