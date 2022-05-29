<?php

namespace Nhivonfq\Unlock\Models;

class BookingModel
{
    private int $booking_id;
    private int $user_id;
    private int $car_id;
    private string $check_in;
    private string $check_out;
    private int $total;

    /**
     * @return int
     */
    public function getBookingId(): int
    {
        return $this->booking_id;
    }

    /**
     * @param int $booking_id
     */
    public function setBookingId(int $booking_id): void
    {
        $this->booking_id = $booking_id;
    }

    /**
     * @return int
     */
    public function getUserId(): int
    {
        return $this->user_id;
    }

    /**
     * @param int $user_id
     */
    public function setUserId(int $user_id): void
    {
        $this->user_id = $user_id;
    }

    /**
     * @return int
     */
    public function getCarId(): int
    {
        return $this->car_id;
    }

    /**
     * @param int $car_id
     */
    public function setCarId(int $car_id): void
    {
        $this->car_id = $car_id;
    }

    /**
     * @return string
     */
    public function getCheckIn(): string
    {
        return $this->check_in;
    }

    /**
     * @param string $check_in
     */
    public function setCheckIn(string $check_in): void
    {
        $this->check_in = $check_in;
    }

    /**
     * @return string
     */
    public function getCheckOut(): string
    {
        return $this->check_out;
    }

    /**
     * @param string $check_out
     */
    public function setCheckOut(string $check_out): void
    {
        $this->check_out = $check_out;
    }

    /**
     * @return int
     */
    public function getTotal(): int
    {
        return $this->total;
    }

    /**
     * @param int $total
     */
    public function setTotal(int $total): void
    {
        $this->total = $total;
    }


}
