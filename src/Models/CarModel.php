<?php

namespace Nhivonfq\Unlock\Models;

class CarModel
{
    private int $car_id = 0;
    private string $car_name = "";
    private string $car_type = "";
    private string $car_brand = "";
    private string $image = "";
    private int $price = 0;

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
    public function getCarName(): string
    {
        return $this->car_name;
    }

    /**
     * @param string $car_name
     */
    public function setCarName(string $car_name): void
    {
        $this->car_name = $car_name;
    }

    /**
     * @return string
     */
    public function getCarType(): string
    {
        return $this->car_type;
    }

    /**
     * @param string $car_type
     */
    public function setCarType(string $car_type): void
    {
        $this->car_type = $car_type;
    }

    /**
     * @return string
     */
    public function getCarBrand(): string
    {
        return $this->car_brand;
    }

    /**
     * @param string $car_brand
     */
    public function setCarBrand(string $car_brand): void
    {
        $this->car_brand = $car_brand;
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
