<?php

namespace Nhivonfq\Tests\Repository;

use Nhivonfq\Unlock\Models\BookingModel;
use Nhivonfq\Unlock\Repository\BookingRepository;
use Nhivonfq\Unlock\Services\ConfigServices;
use PHPUnit\Framework\TestCase;

ConfigServices::run();


class BookingRepositoryTest extends TestCase
{
    public function testCreateBooking(): void
    {
        $bookingRepository = new BookingRepository();
        $booking = new BookingModel();

        $booking->setBookingId(0);
        $booking->setCarId(1);
        $booking->setUserID(1);
        $booking->setCheckIn('2022-06-07');
        $booking->setCheckOut('2022-06-08');
        $booking->setTotal(1600);

        $bookingCreated = $bookingRepository->createBooking($booking);

        $this->assertEquals($booking, $bookingCreated);

    }
}
