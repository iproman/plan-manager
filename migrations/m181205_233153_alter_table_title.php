<?php

use yii\db\Migration;
use app\models\Title;

/**
 * Class m181205_233153_alter_table_title
 */
class m181205_233153_alter_table_title extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn(
            Title::tableName(),
            'branch',
            $this->string(10)->null()->comment('Ветка')->after('content')
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn(
            Title::tableName(),
            'branch'
        );
    }
}
