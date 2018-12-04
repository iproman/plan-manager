<?php

use yii\db\Migration;
use app\models\Plan;

/**
 * Class m181204_160334_create_table_title
 */
class m181204_160334_create_table_title extends Migration
{
    const TABLE_NAME = '{{%title}}';

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
                'name' => $this->string(64)->notNull()->comment('Название'),
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


    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {

        $this->dropTable(self::TABLE_NAME);
    }
}
