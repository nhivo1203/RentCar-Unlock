<?php

namespace Nhivonfq\Unlock\Request;

class CreateBookingRequest
{
    private int $user_id = 0;
    private int $car_id = 0;
    private string $check_in = '';
    private string $check_out = '';
    private int $total = 0;


    /**
     * @param $data
     * @return string
     */
    private function formatRequest($data): string
    {
        $data = trim($data);
        $data = stripslashes($data);
        return htmlspecialchars($data);
    }

    public function fromArray(array $requestBody): self
    {
        $this->setTotal($requestBody['total']);
        $this->setCarId($requestBody['car_id']);
        $this->setUserId($requestBody['user_id']);
        $this->setCheckIn($requestBody['check_in']);
        $this->setCheckOut($requestBody['check_out']);
        $this->setTotal($requestBody['total']);
        return $this;
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
