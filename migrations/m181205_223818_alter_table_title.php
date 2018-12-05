<?php

use yii\db\Migration;
use app\models\Title;

/**
 * Class m181205_223818_alter_table_title
 */
class m181205_223818_alter_table_title extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn(
            Title::tableName(),
            'content',
            $this->text()->null()->comment('Контент')->after('name')
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn(
            Title::tableName(),
            'content'
        );
    }
}
