<?php

namespace Libraries;

class Route
{
    private $provider = '\\Controllers\\';
    private $controller = 'Home';
    private $method = 'index';
    private $parameters = [];

    public function __construct()
    {
        $url = $this->url() ? $this->url() : [0];

        if (file_exists('../app/Controllers/' . ucwords($url[0]) . '.php')) :
            $this->controller = ucwords($url[0]);
            unset($url[0]);
        else:
            ($url[0] != 0) && $this->method = 'error_404';
        endif;

        $this->controller = $this->provider . $this->controller;

        if (class_exists($this->controller)) {
            $this->controller = new $this->controller;
        } else {
            die('Class not Found');
        }

        if (isset($url[1])) :
            if (method_exists($this->controller, $url[1])) :
                $this->method = $url[1];
                unset($url[1]);
            endif;
        endif;

        $this->parameters = $url ? array_values($url) : [];
        call_user_func_array([$this->controller, $this->method], $this->parameters);

        // var_dump($this);
    }

    private function url()
    {
        $url = filter_input(INPUT_GET, 'url', FILTER_SANITIZE_URL);
        if (isset($url)) {
            $url = trim(rtrim($url));
            $url = explode('/', $url);
        }
        return $url;
    }
}
