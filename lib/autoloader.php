<?php

/**
 * *Autoloader for classes
 * @param string $className
 * @return void
 * @throws Exception
 */

function autoloader(string $className): void
{
    $app_prefix = 'lib/';
    $file_name = str_replace("\\", '/', $className) . '.php';
    require "{$app_prefix}{$file_name}";
}

spl_autoload_register('autoloader');