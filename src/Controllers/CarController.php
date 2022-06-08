<?php

namespace Nhivonfq\Unlock\Controllers;

use Nhivonfq\Unlock\App\View;
use Nhivonfq\Unlock\boostrap\Controller;
use Nhivonfq\Unlock\Http\Request;
use Nhivonfq\Unlock\Http\Response;
use Nhivonfq\Unlock\Repository\CarRepository;
use Nhivonfq\Unlock\Request\CreateCarRequest;
use Nhivonfq\Unlock\Services\UploadImageServices;
use Nhivonfq\Unlock\Transfer\RequestTransfer;
use Nhivonfq\Unlock\Transformer\CarTransformer;
use Nhivonfq\Unlock\Validate\CreateCarValidate;
use Nhivonfq\Unlock\Validate\ImageValidate;

class CarController extends Controller
{
    private CreateCarValidate $createCarValidate;
    private CarRepository $carRepository;
    private UploadImageServices $uploadImageServices;
    private CarTransformer $carTransformer;
    private ImageValidate $imageValidate;

    public function __construct(Request             $request,
                                Response            $response,
                                RequestTransfer     $requestTransfer,
                                CreateCarValidate   $createCarValidate,
                                CarRepository       $carRepository,
                                CarTransformer      $carTransformer,
                                ImageValidate       $imageValidate,
                                UploadImageServices $uploadImageServices)
    {
        parent::__construct($request, $response, $requestTransfer);
        $this->createCarValidate = $createCarValidate;
        $this->carRepository = $carRepository;
        $this->carTransformer = $carTransformer;
        $this->uploadImageServices = $uploadImageServices;
        $this->imageValidate = $imageValidate;
    }

    public function home(): Response
    {
        $carRepository = new CarRepository();
        $cars = $carRepository->getAll(1, 9);
        $carsData = [];
        foreach ($cars as $car) {
            $carsData[] = $this->carTransformer->toArray($car);
        }
        return $this->response->renderView('home',
            ['cars' => $carsData]
        );
    }

    public function getImage()
    {
        return $this->request->getFiles()['image'];
    }

    public function formValidate(): array| false
    {
        $errors = [];
        $this->createCarValidate->loadData($this->requestTransfer->getRequestArrayBody());

        if (!$this->createCarValidate->validate()) {
            $errors = $this->createCarValidate->getErrors();
        }

        if ($this->imageValidate->validate($this->getImage(), 21000000)) {
            $errors = ['image' => $this->imageValidate->getErrors()];
        }

        if (!$errors) {
            return false;
        }
        return $errors;
    }

    public function createCar(): Response
    {
        if ($this->request->isGet()) {
            return $this->response->renderView('create_car');
        }
        if ($this->formValidate()) {
            return $this->response->renderView(
                'create_car',
                ['errors' => $this->formValidate()]
            );
        }
        $data = $this->requestTransfer->getRequestArrayBody();
        $imgURL = $this->uploadImageServices->handleUpload($this->request->getFiles()['image']);
        $data = array_merge($data, ['image' => $imgURL]);
        $createCarRequest = new CreateCarRequest();
        $createCarRequest = $createCarRequest->fromArrayToModel($data);
        if ($this->carRepository->createCar($createCarRequest)) {
            View::redirect('/');
        }
        return $this->response->renderView(
            'create_car',
            ['errors' => $this->createCarValidate->getErrors()]
        );
    }
}
