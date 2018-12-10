<?php

use yii\db\Migration;
use app\models\Project;

/**
 * Class m181210_173312_alter_table_title
 */
class m181210_173312_alter_table_title extends Migration
{

    const TABLE_NAME = '{{%title}}';

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
            'FK_TITLE_PROJECT_ID_PROJECT_ID',
            self::TABLE_NAME,
            'project_id',
            Project::tableName(),
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
            'FK_TITLE_PROJECT_ID_PROJECT_ID',
            self::TABLE_NAME
        );

        $this->dropColumn(
            self::TABLE_NAME,
            'project_id'
        );
    }
}
