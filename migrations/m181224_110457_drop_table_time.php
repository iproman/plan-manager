<?php

use yii\db\Migration;

/**
 * Class m181224_110457_drop_table_time
 */
class m181224_110457_drop_table_time extends Migration
{
    const TABLE_NAME = '{{%time}}';

    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->dropTable(self::TABLE_NAME);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
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
                'number' => $this->integer(11)->unsigned()->notNull()->comment('Кол-во'),
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
}
