<?php

namespace Nhivonfq\Unlock\Controllers;

use Nhivonfq\Unlock\boostrap\Controller;
use Nhivonfq\Unlock\Http\Request;
use Nhivonfq\Unlock\Http\Response;
use Nhivonfq\Unlock\Repository\CarRepository;
use Nhivonfq\Unlock\Transfer\RequestTransfer;
use Nhivonfq\Unlock\Transformer\CarTransformer;

class HomeController extends Controller
{
    private CarTransformer $carTransformer;

    public function __construct(Request $request, Response $response, RequestTransfer $requestTransfer, CarTransformer $carTransformer)
    {
        parent::__construct($request, $response, $requestTransfer);
        $this->carTransformer = $carTransformer;
    }

    public function home(): Response
    {
        $carRepository = new CarRepository();
        $cars = $carRepository->getAll();
        $carsData = [];
        foreach ($cars as $car) {
            $carsData[] = $this->carTransformer->toArray($car);
        }
        return $this->response->renderView('home',
            ['cars' => $carsData]
        );
    }
}
