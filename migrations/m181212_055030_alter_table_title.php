<?php

use yii\db\Migration;
use app\models\Title;

/**
 * Class m181212_055030_alter_table_title
 */
class m181212_055030_alter_table_title extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->renameTable(
            Title::tableName(),
            'task'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->renameTable(
            Title::tableName(),
            'title'
        );
    }

}
