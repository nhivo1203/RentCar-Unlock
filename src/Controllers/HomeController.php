<?php

namespace Nhivonfq\Unlock\Controllers;

use Nhivonfq\Unlock\Http\Request;
use Nhivonfq\Unlock\Http\Response;
use Nhivonfq\Unlock\Repository\CarRepository;
use Nhivonfq\Unlock\Transformer\CarTransformer;

class HomeController
{
    private Response $response;
    private Request $request;
    private CarTransformer $carTransformer;


    public function __construct(Request $request, Response $response, CarTransformer $carTransformer)
    {
        $this->response = $response;
        $this->request = $request;
        $this->carTransformer = $carTransformer;
    }

    public function home(): Response
    {
        $carRepository = new CarRepository();
        $cars = $carRepository->getAll();
        $carsData = [];
        foreach ($cars as $car){
            $carsData[] = $this->carTransformer->toArray($car);
        }
        return $this->response->renderView('home',
            ['cars' => $carsData]
        );
    }
}
