<?php

namespace Nhivonfq\Unlock\Controllers\API;

use JsonException;
use Nhivonfq\Unlock\boostrap\Controller;
use Nhivonfq\Unlock\Http\Request;
use Nhivonfq\Unlock\Http\Response;
use Nhivonfq\Unlock\Request\CreateBookingRequest;
use Nhivonfq\Unlock\Services\CreateBookingServices;
use Nhivonfq\Unlock\Transfer\RequestTransfer;
use Nhivonfq\Unlock\Transformer\BookingTransformer;
use Nhivonfq\Unlock\Validate\CreateBookingValidate;

class CreateBookingAPIController extends Controller
{

    private CreateBookingValidate $createBookingValidate;
    private CreateBookingServices $createBookingServices;
    private BookingTransformer $bookingTransformer;

    public function __construct(Request $request,
                                Response $response,
                                CreateBookingValidate $createBookingValidate,
                                CreateBookingServices $createBookingServices,
                                RequestTransfer $requestTransfer,
                                BookingTransformer $bookingTransformer
    )
    {
        parent::__construct($request, $response, $requestTransfer);
        $this->createBookingValidate = $createBookingValidate;
        $this->createBookingServices = $createBookingServices;
        $this->bookingTransformer = $bookingTransformer;
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
                    "booking" => $this->bookingTransformer->toArray($booking)
                ]
            ], Response::HTTP_OK);
        }
        return $this->response->toJson([
            'errors' => "Not Found"
        ],Response::HTTP_NOT_FOUND);
    }
}
