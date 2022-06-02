<?php

namespace Nhivonfq\Unlock\Controllers\API;

use JsonException;
use Nhivonfq\Unlock\Http\Request;
use Nhivonfq\Unlock\Http\Response;
use Nhivonfq\Unlock\Request\CreateCarRequest;
use Nhivonfq\Unlock\Services\CreateCarServices;
use Nhivonfq\Unlock\Transfer\RequestTransfer;
use Nhivonfq\Unlock\Transformer\CarTransformer;
use Nhivonfq\Unlock\Validate\CreateCarValidate;

class CreateCarAPIController
{
    private Request $request;
    private Response $response;
    private RequestTransfer $requestTransfer;
    private CreateCarValidate $createCarValidate;
    private CreateCarServices $createCarServices;
    private CarTransformer $carTransformer;

    public function __construct(Request $request,
                                Response $response,
                                RequestTransfer $requestTransfer,
                                CreateCarValidate $createCarValidate,
                                CreateCarServices $createCarServices,
                                CarTransformer $carTransformer
    )
    {
        $this->request = $request;
        $this->response = $response;
        $this->requestTransfer = $requestTransfer;
        $this->createCarValidate = $createCarValidate;
        $this->createCarServices = $createCarServices;
        $this->carTransformer = $carTransformer;
    }

    /**
     * @throws JsonException
     */
    public function createCar():Response {
        if($this->request->isPost()) {
            $createCarRequest = new CreateCarRequest();
            $createCarRequest = $createCarRequest->fromArray($this->requestTransfer->getRequestJsonBody());
            $this->createCarValidate->loadData($this->requestTransfer->getRequestJsonBody());
            if(!$this->createCarValidate->validate()){
                return $this->response->toJson([
                    'errors' => $this->createCarValidate->errors
                ],Response::HTTP_BAD_REQUEST);
            }
            $car = $this->createCarServices->createCar($createCarRequest);
            if(!$car){
                return $this->response->toJson(['message' => "Can not create car"], Response::HTTP_BAD_REQUEST);
            }
            return $this->response->toJson([
                'data' => [
                    "car" => $this->carTransformer->toArray($car)
                ]
            ], Response::HTTP_OK);
        }
        return $this->response->toJson([
            'errors' => "Not Found"
        ],Response::HTTP_NOT_FOUND);
    }

}
