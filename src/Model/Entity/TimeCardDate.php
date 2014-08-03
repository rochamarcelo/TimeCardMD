<?php
namespace TimeCardMD\Model\Entity;
/**
 * Manage the time card dates
 *
 * @package TimeCardMD.Entity
 */
class TimeCardDate
{
    public $id;

    public $additional_time;

    public $date;

    public $time_in_1;

    public $time_out_1;

    public $time_in_2;

    public $time_out_2;

    public $time_in_3;

    public $time_out_3;

    public $created;

    public $updated;

    public function toArray()
    {
        return array(
            'id' => $this->id,
            'additional_time' => $this->additional_time,
            'date' => $this->date,
            'time_in_1' => $this->time_in_1,
            'time_out_1' => $this->time_out_1,
            'time_in_2' => $this->time_in_2,
            'time_out_2' => $this->time_out_2,
            'time_in_3' => $this->time_in_3,
            'time_out_3' => $this->time_out_3,
            'created' => $this->created,
            'updated' => $this->updated,
        );
    }

    public function __construct($properties)
    {
        if ( !is_array($properties) || empty($properties) ) {
            return;
        }
        foreach ( $properties as $property => $value) {
            $this->$property = $value;
        }
    }
}