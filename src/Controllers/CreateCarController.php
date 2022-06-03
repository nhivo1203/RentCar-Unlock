<?php

namespace Nhivonfq\Unlock\Controllers;

use Nhivonfq\Unlock\App\View;
use Nhivonfq\Unlock\boostrap\Controller;
use Nhivonfq\Unlock\Http\Request;
use Nhivonfq\Unlock\Http\Response;
use Nhivonfq\Unlock\Request\CreateCarRequest;
use Nhivonfq\Unlock\Services\CreateCarServices;
use Nhivonfq\Unlock\Services\UploadImageServices;
use Nhivonfq\Unlock\Transfer\RequestTransfer;
use Nhivonfq\Unlock\Validate\CreateCarValidate;

class CreateCarController extends Controller
{
    private CreateCarValidate $createCarValidate;
    private CreateCarServices $createCarServices;
    private UploadImageServices $uploadImageServices;

    public function __construct(Request             $request,
                                Response            $response,
                                RequestTransfer     $requestTransfer,
                                CreateCarValidate   $createCarValidate,
                                CreateCarServices   $createCarServices,
                                UploadImageServices $uploadImageServices)
    {
        parent::__construct($request, $response, $requestTransfer);
        $this->createCarValidate = $createCarValidate;
        $this->createCarServices = $createCarServices;
        $this->uploadImageServices = $uploadImageServices;
    }


    public function createCar(): Response
    {
        if ($this->request->isPost()) {
            $createCarRequest = new CreateCarRequest();
            $imgURL = $this->uploadImageServices->handleUpload($this->request->getFiles()['image']);
            $data = $this->requestTransfer->getBody();
            $data = array_merge($data, ['image' => $imgURL]);
            if (!is_string($data['image'])) {
                $data['image'] = '';
            }
            $createCarRequest = $createCarRequest->fromArray($data);
            $this->createCarValidate->loadData($data);
            if ($this->createCarValidate->validate() && $this->createCarServices->createCar($createCarRequest)) {
                View::redirect('/');
            }
            return $this->response->renderView('createcar', ['errors' => $this->createCarValidate]);
        }
        return $this->response->renderView('createcar', ['errors' => $this->createCarValidate]);
    }
}
