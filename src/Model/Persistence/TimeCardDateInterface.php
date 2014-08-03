<?php
namespace TimeCardMD\Model\Persistence;
interface TimeCardDateInterface
{

     /**
     * Find registry
     *
     * @param  integer $year  year
     * @param  integer $month month
     * @param  integer $day   day
     *
     * @access public
     * @return array
     */
    public function get($year, $month, $day);

    /**
     * Find all
     *
     * @access public
     * @return Entity
     */
    public function findAll();

    /**
     * Save a registry
     *
     * @param array $entity a registry
     *
     * @access public
     * @return boolean
     */
    public function save(array $entity);

    /**
     * Delete a registry
     *
     * @param integer $id registry identification
     *
     * @access public
     * @return boolean
     */
    public function delete($id);
}