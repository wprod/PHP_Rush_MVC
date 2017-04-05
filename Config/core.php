<?php
/**
 * Created by PhpStorm.
 * User: Amand
 * Date: 04/04/2017
 * Time: 09:33
 */

function autoload_class_multiple_directory($class_name)
{

    # List all the class directories in the array.
    $array_paths = array(
        '../Controllers/',
        '../Models/',
        '../Src/'
    );

    # Count the total item in the array.
    $total_paths = count($array_paths);

    # Set the class file name.
    $file_name = $class_name.'.php';

    # Loop the array.
    for ($i = 0; $i < $total_paths; $i++)
    {
        if(file_exists($array_paths[$i].$file_name))
        {
            include_once $array_paths[$i].$file_name;
        }
    }
}

spl_autoload_register('autoload_class_multiple_directory');

