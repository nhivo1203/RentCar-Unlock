<?php

namespace Nhivonfq\Unlock\Validate;

class ImageValidate
{
    private array $errors = [];

    public function validate($img, $size): array
    {
        $checkImage = $this->validateImage($img, $size);

        if (!empty($checkImage)) {
            return $checkImage;
        }

        return [];
    }

    public function validateImage($image, $size): array
    {
        if ($image['size'] === 0) {
            $this->setErrors(['please upload an image']);
        }
        if ($image['size'] > $size) {
            $this->setErrors(['image size is too large']);
        }
        return $this->getErrors();
    }

    /**
     * @return array
     */
    public function getErrors(): array
    {
        return $this->errors;
    }

    /**
     * @param array $errors
     */
    public function setErrors(array $errors): void
    {
        $this->errors = $errors;
    }
}
