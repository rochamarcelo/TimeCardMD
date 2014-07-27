<?php
namespace TimeCardMD\Session;
interface ManagerInterface
{
    public function read($name = null);

    public function write($name, $value = null);

    public function delete($name);

    public function check($name = null);
}