<?php

namespace Nhivonfq\Unlock\Services;

use Nhivonfq\Unlock\Models\CarModel;
use Nhivonfq\Unlock\Repository\CarRepository;
use Nhivonfq\Unlock\Request\CreateCarRequest;

class CreateCarServices
{
    private CarRepository $carRepository;

    public function __construct(CarRepository $carRepository)
    {
        $this->carRepository = $carRepository;
    }

    public function createCar(CreateCarRequest $createCarRequest): CarModel | bool
    {
        $car = new CarModel();

        $car->setCarName($createCarRequest->getName());
        $car->setCarType($createCarRequest->getType());
        $car->setCarBrand($createCarRequest->getBrand());
        $car->setImage($createCarRequest->getImage());
        $car->setPrice($createCarRequest->getPrice());

        $this->carRepository->createCar($car);

        return $car;
    }
}
