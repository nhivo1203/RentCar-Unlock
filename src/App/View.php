<?php

namespace Nhivonfq\Unlock\App;

use Nhivonfq\Unlock\boostrap\Application;

class View
{

    /**
     * @param $view
     * @return array|false|string|string[]
     */
    public function renderView($view, array $param = null)
    {

        $layoutContent = $this->layoutContent();
        $viewContent = $this->renderOnlyView($view, $param);
        return str_replace('{{content}}', $viewContent, $layoutContent);
    }

    /**
     * @return false|string
     */
    protected function layoutContent()
    {
        $layout = Application::$app->controller->layout ?? "main";
        ob_start();
        include_once(Application::$ROOT_DIR . "/src/Views/layouts/$layout.php");
        return ob_get_clean();
    }

    /**
     * @param $view
     * @return false|string
     */
    protected function renderOnlyView($view, $param = [])
    {
        foreach ($param as $key => $value) {
            $$key = $value;
        }
        ob_start();
        include_once(Application::$ROOT_DIR . "/src/Views/$view.php");
        return ob_get_clean();
    }

}
