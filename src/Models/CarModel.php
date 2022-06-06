<?php

namespace Nhivonfq\Unlock\Models;

class CarModel
{
    private int $carId = 0;
    private string $carName = '';
    private string $carType = '';
    private string $carBrand = '';
    private string $image = '';
    private int $price = 0;

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
    public function getCarName(): string
    {
        return $this->carName;
    }

    /**
     * @param string $carName
     */
    public function setCarName(string $carName): void
    {
        $this->carName = $carName;
    }

    /**
     * @return string
     */
    public function getCarType(): string
    {
        return $this->carType;
    }

    /**
     * @param string $carType
     */
    public function setCarType(string $carType): void
    {
        $this->carType = $carType;
    }

    /**
     * @return string
     */
    public function getCarBrand(): string
    {
        return $this->carBrand;
    }

    /**
     * @param string $carBrand
     */
    public function setCarBrand(string $carBrand): void
    {
        $this->carBrand = $carBrand;
    }

    /**
     * @return int
     */
    public function getPrice(): int
    {
        return $this->price;
    }

    /**
     * @param int $price
     */
    public function setPrice(int $price): void
    {
        $this->price = $price;
    }

    /**
     * @return string
     */
    public function getImage(): string
    {
        return $this->image;
    }

    /**
     * @param string $image
     */
    public function setImage(string $image): void
    {
        $this->image = $image;
    }


}
