<?php
namespace TimeCardMD\Test\Session;
use TimeCardMD\Session\Storage\Memory as MemoryStorage;
use TimeCardMD\Session\Manager as Manager;
class ManagerTest extends \PHPUnit_Framework_TestCase
{
    protected $Manager;

    protected $Storage;

    protected function setUp()
    {
        $this->Storage = new MemoryStorage;

        $array = array(
            'App' => array(
                'hash' => '34324232fsd',
                'var1' => 10,
                'var3' => 3
            ),
            'User' => array(
                'id' => 12,
                'name' => 'Marcelo',
                'group_id' => 3
            ),
            'var3' => 'my value'
        );
        //set all
        $this->Storage->set(null, $array);
        $this->Manager = new Manager($this->Storage);
    }

    protected function tearDown()
    {
        unset($this->Manager);
        unset($this->Storage);
    }
    /**
     * Test read
     *
     * @return null
     */
    public function testRead()
    {
        //specific defined
        $expected = array(
            'hash' => '34324232fsd',
            'var1' => 10,
            'var3' => 3
        );
        $result = $this->Manager->read('App');
        $this->assertSame($expected, $result);

        $expected = '34324232fsd';
        $result = $this->Manager->read('App.hash');
        $this->assertSame($expected, $result);

        $expected = 12;
        $result = $this->Manager->read('User.id');
        $this->assertSame($expected, $result);

        //specific not defined
        $expected = null;
        $result = $this->Manager->read('User.not_define_property');
        $this->assertSame($expected, $result);

        $expected = null;
        $result = $this->Manager->read('not_define_property');
        $this->assertSame($expected, $result);

        //empty index
        $result = $this->Manager->read('');
        $this->assertFalse($result);

        //all
        $expected = array(
            'App' => array(
                'hash' => '34324232fsd',
                'var1' => 10,
                'var3' => 3
            ),
            'User' => array(
                'id' => 12,
                'name' => 'Marcelo',
                'group_id' => 3
            ),
            'var3' => 'my value'
        );

        $result = $this->Manager->read();
        $this->assertSame($expected, $result);
    }

    public function testWrite()
    {
        $result = $this->Manager->write('User.code', '2');
        $this->assertTrue($result);

        $result = $this->Manager->write('User.id', 5);
        $this->assertTrue($result);

        $expected = array(
            'App' => array(
                'hash' => '34324232fsd',
                'var1' => 10,
                'var3' => 3
            ),
            'User' => array(
                'id' => 5,
                'name' => 'Marcelo',
                'group_id' => 3,
                'code' => '2'
            ),
            'var3' => 'my value'
        );

        $result = $this->Manager->read();
        $this->assertSame($expected, $result);

        $result = $this->Manager->write(array('var2' => 'a new value', 'var3' => 'another value'));
        $this->assertTrue($result);

        $result = $this->Manager->read();
        $expected['var2'] = 'a new value';
        $expected['var3'] = 'another value';
        $this->assertSame($expected, $result);
    }

    public function testCheck()
    {
        $result = $this->Manager->check('User.code');
        $this->assertFalse($result);

        $result = $this->Manager->check('Post');
        $this->assertFalse($result);

        $result = $this->Manager->check('User');
        $this->assertTrue($result);

        $result = $this->Manager->check('User.id');
        $this->assertTrue($result);
    }

    public function testDelete()
    {
        //not define
        $result = $this->Manager->delete('User.code');
        $this->assertFalse($result);

        //defined
        $result = $this->Manager->delete('User.id');
        $this->assertTrue($result);

        $expected = array(
            'name' => 'Marcelo',
            'group_id' => 3
        );
        $result = $this->Manager->read('User');
        $this->assertSame($expected, $result);

        $result = $this->Manager->delete('User');
        $this->assertTrue($result);

        $result = $this->Manager->read('User');
        $this->assertSame(null, $result);

        //The rest
        $expected = array(
            'App' => array(
                'hash' => '34324232fsd',
                'var1' => 10,
                'var3' => 3
            ),
            'var3' => 'my value'
        );
        $result = $this->Manager->read();
        $this->assertSame($expected, $result);
    }

    public function testDestroy()
    {
        //not define
        $result = $this->Manager->destroy();
        $this->assertTrue($result);

        $result = $this->Manager->read();
        $this->assertSame(null, $result);

        $this->Manager->write('User.id', 5);
        $result = $this->Manager->read('User.id', 5);
        $this->assertSame(5, $result);

        $result = $this->Manager->destroy();
        $this->assertTrue($result);

        $result = $this->Manager->read();
        $this->assertSame(null, $result);
    }
}