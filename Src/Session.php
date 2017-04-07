<?php
/**
 * Created by PhpStorm.
 * User: Amand
 * Date: 04/04/2017
 * Time: 09:31
 */

class Session
{
    public static function set ($key, $value) {
        $_SESSION[$key] = serialize($value);
        return true;
    }
    
    public static function get ($key) {
        if (self :: check($key)) {
            return unserialize($_SESSION[$key]);
        } else {
            return false;
        }
    }

    public static function check ($key) {
        return isset($_SESSION[$key]);
    }

    public static function delete ($key) {
        if (self :: check($key)) {
            unset($_SESSION[$key]);
            return !self :: check($key);
        } else {
            return false;
        }
    }
}