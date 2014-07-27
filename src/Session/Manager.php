<?php
namespace TimeCardMD\Session;
use TimeCardMD\Session\Storage\StorageInterface;
use TimeCardMD\Utility\Hash;
class Manager implements ManagerInterface
{
    protected $storage;

    public function __construct(StorageInterface $storage)
    {
        $this->storage = $storage;
    }
    /**
     * Read a session var
     *
     * @param string $name var, eg: App, App.name, User.id, App.Cart.Item.0.id
     *
     * @return mixed
     */
    public function read($name = null)
    {
        if ($name === null) {
            return $this->storage->get();
        }

        if (empty($name)) {
            return false;
        }
        $result = Hash::get($this->storage->get(), $name);

        if (isset($result)) {
            return $result;
        }
        return null;
    }

    /**
     * Write a session var or a list
     *
     * @param mixed $name  Array or string eg string App, App.name, User.id, App.Cart.Item.0.id
     * @param mixed $value Ignored if $name is an array
     *
     * @return boolean
     */
    public function write($name, $value = null)
    {
        if (empty($name)) {
            return false;
        }

        $session = $this->storage->get();
        if ( !is_array($session) ) {
            $session = array();
        }

        if ( !is_array($name) ) {
            $session = Hash::insert($session, $name, $value);
        } else {
            foreach ( $name as $key => $val ) {
                $session = Hash::insert($session, $key, $val);
            }
        }
        $this->storage->set(null, $session);

        return true;
    }

    /**
     * Delete a session var
     *
     * @param string $name var, eg: App, App.name, User.id, App.Cart.Item.0.id
     *
     * @return boolean
     */
    public function delete($name)
    {
        if ($this->check($name)) {
            $this->storage->set(
                null,
                Hash::remove(
                    $this->storage->get(),
                    $name
                )
            );
            return !$this->check($name);
        }
        return false;
    }
    /**
     * Check if a session var is defined
     *
     * @param string $name var, eg: App, App.name, User.id, App.Cart.Item.0.id
     *
     * @return boolean
     */
    public function check($name = null)
    {
        if (empty($name)) {
            return false;
        }
        return Hash::get($this->storage->get(), $name) !== null;
    }

    /**
     * Detroy all session vars
     *
     * @return boolean
     */
    public function destroy()
    {
        return $this->storage->destroy();
    }
}