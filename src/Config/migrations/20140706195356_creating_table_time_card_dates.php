<?php

use Phinx\Migration\AbstractMigration;

class CreatingTableTimeCardDates extends AbstractMigration
{
    /**
     * Migrate Up.
     */
    public function up()
    {
        $table = $this->table('time_card_dates');
        $table->addColumn('additional_time', 'time', array('default' => null))
              ->addColumn('date', 'date')
              ->addColumn('time_in_1', 'time', array('null' => true, 'default' => null))
              ->addColumn('time_out_1', 'time', array('null' => true, 'default' => null))
              ->addColumn('time_in_2', 'time', array('null' => true, 'default' => null))
              ->addColumn('time_out_2', 'time', array('null' => true, 'default' => null))
              ->addColumn('time_in_3', 'time', array('null' => true, 'default' => null))
              ->addColumn('time_out_3', 'time', array('null' => true, 'default' => null))
              ->addColumn('created', 'datetime')
              ->addColumn('updated', 'datetime', array('default' => null))
              ->addIndex(array('date'), array('unique' => true))
              ->save();
    }

    /**
     * Migrate Down.
     */
    public function down()
    {
        $this->dropTable('time_card_dates');
    }
}