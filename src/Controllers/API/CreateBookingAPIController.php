<?php

namespace Nhivonfq\Unlock\Controllers\API;

use JsonException;
use Nhivonfq\Unlock\Http\Request;
use Nhivonfq\Unlock\Http\Response;
use Nhivonfq\Unlock\Request\CreateBookingRequest;
use Nhivonfq\Unlock\Services\CreateBookingServices;
use Nhivonfq\Unlock\Transfer\RequestTransfer;
use Nhivonfq\Unlock\Validate\CreateBookingValidate;

class CreateBookingAPIController
{
    private Request $request;
    private Response $response;
    private CreateBookingValidate $createBookingValidate;
    private CreateBookingServices $createBookingServices;
    private RequestTransfer $requestTransfer;

    public function __construct(Request $request,
                                Response $response,
                                CreateBookingValidate $createBookingValidate,
                                CreateBookingServices $createBookingServices,
                                RequestTransfer $requestTransfer
    )
    {
        $this->request = $request;
        $this->response = $response;
        $this->createBookingValidate = $createBookingValidate;
        $this->createBookingServices = $createBookingServices;
        $this->requestTransfer = $requestTransfer;
    }

    /**
     * @throws JsonException
     */
    public function createBooking():Response {
        if($this->request->isPost()) {
            $createBookingRequest = new CreateBookingRequest();
            $createBookingRequest = $createBookingRequest->fromArray($this->requestTransfer->getRequestJsonBody());
            $this->createBookingValidate->loadData($this->requestTransfer->getRequestJsonBody());
            if (!$this->createBookingValidate->validate()) {
                return $this->response->toJson([
                    'errors' => $this->createBookingValidate->errors
                ], Response::HTTP_BAD_REQUEST);
            }
            $booking = $this->createBookingServices->createBooking($createBookingRequest);

            if (!$booking) {
                return $this->response->toJson(['message' => "Can not create booking"], Response::HTTP_BAD_REQUEST);
            }

            return $this->response->toJson([
                'data' => [
                    "booking" => [
                        'check_in' => $booking->getCheckIn(),
                        'check_out' => $booking->getCheckOut(),
                        'total' => $booking->getTotal(),
                    ]
                ]
            ], Response::HTTP_OK);
        }
        return $this->response->toJson([
            'errors' => "Not Found"
        ],Response::HTTP_NOT_FOUND);
    }
}
