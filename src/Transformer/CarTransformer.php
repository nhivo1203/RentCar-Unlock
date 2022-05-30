<?php

namespace Nhivonfq\Unlock\Transformer;

use Nhivonfq\Unlock\Models\CarModel;

class CarTransformer
{
    public function toArray(CarModel $car): array
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
