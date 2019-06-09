<?php

use yii\db\Migration;

/**
 * Handles adding columns to table `{{%task}}`.
 */
class m190609_230416_add_event_time_column_to_task_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('{{%task}}', 'event_time', $this->time()->comment('Event time'));
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('{{%task}}', 'event_time');
    }
}
