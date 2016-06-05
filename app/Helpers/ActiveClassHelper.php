<?php
/**
 * Created by PhpStorm.
 * User: Ivan
 * Date: 5/06/2016
 * Time: 9:43 PM
 */
if (!function_exists('classActivePath')) {
    function classActivePath($path)
    {
        $path = explode('.', $path);

        $segment = 1;
        foreach ($path as $p) {
            if ((request()->segment($segment) == $p) == false && !request()->is($p)) {
                return '';
            }
            $segment++;
        }
        return 'active';
    }
}