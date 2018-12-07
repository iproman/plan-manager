<?php

use yii\db\Migration;
use app\models\Project;

/**
 * Class m181207_074659_alter_table_plan
 */
class m181207_074659_alter_table_plan extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->dropColumn(
            Project::tableName(),
            'status'
        );

        $this->renameTable(
            Project::tableName(),
            'project'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->addColumn(
            Project::tableName(),
            'status',
            $this->smallInteger(1)->unsigned()->notNull()->defaultValue(0)->comment('Состояние')->after('time_id')
        );

        $this->renameTable(
            Project::tableName(),
            'plan'
        );
    }
}
