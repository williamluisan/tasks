<?php

defined('BASEPATH') OR exit('Direct access path is not allowed');

if ( ! function_exists('pre')) {
    function pre($string) {
        echo "<pre>";
        print_r($string);
        exit();
    }
}