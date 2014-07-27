<?php
namespace TimeCardMD\Session\Storage;
interface StorageInterface
{
    public function get($var = null);

    public function set($var, $value);

    public function destroy();
}