<?php

namespace Nhivonfq\Unlock\Services;

use Nhivonfq\Unlock\Models\BookingModel;
use Nhivonfq\Unlock\Repository\BookingRepository;

class CreateBookingServices
{
    private BookingRepository $bookingRepository;

    public function __construct(BookingRepository $bookingRepository)
    {
        $this->bookingRepository = $bookingRepository;
    }

    public function createBooking(CreateBookingRequest $createBookingRequest): BookingModel| bool {
        $booking = new BookingModel();

        $booking->setUserId($createBookingRequest->getUserId());
        $booking->setCarId($createBookingRequest->getCarId());
        $booking->setCheckIn($createBookingRequest->getCheckIn());
        $booking->setCheckOut($createBookingRequest->getCheckOut());
        $booking->setTotal($createBookingRequest->getTotal());

        $this->bookingRepository->createBooking($booking);

        return $booking;
    }
}
