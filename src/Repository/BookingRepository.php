<?php

namespace Nhivonfq\Unlock\Repository;

use Nhivonfq\Unlock\Models\BookingModel;

class BookingRepository extends BaseRepository
{
    private array $attributes = ['user_id', 'car_id', 'check_in', 'check_out', 'total'];

    public function createBooking(BookingModel $booking): ?BookingModel
    {
        $statement = $this->getConnection()->prepare(
            "INSERT INTO bookings(" . implode(',', $this->getAttributes()) . ")
            VALUES(?, ?, ?, ?, ?)");
        $isCreated = $statement->execute([
            $booking->getUserId(), $booking->getCarId(), $booking->getCheckIn(),
            $booking->getCheckOut(), $booking->getTotal()
        ]);
        if ($isCreated) {
            return $booking;
        }
        return null;
    }

    /**
     * @return array|string[]
     */
    public function getAttributes(): array
    {
        return $this->attributes;
    }
}
