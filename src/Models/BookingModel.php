<?php

namespace Nhivonfq\Unlock\Models;

class BookingModel
{
    private int $bookingId;
    private int $userId;
    private int $carId;
    private string $checkIn;
    private string $checkOut;
    private int $total;

    /**
     * @return int
     */
    public function getBookingId(): int
    {
        return $this->bookingId;
    }

    /**
     * @param int $bookingId
     */
    public function setBookingId(int $bookingId): void
    {
        $this->bookingId = $bookingId;
    }

    /**
     * @return int
     */
    public function getUserId(): int
    {
        return $this->userId;
    }

    /**
     * @param int $userId
     */
    public function setUserId(int $userId): void
    {
        $this->userId = $userId;
    }

    /**
     * @return int
     */
    public function getCarId(): int
    {
        return $this->carId;
    }

    /**
     * @param int $carId
     */
    public function setCarId(int $carId): void
    {
        $this->carId = $carId;
    }

    /**
     * @return string
     */
    public function getCheckIn(): string
    {
        return $this->checkIn;
    }

    /**
     * @param string $checkIn
     */
    public function setCheckIn(string $checkIn): void
    {
        $this->checkIn = $checkIn;
    }

    /**
     * @return string
     */
    public function getCheckOut(): string
    {
        return $this->checkOut;
    }

    /**
     * @param string $checkOut
     */
    public function setCheckOut(string $checkOut): void
    {
        $this->checkOut = $checkOut;
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
