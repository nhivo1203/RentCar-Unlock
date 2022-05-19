<?php

namespace Nhivonfq\Unlock\Views\form;

use Nhivonfq\Unlock\boostrap\Validate;

class Form
{

    public static function begin($action, $method)
    {
        echo sprintf('<form action="%s" method="%s">', $action, $method);
        return new Form();
    }

    public static function end()
    {
        echo '</form>';
    }

    public function field(Validate $model, $attribute)
    {
        return new Field($model, $attribute);
    }
}
