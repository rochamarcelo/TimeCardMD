<?php
namespace TimeCardMD\Session\Storage;
class Memory implements StorageInterface
{
    protected $session = array();

    public function get($var = null)
    {
        if ( $var === null ) {
            return $this->session;
        }

        if ( isset($this->session[$var]) ) {
            return $this->session[$var];
        }
        return null;
    }

    public function set($var, $value)
    {
        $_SESSION[] = $value;
        if ( $var !== null ) {
            $this->session[$var] = $value;
        } else {
            $this->session = $value;
        }
    }

    public function destroy()
    {
        $this->session = null;
        return true;
    }
}