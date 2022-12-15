<?php

namespace App\Core;

class Session
{
    public function __construct()
    {
        if (!isset($_SESSION)) {
            session_start();
        }
        if($this->getSession('role') == null){
            $this->setSession('role', 'anonymous');
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

    public function delete(string $key)
    {
        unset($_SESSION[$key]);
    }

    public function destroySession()
    {
        session_destroy();
    }
}