<?php

namespace Nhivonfq\Unlock\Request;

use Nhivonfq\Unlock\Models\BookingModel;

class CreateBookingRequest
{
    private int $userId = 0;
    private int $carId = 0;
    private string $check_in = '';
    private string $check_out = '';
    private int $total = 0;


    public function fromArrayToModel(array $requestBody):BookingModel{
        $booking = new BookingModel();
        $booking->setCarId($requestBody['car_id']);
        $booking->setUserId($requestBody['user_id']);
        $booking->setCheckIn($requestBody['check_in']);
        $booking->setCheckOut($requestBody['check_out']);
        $booking->setTotal($requestBody['total']);
        
        return $booking;
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
