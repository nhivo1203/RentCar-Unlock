<?php

namespace Nhivonfq\Unlock\Controllers\API;

use JsonException;
use Nhivonfq\Unlock\App\Controller;
use Nhivonfq\Unlock\Http\Request;
use Nhivonfq\Unlock\Http\Response;
use Nhivonfq\Unlock\Models\Car;
use Nhivonfq\Unlock\Repository\CarRepository;
use Nhivonfq\Unlock\Request\CreateCarRequest;
use Nhivonfq\Unlock\Transfer\RequestTransfer;
use Nhivonfq\Unlock\Transformer\CarTransformer;
use Nhivonfq\Unlock\Validate\CreateCarValidate;

class CarAPIController extends Controller
{
    private CreateCarValidate $createCarValidate;
    private CarRepository $carRepository;
    private CarTransformer $carTransformer;

    public function __construct(
        Request           $request,
        Response          $response,
        RequestTransfer   $requestTransfer,
        CreateCarValidate $createCarValidate,
        CarRepository     $carRepository,
        CarTransformer    $carTransformer
    ) {
        parent::__construct($request, $response, $requestTransfer);
        $this->createCarValidate = $createCarValidate;
        $this->carRepository = $carRepository;
        $this->carTransformer = $carTransformer;
    }

    /**
     * @throws JsonException
     */
    public function createCar(): Response
    {
        if ($this->request->isGet()) {
            return $this->response->toJson(
                ['errors' => "Not Found"],
                Response::HTTP_NOT_FOUND
            );
        }
        $this->createCarValidate->loadData($this->requestTransfer->getRequestJsonBody());
        if (!$this->createCarValidate->validate()) {
            return $this->response->toJson(
                ['errors' => $this->createCarValidate->getErrors()],
                Response::HTTP_BAD_REQUEST
            );
        }
        $car = $this->getCarData();
        if ($car === null) {
            return $this->response->toJson(
                ['errors' => "Can not create car"],
                Response::HTTP_BAD_REQUEST
            );
        }
        return $this->response->toJson([
            'data' => $this->carTransformer->toArray($car)
        ], Response::HTTP_OK);
    }

    public function getAllCar(): Response
    {
        $carRepository = new CarRepository();
        $cars = $carRepository->getAll(0, 9);
        $carsData = [];
        foreach ($cars as $car) {
            $carsData[] = $this->carTransformer->toArray($car);
        }
        if ($this->request->isGet()) {
            return $this->response->toJson([
                'data' => $carsData
            ], Response::HTTP_OK);
        }
        return $this->response->toJson([
            'error' => 'Bad Request'
        ], Response::HTTP_BAD_REQUEST);
    }



    private function getCarData(): ?Car
    {
        $createCarRequest = new CreateCarRequest();
        $carRequest = $createCarRequest->fromArrayToModel($this->requestTransfer->getRequestJsonBody());
        return $this->carRepository->createCar($carRequest);
    }
}
