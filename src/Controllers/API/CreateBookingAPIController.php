<?php

namespace Nhivonfq\Unlock\Controllers\API;

use JsonException;
use Nhivonfq\Unlock\App\Controller;
use Nhivonfq\Unlock\Http\Request;
use Nhivonfq\Unlock\Http\Response;
use Nhivonfq\Unlock\Models\Booking;
use Nhivonfq\Unlock\Repository\BookingRepository;
use Nhivonfq\Unlock\Request\CreateBookingRequest;
use Nhivonfq\Unlock\Transfer\RequestTransfer;
use Nhivonfq\Unlock\Transformer\BookingTransformer;
use Nhivonfq\Unlock\Validate\CreateBookingValidate;

class CreateBookingAPIController extends Controller
{

    private CreateBookingValidate $createBookingValidate;
    private BookingRepository $bookingRepository;
    private BookingTransformer $bookingTransformer;

    public function __construct(
        Request               $request,
        Response              $response,
        CreateBookingValidate $createBookingValidate,
        BookingRepository     $bookingRepository,
        RequestTransfer       $requestTransfer,
        BookingTransformer    $bookingTransformer
    ) {
        parent::__construct($request, $response, $requestTransfer);
        $this->createBookingValidate = $createBookingValidate;
        $this->bookingRepository = $bookingRepository;
        $this->bookingTransformer = $bookingTransformer;
    }


    /**
     * @throws JsonException
     */
    public function createBooking(): Response
    {
        if ($this->request->isGet()) {
            return $this->response->toJson(
                ['errors' => "Not Found"],
                Response::HTTP_NOT_FOUND
            );
        }
        $this->createBookingValidate->loadData($this->requestTransfer->getRequestJsonBody());
        if (!$this->createBookingValidate->validate()) {
            return $this->response->toJson(
                ['errors' => $this->createBookingValidate->getErrors()],
                Response::HTTP_BAD_REQUEST
            );
        }
        $booking = $this->getBookingData();
        if ($booking === null) {
            return $this->response->toJson(
                ['errors' => "Can not create booking"],
                Response::HTTP_BAD_REQUEST
            );
        }
        return $this->response->toJson([
            'data' => $this->bookingTransformer->toArray($this->isBookingCreated())
        ], Response::HTTP_OK);
    }

    /**
     * @throws JsonException
     */
    private function getBookingData(): ?Booking
    {
        $createBookingRequest = new CreateBookingRequest();
        $bookingRequest = $createBookingRequest->fromArraytoModel($this->requestTransfer->getRequestJsonBody());
        return $this->bookingRepository->createBooking($bookingRequest);
    }
}
