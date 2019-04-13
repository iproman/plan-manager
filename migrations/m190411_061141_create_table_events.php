<?php

use yii\db\Migration;

/**
 * Class m190411_061141_create_table_events
 */
class m190411_061141_create_table_events extends Migration
{
    const TABLE_NAME = '{{%event}}';

    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable(
            self::TABLE_NAME,
            [
                'id' => $this->primaryKey(11)->unsigned()->comment('ID'),
                'title' => $this->string(255)->unsigned()->Null()->comment('Title'),
                'icon_name' => $this->string(50)->unsigned()->Null()->comment('Icon name'),
                'event_id' => $this->integer(11)->unsigned()->notNull()->comment('Event ID'),
                'event_name' => $this->string(255)->unsigned()->Null()->comment('Event name'),
                'created_at' => $this->integer(11)->unsigned()->notNull()->comment('Created at'),
                'updated_at' => $this->integer(11)->unsigned()->notNull()->comment('Updated at'),
            ],
            $tableOptions
        );

        $this->createIndex(
            'id',
            self::TABLE_NAME,
            'id'
        );

        $this->createIndex(
            'event_id',
            self::TABLE_NAME,
            'event_id'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable(self::TABLE_NAME);
    }
}
