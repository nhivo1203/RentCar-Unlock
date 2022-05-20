<?php

namespace Nhivonfq\Unlock\Views\form;

use Nhivonfq\Unlock\boostrap\Validate;

class Field
{
    public const TYPE_TEXT = 'text';
    public const TYPE_PASSWORD = 'password';
    public const TYPE_NUMBER = 'number';
    public const TYPE_EMAIL = 'email';


    public string $type;
    public Validate $model;
    public string $attribute;

    public function __construct(Validate $model, string $attribute)
    {
        $this->type = self::TYPE_TEXT;
        $this->model = $model;
        $this->attribute = $attribute;
    }

    /**
     * @return string
     */

    public function __toString()
    {
        return sprintf('
            <div class="mb-3">
                <label>%s</label>
                <input type="%s" name="%s" value="%s" class="form-control%s">
                <div class="invalid-feedback">
                    %s
                </div>
            </div>
        
        ', $this->model->labels()[$this->attribute] ?? $this->attribute,
            $this->type,
            $this->attribute,
            $this->model->{$this->attribute},
            $this->model->hasError($this->attribute) ? ' is-invalid' : '',
            $this->model->getFirstError($this->attribute)
        );

    }

    /**
     * @return $this
     */
    public function passwordField(): static
    {
        $this->type = self::TYPE_PASSWORD;
        return $this;
    }

    public function emailField(): static
    {
        $this->type = self::TYPE_EMAIL;
        return $this;
    }
}
