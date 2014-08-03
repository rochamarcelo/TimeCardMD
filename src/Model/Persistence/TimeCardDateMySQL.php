<?php
namespace TimeCardMD\Model\Persistence;

class TimeCardDateMySQL implements TimeCardDateInterface
{
    protected $connection;

    protected $lastInsertId;
    /**
     *
     * @param PDO $connection PDO object
     */
    public function __construct(\PDO $connection)
    {
        $this->connection = $connection;
    }

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
    public function get($year, $month, $day)
    {
        $date = date("Y-m-d", mktime(0, 0, 0, $month, $day, $year));
        $query = "SELECT * FROM time_card_dates WHERE date = $date LIMIT 1;";
        $sth =  $this->connection->prepare($query);
        return $sth->fetch();
    }

    /**
     * Find all
     *
     * @access public
     * @return array
     */
    public function findAll()
    {
        $query = 'SELECT * FROM time_card_dates ORDER BY date;'
        $sth =  $this->connection->prepare($query);
        return $sth->fetchAll();
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
        $fields = array_keys($entity);

        if ( isset($entity['id']) ) {
            $fieldBind = array();
            foreach ( $fields as $field ) {
                $fieldBind[] = $field . ' = ?';
            }
            $fieldBind = implode($fields, ',');
            $query = 'UPDATE time_card_dates SET $fieldBind WHERE id = ' . (int)$entity['id'];
        } else {
            $fieldsNames = implode($fields, ',');
            $binds = array_fill(0, count($fields), '?');
            $binds = implode($binds, ',');
            $query = "INSERT INTO time_card_dates ($fieldsNames) VAlUES($binds);";
        }

        $sth = $this->connection->prepare($query);

        if ( $sth === false ) {
            return false;
        }
        $values = array();
        foreach ( $fields as $ind => $field) {
            $values[] = $entity[$field];
        }

        if ( !$sth->execute() ) {
            return false;
        }

        if ( !isset($entity['id']) ) {
            $this->lastInsertId = $this->connection->lastInsertId();
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
        $query = 'DELETE FROM time_card_dates WHERE id = ' . (int)$id;
        $count = $this->connection->exec($query);

        return $count !== false;
    }

    /**
     * Gets the value of connection.
     *
     * @return mixed
     */
    public function getConnection()
    {
        return $this->connection;
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