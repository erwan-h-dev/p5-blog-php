<?php

namespace App\Core;

class Session
{
    public function __construct()
    {
        if (!isset($_SESSION)) {
            session_start();
        }
    }

    public function setSession(string $key, $value)
    {
        $_SESSION[$key] = $value;
    }

    public function getSession(string $key)
    {
        
        return isset($_SESSION[$key]) ? $_SESSION[$key] : null;
    }

    public function getSessions()
    {
        return $_SESSION;
    }

    public function delete(string $key)
    {
        unset($_SESSION[$key]);
    }

    public function destroySession()
    {
        session_destroy();
    }
}