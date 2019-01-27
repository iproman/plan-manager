<?php

use yii\db\Migration;
use app\models\Title;

/**
 * Class m181205_223818_alter_table_title
 */
class m181205_223818_alter_table_title extends Migration
{

    const TABLE_NAME = '{{%title}}';

    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn(
            self::TABLE_NAME,
            'content',
            $this->text()->null()->comment('Контент')->after('name')
        );
        $this->addColumn(
            self::TABLE_NAME,
            'branch',
            $this->string(10)->null()->comment('Ветка')->after('content')
        );
        $this->addColumn(
            self::TABLE_NAME,
            'status',
            $this->smallInteger(1)->notNull()->defaultValue(0)->comment('Статус')->after('content')
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn(
            self::TABLE_NAME,
            'content'
        );
        $this->dropColumn(
            self::TABLE_NAME,
            'branch'
        );
        $this->dropColumn(
            self::TABLE_NAME,
            'status'
        );
    }
}
