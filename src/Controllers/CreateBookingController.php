<?php

namespace Nhivonfq\Unlock\Controllers;

use Nhivonfq\Unlock\App\Controller;
use Nhivonfq\Unlock\App\View;
use Nhivonfq\Unlock\Http\Request;
use Nhivonfq\Unlock\Http\Response;
use Nhivonfq\Unlock\Repository\BookingRepository;
use Nhivonfq\Unlock\Request\CreateBookingRequest;
use Nhivonfq\Unlock\Transfer\RequestTransfer;
use Nhivonfq\Unlock\Validate\CreateBookingValidate;

class CreateBookingController extends Controller
{

    private CreateBookingValidate $createBookingValidate;
    private BookingRepository $bookingRepository;

    public function __construct(
        Request               $request,
        Response              $response,
        CreateBookingValidate $createBookingValidate,
        RequestTransfer       $requestTransfer,
        BookingRepository     $bookingRepository
    ) {
        parent::__construct($request, $response, $requestTransfer);
        $this->createBookingValidate = $createBookingValidate;
        $this->bookingRepository = $bookingRepository;
    }

    public function createBooking(): Response
    {
        if ($this->request->isGet()) {
            return $this->response->renderView(
                'create_booking',
                ['errors' => $this->createBookingValidate->getErrors()]
            );
        }
        $this->createBookingValidate->loadData($this->requestTransfer->getRequestArrayBody());
        if ($this->createBookingValidate->validate()) {
            $createBookingRequest = new CreateBookingRequest();
            $booking = $createBookingRequest->fromArraytoModel($this->requestTransfer->getRequestArrayBody());
            if ($this->bookingRepository->createBooking($booking)) {
                View::redirect('/');
            }
        }
        return $this->response->renderView(
            'create_booking',
            ['errors' => $this->createBookingValidate->getErrors()]
        );
    }
}
