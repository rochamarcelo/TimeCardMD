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
        if ( empty($entities) ) {
            return array();
        }

        foreach ( $entities as $k => $entity ) {
            $entities[$k] = new TimeCardDateEntity($entity);
        }

        return $entities;
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