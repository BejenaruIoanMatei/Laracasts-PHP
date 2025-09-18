<?php

namespace Core;

class Session{

    public static function put($key, $value)
    {
        $_SESSION[$key] = $value;
    }

    public static function get($key, $default = null)
    {
        if (isset($_SESSION['_flash'][$key])){
            return $_SESSION['_flash'][$key];
        }
        return $_SESSION[$key] ?? $default;
    }

    public static function has($key)
    {
        return (bool) static::get($key);
    }

    public static function flash($key, $value)
    {
        $_SESSION['_flash'][$key] = $value;
    }

    public static function unflash()
    {
        unset($_SESSION['_flash']);
    }

    public static function flush()
    {
        $_SESSION = [];
    }

    public static function destroy()
    {
        static::flush();
        session_destroy();
    
        $params = session_get_cookie_params();
    
        setcookie(
            name: 'PHPSESSID',
            value: '',
            expires_or_options: time() - 3600,
            path: $params['path'],
            domain: $params['domain'],
            secure: $params['secure'],
            httponly: $params['httponly']
        );
    }
}