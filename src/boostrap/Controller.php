<?php

namespace Nhivonfq\Unlock\boostrap;

class Controller
{
    public string $layout = 'main';

    public function setLayout($layout) {
        $this->layout = $layout;
    }

    public function render($view , $params) {
        return Application::$app->view->renderView($view, $params);
    }
}
