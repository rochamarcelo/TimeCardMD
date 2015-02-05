<?php

namespace TimeCardMD\Model;
use TimeCardMD\Model\Persistence\TimeCardDateInterface;
use TimeCardMD\Model\Entity\TimeCardDate as TimeCardDateEntity;
/**
 * Manage the time card dates
 *
 * @package TimeCardMD.Model
 */
class TimeCardDate
{
    protected $persistence;

    /**
     *
     * @param TimeCardDateInterface $persistence Persistence used in this model
     *
     * @access public
     * @return void
     */
    public function __construct(TimeCardDateInterface $persistence)
    {
        $this->persistence = $persistence;
    }

    /**
     * Get a time card date
     *
     * @param  integer $year  year
     * @param  integer $month month
     * @param  integer $day   day
     *
     * @access public
     * @return TimeCardMD\Model\Entity\TimeCardDate
     */
    public function get($year, $month, $day)
    {
        $entity = $this->persistence->get($year, $month, $day);
        $entity = new TimeCardDateEntity($entity);
        return $entity;
    }

    /**
     * Get all time card dates
     *
     * @access public
     * @return array
     */
    public function findAll()
    {
        $entities = $this->persistence->findAll();
        if ( !is_array($entities) ) {
            $entities = array();
        }

        $entitiesObj = array();
        foreach ($entities as $entity ) {
            $obj = new TimeCardDateEntity($entity);
            $obj->date = new \DateTime($obj->date);
            $entitiesObj[$obj->date->format('Y-m-d')] = $obj;
        }

        $timeCard = array();
        $indice = 0;
        $startDate = new \DateTime('2015-01-01 00:00:00');
        $endDate = new \DateTime();

        while ($startDate <= $endDate ) {
            $lastDay = $endDate->format('j');
            $startMonth = new \DateTime($endDate->format('Y-m-01'));

            $timeCard[$indice] = array(
                'id' => $endDate->format('Ym'),
                'dates' => array(),
                'title' => $endDate->format('M / Y'),
                'active' => $indice == 0
            );

            for ( $day = 1; $day <= $lastDay; $day++ ) {
                $currentDate = $startMonth->format('Y-m-d');
                if ( isset($entitiesObj[$currentDate]) ) {
                    $timeCard[$indice]['dates'][] = $entitiesObj[$currentDate];
                } else {
                    $timeCard[$indice]['dates'][] = new TimeCardDateEntity(
                        array(
                            'date' => new \DateTime($currentDate)
                        )
                    );
                }
                $startMonth->modify('+1 day');
                $endDate->modify('-1 day');
            }
            $indice++;
        }

        return $timeCard;
    }

    /**
     * Saves a time card date
     *
     * @param TimeCardDateEntity $entity Time card date entity
     *
     * @access public
     * @return boolean
     */
    public function save(TimeCardDateEntity $entity)
    {
        return $this->persistence->save($entity->toArray());
    }

    /**
     * Delete a time card date
     *
     * @param  Entity $entity Time card date entity
     *
     * @access public
     * @return boolean
     */
    public function delete(TimeCardDateEntity $entity)
    {
        return $this->persistence->delete($entity->id);
    }
}