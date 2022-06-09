<?php

namespace Nhivonfq\Unlock\Transformer;

use Nhivonfq\Unlock\Models\Car;

class CarTransformer
{
    public function toArray(Car $car): array
    {
        return [
            'id' => $car->getCarId(),
            'name' => $car->getCarName(),
            'brand' => $car->getCarBrand(),
            'type' => $car->getCarType(),
            'image' => $car->getImage(),
            'price' => $car->getPrice(),
        ];
    }
}
