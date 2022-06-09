<?php

namespace Nhivonfq\Unlock\Transformer;

use Nhivonfq\Unlock\Models\Booking;

class BookingTransformer
{
    public function toArray(Booking $booking): array
    {
        return [
            'car_id' => $booking->getCarId(),
            'user_id' => $booking->getUserId(),
            'check_in' => $booking->getCheckIn(),
            'check_out' => $booking->getCheckOut(),
            'total' => $booking->getTotal(),
        ];
    }
}
