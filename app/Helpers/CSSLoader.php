<?php
namespace Helpers;

class CSSLoader {
    public static function load($css) {
        $path = APP . '/../public/css/' . $css . '.css';
        if(file_exists($path)) {
            echo '<link rel="stylesheet" href="css/'.$css.'.css">';
        }
    }
}