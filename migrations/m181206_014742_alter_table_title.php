<?php

use yii\db\Migration;
use app\models\Title;

/**
 * Class m181206_014742_alter_table_title
 */
class m181206_014742_alter_table_title extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn(
            Title::tableName(),
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
            Title::tableName(),
            'status'
        );
    }
}
