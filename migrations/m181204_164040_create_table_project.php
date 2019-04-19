<?php

use yii\db\Migration;

/**
 * Class m181204_164040_create_table_project
 */
class m181204_164040_create_table_project extends Migration
{
    const TABLE_NAME = '{{%project}}';

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
                'name' => $this->string(64)->notNull()->comment('Project name'),
                'status' => $this->smallInteger(1)->unsigned()->notNull()->defaultValue(0)->comment('Status'),
                'branch' => $this->string(10)->null()->defaultValue('iss')->comment('Branch prefix'),
                'created_at' => $this->integer(11)->unsigned()->notNull()->comment('Created_at'),
                'updated_at' => $this->integer(11)->unsigned()->notNull()->comment('Updated_at'),
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
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable(self::TABLE_NAME);
    }
}
