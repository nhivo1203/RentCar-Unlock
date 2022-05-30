<?php

namespace Nhivonfq\Unlock\Repository;

use Nhivonfq\Unlock\Database\Database;
use Nhivonfq\Unlock\Models\BookingModel;

class BookingRepository
{
    private array $attributes = ['user_id', 'car_id', 'check_in', 'check_out', 'total'];

    public function createBooking(BookingModel $booking): bool {
        $user_id = $booking->getUserId();
        $car_id = $booking->getCarId();
        $check_in = $booking->getCheckIn();
        $check_out = $booking->getCheckOut();
        $total = $booking->getTotal();

        $statement = $this->prepare("INSERT INTO bookings(" . implode(',', $this->attributes) . ")
            VALUES(
            $user_id,
            $car_id,
            '$check_in',
            '$check_out',
            $total
            )");
        $statement->execute();
        return true;
    }

    public function prepare($sql)
    {
        return Database::prepare($sql);
    }
}
