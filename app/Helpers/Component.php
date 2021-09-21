<?php
namespace Helpers;
class Component {
    public static function render($component, $data = []) {
        $path = APP . '/Views/components/'.$component.'.php';
        if(file_exists($path)) {
            require_once $path;
        }
    }
}