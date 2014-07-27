<?php
namespace TimeCardMD\Session\Storage;
use TimeCardMD\Utility\Hash;
class Session implements StorageInterface
{
    public function get($var = null)
    {
        $this->start();
        if ( $var === null ) {
            return $_SESSION;
        }

        if ( isset($_SESSION[$var]) ) {
            return $_SESSION[$var];
        }
        return null;
    }

    public function set($var, $value)
    {
        $this->start();
        if ( $var !== null ) {
            $_SESSION[$var] = $value;
        } else {
            $_SESSION = $value;
        }
    }

    public function destroy()
    {
        $_SESSION = null;

        if (isset($_COOKIE[session_name()])) {
            setcookie(session_name(), '', time()-42000, '/');
        }
        if ( $this->started() ) {
            session_destroy();
        }
        return true;
    }

    public function start()
    {
        if ( $this->started() ) {
            return true;
        }
        return session_start();
    }

    public function started()
    {
        return isset($_SESSION) && session_id();
    }
    /**
     * Adapter to session_ functions
     *s
     * @param string $name      method name
     * @param array  $arguments arguments list
     *
     * @return mixed
     */
    public function __call($name, $arguments)
    {
        return call_user_func_array('session_' . $name, $arguments);
    }
}