<?php
namespace TimeCardMD\Test\Session\Storage;
use TimeCardMD\Session\Storage\Memory as MemoryStorage;
class MemoryTest extends \PHPUnit_Framework_TestCase
{
    /**
     * Test set and get methods
     *
     * @return null
     */
    public function testSetGet()
    {
        $Storage = new MemoryStorage;
        $array = array(
            array(
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
        ));
        //set all
        $Storage->set(null, reset(array_values($array)));

        //get specific
        $actual = $Storage->get('App');

        $expected = array(
            'hash' => '34324232fsd',
            'var1' => 10,
            'var3' => 3
        );
        $this->assertEquals($expected, $actual);

        $actual = $Storage->get('var3');
        $expected = 'my value';
        $this->assertEquals($expected, $actual);

        $actual = $Storage->get('User');
        $expected = array(
            'id' => 12,
            'name' => 'Marcelo',
            'group_id' => 3
        );
        $this->assertEquals($expected, $actual);

        //set specific
        $Storage->set('var5', 'my new value');
        $Storage->set('var6', array('other' => 'my new value'));

        //get all
        $actual = $Storage->get();
        $expected = reset(array_values($array));
        $expected['var5'] = 'my new value';
        $expected['var6'] = array('other' => 'my new value');
        $this->assertEquals($expected, $actual);
    }

    public function testDestroy()
    {
        $Storage = new MemoryStorage;
        $Storage->set('App.var5', 'my new value');
        $result = $Storage->destroy();
        $this->assertTrue($result);

        $result = $Storage->get();
        $this->assertSame(null, $result);
    }
}