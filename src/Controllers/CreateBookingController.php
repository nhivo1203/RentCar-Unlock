<?php

namespace Nhivonfq\Unlock\Controllers;

use Nhivonfq\Unlock\App\View;
use Nhivonfq\Unlock\boostrap\Controller;
use Nhivonfq\Unlock\Http\Request;
use Nhivonfq\Unlock\Http\Response;
use Nhivonfq\Unlock\Request\CreateBookingRequest;
use Nhivonfq\Unlock\Services\CreateBookingServices;
use Nhivonfq\Unlock\Transfer\RequestTransfer;
use Nhivonfq\Unlock\Validate\CreateBookingValidate;

class CreateBookingController extends Controller
{

    private CreateBookingValidate $createBookingValidate;
    private CreateBookingServices $createBookingServices;

    public function __construct(Request               $request,
                                Response              $response,
                                CreateBookingValidate $createBookingValidate,
                                CreateBookingServices $createBookingServices,
                                RequestTransfer       $requestTransfer
    )
    {
        parent::__construct($request, $response, $requestTransfer);
        $this->createBookingValidate = $createBookingValidate;
        $this->createBookingServices = $createBookingServices;
    }

    public function createBooking(): Response
    {
        if ($this->request->isPost()) {
            $createBookingRequest = new CreateBookingRequest();
            $createBookingRequest = $createBookingRequest->fromArray($this->requestTransfer->getBody());
            $this->createBookingValidate->loadData($this->requestTransfer->getBody());
            if ($this->createBookingValidate->validate()
                && $this->createBookingServices->createBooking($createBookingRequest)) {
                View::redirect('/');
            }
            return $this->response->renderView('createbooking', ['errors' => $this->createBookingValidate]);
        }
        return $this->response->renderView('createbooking', ['errors' => $this->createBookingValidate]);
    }
}
