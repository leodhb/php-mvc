<?php
    namespace Helpers;

    class Session {
        public static function alert($name, $text = null, $class = null) {
            if(!empty($name)) {
                if(!empty($text) && empty($_SESSION[$name])) {
                    $_SESSION[$name] = $text;
                    $_SESSION[$name.'css_class'] = $class;
                } else if(empty($text) && !empty($_SESSION[$name])) {
                    $class = !empty($_SESSION[$name.'css_class']) ? $_SESSION[$name.'css_class'] : 'alert alert-success';
                    echo '<div class="'.$class.'">'.$_SESSION[$name].'</div>';
                    unset($_SESSION[$name]);
                    unset($_SESSION[$name.'css_class']);
                }
            }
        }

        public static function swal($name, $text = null, $statuscode = null) {
            if(!empty($name)) {
                if(!empty($text) && empty($_SESSION[$name])) {
                    $_SESSION[$name] = $text;
                    $_SESSION[$name.'statuscode'] = $statuscode;
                } else if(empty($text) && !empty($_SESSION[$name])) {
                    $statuscode = !empty($_SESSION[$name.'statuscode']) ? $_SESSION[$name.'statuscode'] : 'success';
                    echo '<script>Swal.fire("'.$_SESSION[$name].'","","'.$statuscode.'");</script>';
                    unset($_SESSION[$name]);
                    unset($_SESSION[$name.'statuscode']);
                }
            }
        }
    }