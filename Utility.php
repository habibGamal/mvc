<?php
    namespace app;

    class Utility {
        public static function show($var){
            echo '<pre>';
            var_dump($var);
            echo '</pre>';
        }
    }