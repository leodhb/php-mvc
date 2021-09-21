<?php
namespace Helpers;

class URL {
    public static function redirect($url) {
        header('Location: '. getenv('URL') . $url);
    }

    public static function js_redirect($url) {
        echo '<script>window.location.href = "'. getenv('URL') . $url. '";</script>';
    }
}