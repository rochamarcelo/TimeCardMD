<?php
namespace TimeCardMD\Test\Model\Persistence;
use TimeCardMD\Model\Persistence\TimeCardDateSession;
use TimeCardMD\Session\Storage\Memory as MemoryStorage;
use TimeCardMD\Session\Manager as Manager;
class TimeCardDateSessionTest extends \PHPUnit_Framework_TestCase
{
    protected $Storage;

    protected $Manager;

    protected $TimeCardDateSession;

    protected $entities = array(
        'entity1' => array(
            'id' => 1,
            'additional_time' => '10:00',
            'date' => '2014-05-01',
            'time_in_1' => '10:05',
            'time_out_1' => '12:00',
            'time_in_2' => '13:00',
            'time_out_2' => '17:00',
            'time_in_3' => null,
            'time_out_3' => null,
            'created' => '2014-05-01 10:00:05',
            'updated' => '2014-05-01 17:05:56'
        ),
        'entity2' => array(
            'id' => 2,
            'additional_time' => '10:00',
            'date' => '2014-04-29',
            'time_in_1' => '10:05',
            'time_out_1' => '12:00',
            'time_in_2' => '13:00',
            'time_out_2' => '17:00',
            'time_in_3' => null,
            'time_out_3' => null,
            'created' => '2014-05-01 10:00:05',
            'updated' => '2014-05-01 17:05:56'
        ),
        'entity3' => array(
            'id' => 7,
            'additional_time' => '10:00',
            'date' => '2014-04-30',
            'time_in_1' => '10:05',
            'time_out_1' => '12:00',
            'time_in_2' => '13:00',
            'time_out_2' => '17:00',
            'time_in_3' => null,
            'time_out_3' => null,
            'created' => '2014-05-01 10:00:05',
            'updated' => '2014-05-01 17:05:56'
        ),
        'entity4' => array(
            'id' => 3,
            'additional_time' => '10:00',
            'date' => '2014-06-01',
            'time_in_1' => '09:05',
            'time_out_1' => '11:00',
            'time_in_2' => '12:20',
            'time_out_2' => '16:50',
            'time_in_3' => '17:10',
            'time_out_3' => '19:10',
            'created' => '2014-05-02 09:04:53',
            'updated' => '2014-05-02 19:15:29'
        ),
        'entity5' => array(
            'id' => null,
            'additional_time' => '08:00',
            'date' => '2014-06-05',
            'time_in_1' => '09:17',
            'time_out_1' => '11:10',
            'time_in_2' => '12:10',
            'time_out_2' => null,
            'time_in_3' => null,
            'time_out_3' => null,
            'created' => '2014-05-05 09:04:53',
            'updated' => '2014-05-05 12:10:11'
        ),
    );

    protected function setUp()
    {
        $this->Storage = new MemoryStorage;

        $session = array(
            'TimeCardDate' => array(
                'Map' => array(
                    'date_to_id' => array(
                        '2014-05-01' => 1,
                        '2014-04-29' => 2
                    )
                ),
                'All' => array(
                    1 => $this->entities['entity1'],
                    2 => $this->entities['entity2'],
                )
            )
        );
        $this->Storage->set(null, $session);
        $this->Manager = new Manager($this->Storage);

        $this->TimeCardDateSession = new TimeCardDateSession($this->Manager);
        date_default_timezone_set('America/Sao_Paulo');

    }

    protected function tearDown()
    {
        unset($this->Manager);
        unset($this->Storage);
        unset($this->TimeCardDateSession);
    }

     /**
     * Test save and get
     *
     * @access public
     * @return mixed
     */
    public function testSaveGet()
    {


        $result = $this->TimeCardDateSession->save($this->entities['entity3']);
        $this->assertTrue($result);

        $result = $this->TimeCardDateSession->save($this->entities['entity4']);
        $this->assertTrue($result);

        $result = $this->TimeCardDateSession->save($this->entities['entity5']);
        $this->assertTrue($result);

        $result = $this->TimeCardDateSession->findAll();

        //Get one
        $result = $this->TimeCardDateSession->get('2014', '06', '01');

        $this->assertEquals($this->entities['entity4'], $result);

        $entity5 = $this->entities['entity5'];
        $entity5['id'] = 8;
        $result = $this->TimeCardDateSession->get('2014', '06', '05');

        $this->assertEquals($entity5, $result);

        //Get all
        $result = $this->TimeCardDateSession->findAll();
        $expected = array(
            1 => $this->entities['entity1'],
            2 => $this->entities['entity2'],
            7 => $this->entities['entity3'],
            3 => $this->entities['entity4'],
            8 => $entity5
        );
        $this->assertEquals($expected, $result);
        $expected = array(
            'TimeCardDate' => array(
                'Map' => array(
                    'date_to_id' => array(
                        '2014-05-01' => 1,
                        '2014-04-29' => 2,
                        '2014-04-30' => 7,
                        '2014-06-01' => 3,
                        '2014-06-05' => 8,
                    )
                ),
                'All' => array(
                    1 => $this->entities['entity1'],
                    2 => $this->entities['entity2'],
                    7 => $this->entities['entity3'],
                    3 => $this->entities['entity4'],
                    8 => $entity5
                )
            )
        );
        $this->assertEquals($expected, $this->Manager->read());
        //delete
        $result = $this->TimeCardDateSession->delete(3);
        $this->assertTrue($result);

        $result = $this->TimeCardDateSession->findAll();
        $expected = array(
            1 => $this->entities['entity1'],
            2 => $this->entities['entity2'],
            7 => $this->entities['entity3'],
            8 => $entity5
        );
        $this->assertEquals($expected, $result);
        $expected = array(
            'TimeCardDate' => array(
                'Map' => array(
                    'date_to_id' => array(
                        '2014-05-01' => 1,
                        '2014-04-29' => 2,
                        '2014-04-30' => 7,
                        '2014-06-05' => 8,
                    )
                ),
                'All' => array(
                    1 => $this->entities['entity1'],
                    2 => $this->entities['entity2'],
                    7 => $this->entities['entity3'],
                    8 => $entity5
                )
            )
        );
        $this->assertEquals($expected, $this->Manager->read());
    }
}