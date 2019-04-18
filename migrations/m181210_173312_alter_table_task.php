<?php

use yii\db\Migration;

/**
 * Class m181210_173312_alter_table_task
 */
class m181210_173312_alter_table_task extends Migration
{

    const TABLE_NAME = '{{%task}}';
    const PROJECT_TABLE_NAME = '{{%project}}';

    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn(
            self::TABLE_NAME,
            'project_id',
            $this->integer(11)->unsigned()->notNull()->comment('Project ID')->after('branch')
        );

        $this->addForeignKey(
            'FK_TASK_PROJECT_ID_PROJECT_ID',
            self::TABLE_NAME,
            'project_id',
            self::PROJECT_TABLE_NAME,
            'id',
            'CASCADE',
            'CASCADE'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropForeignKey(
            'FK_TASK_PROJECT_ID_PROJECT_ID',
            self::TABLE_NAME
        );

        $this->dropColumn(
            self::TABLE_NAME,
            'project_id'
        );
    }
}
