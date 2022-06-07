<?php

namespace Nhivonfq\Unlock\Transformer;

use Nhivonfq\Unlock\Models\BookingModel;

class BookingTransformer
{
    public function toArray(BookingModel $booking): array
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
