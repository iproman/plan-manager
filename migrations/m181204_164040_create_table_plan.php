<?php

use yii\db\Migration;
/**
 * Class m181204_164040_create_table_plan
 */
class m181204_164040_create_table_plan extends Migration
{
    const TABLE_NAME = '{{%project}}';
    const TASK_TABLE_NAME = '{{%task}}';

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
                'title_id' => $this->integer(11)->unsigned()->notNull()->comment('Title')->unique(),
                'time_id' => $this->integer(11)->unsigned()->notNull()->comment('Time'),
                'status' => $this->smallInteger(1)->unsigned()->notNull()->defaultValue(0)->comment('Состояние'),
                'created_at' => $this->integer(11)->unsigned()->notNull()->comment('Создано'),
                'updated_at' => $this->integer(11)->unsigned()->notNull()->comment('Обновлено'),
            ],
            $tableOptions
        );

        $this->createIndex(
            'id',
            self::TABLE_NAME,
            'id'
        );
        $this->createIndex(
            'created_at',
            self::TABLE_NAME,
            'created_at'
        );

        $this->addForeignKey(
            'FK_PLAN_TITLE_ID_TITLE_ID',
            self::TABLE_NAME,
            'title_id',
            self::TASK_TABLE_NAME,
            'id',
            'CASCADE',
            'CASCADE'
        );

        $this->addForeignKey(
            'FK_PLAN_TIME_ID_TIME_ID',
            self::TABLE_NAME,
            'time_id',
            self::TASK_TABLE_NAME,
            'id',
            'CASCADE',
            'CASCADE'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropForeignKey(
            'FK_PLAN_TITLE_ID_TITLE_ID',
            self::TABLE_NAME
        );

        $this->dropForeignKey(
            'FK_PLAN_TIME_ID_TIME_ID',
            self::TABLE_NAME
        );

        $this->dropTable(self::TABLE_NAME);
    }
}
