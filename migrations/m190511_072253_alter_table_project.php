<?php

use yii\db\Migration;

/**
 * Class m190511_072253_alter_table_project
 */
class m190511_072253_alter_table_project extends Migration
{
    const TABLE_NAME = '{{%project}}';

    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn(
            self::TABLE_NAME,
            'sort',
            $this->integer(11)->unsigned()->notNull()->defaultValue(0)->comment('Sort')
        );
        $this->createIndex(
            'sort',
            self::TABLE_NAME,
            'sort',
            false
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn(
            self::TABLE_NAME,
            'sort'
        );
    }
}
