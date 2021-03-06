<?php

namespace Nhivonfq\Unlock\Request;

use Nhivonfq\Unlock\Models\Car;

class CreateCarRequest
{
    private string $name = "";
    private string $type = "";
    private string $brand = "";
    private string $image = "";
    private int $price = 0;

    public function fromArrayToModel(array $requestBody): Car
    {
        $car = new Car();

        $car->setCarName($requestBody['name']);
        $car->setCarType($requestBody['type']);
        $car->setCarBrand($requestBody['brand']);
        $car->setPrice($requestBody['price']);
        $car->setImage($requestBody['image']);

        return $car;
    }


    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param string $name
     */
    public function setName(string $name): void
    {
        $this->name = $name;
    }

    /**
     * @return string
     */
    public function getType(): string
    {
        return $this->type;
    }

    /**
     * @param string $type
     */
    public function setType(string $type): void
    {
        $this->type = $type;
    }

    /**
     * @return string
     */
    public function getBrand(): string
    {
        return $this->brand;
    }

    /**
     * @param string $brand
     */
    public function setBrand(string $brand): void
    {
        $this->brand = $brand;
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
}
