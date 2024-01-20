<?php

function autoloader($className) {
    $app_prefix = 'lib/';
    $file_name = str_replace("\\", '/', $className) . '.php';
    require "{$app_prefix}{$file_name}";
}

spl_autoload_register('autoloader');