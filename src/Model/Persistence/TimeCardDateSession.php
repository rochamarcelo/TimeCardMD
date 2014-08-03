<?php
namespace TimeCardMD\Model\Persistence;

class TimeCardDateSession implements TimeCardDateInterface
{
    protected $session;

    protected $lastInsertId;

    /**
     *
     * @param Array &$session An associative array containing session variables available to the current script.
     */
    public function __construct($session)
    {
        $this->session = $session;
    }

     /**
     * Find registry
     *
     * @param  integer $year  year
     * @param  integer $month month
     * @param  integer $day   day
     *
     * @access public
     * @return mixed
     */
    public function get($year, $month, $day)
    {
        $date = date("Y-m-d", mktime(0, 0, 0, $month, (int)$day, (int)$year));
        $id = $this->session->read('TimeCardDate.Map.date_to_id.' . $date);

        if ( $id === null ) {
            return array();
        }

        $result = $this->session->read('TimeCardDate.All.' . $id);
        if ( !is_array($result) ) {
            return array();
        }
        return $result;
    }

    /**
     * Find all
     *
     * @access public
     * @return array
     */
    public function findAll()
    {
        $result = $this->session->read('TimeCardDate.All');
        if ( !is_array($result) ) {
            return array();
        }
        return $result;
    }

    /**
     * Save a registry
     *
     * @param array $entity a registry
     *
     * @access public
     * @return boolean
     */
    public function save(array $entity)
    {
        $insert = false;
        if ( !isset($entity['id']) ) {
            $insert = true;
            $all = $this->findAll();
            if ( empty($all) ) {
                $entity['id'] = 1;
            } else {
                $entity['id'] = max(array_keys($all)) + 1;
            }
        }

        if ( !$this->session->write('TimeCardDate.All.' . $entity['id'], $entity) ) {
            return false;
        }

        if ( !$this->session->write('TimeCardDate.Map.date_to_id.' . $entity['date'], $entity['id']) ) {
            return false;
        }

        if ( $insert ) {
            $this->lastInsertId = $entity['id'];
        }

        return true;
    }

    /**
     * Delete a registry
     *
     * @param integer $id registry identification
     *
     * @access public
     * @return boolean
     */
    public function delete($id)
    {
        $entity = $this->session->read('TimeCardDate.All.' . $id);
        if ( empty($entity) ) {
            return true;
        }

        if ( !$this->session->delete('TimeCardDate.All.' . $entity['id']) ) {
            return false;
        }

        $this->session->delete('TimeCardDate.Map.date_to_id.' . $entity['date']);

        return true;
    }

    /**
     * Gets the value of lastInsertId.
     *
     * @return mixed
     */
    public function getLastInsertId()
    {
        return $this->lastInsertId;
    }
}