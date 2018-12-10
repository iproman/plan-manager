<?php

use yii\db\Migration;
use app\models\Time;
use app\models\Title;
use app\models\Project;

/**
 * Class m181210_165546_alter_table_project
 */
class m181210_165546_alter_table_project extends Migration
{

    const TABLE_NAME = '{{%project}}';

    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->dropForeignKey(
            'FK_PLAN_TITLE_ID_TITLE_ID',
            self::TABLE_NAME
        );

        $this->dropForeignKey(
            'FK_PLAN_TIME_ID_TIME_ID',
            self::TABLE_NAME
        );

        $this->dropColumn(
            self::TABLE_NAME,
            'title_id'
        );

        $this->dropColumn(
            self::TABLE_NAME,
            'time_id'
        );

        $this->addColumn(
            self::TABLE_NAME,
            'name',
            $this->string(64)->notNull()->comment('Название')->after('id')
        );

    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->addColumn(
            self::TABLE_NAME,
            'title_id',
            $this->integer(11)->unsigned()->notNull()->comment('Title')->unique()
        );

        $this->addColumn(
            self::TABLE_NAME,
            'time_id',
            $this->integer(11)->unsigned()->notNull()->comment('Time')
        );

        $this->dropColumn(
            self::TABLE_NAME,
            'name'
        );

        $this->addForeignKey(
            'FK_PLAN_TITLE_ID_TITLE_ID',
            self::TABLE_NAME,
            'title_id',
            Title::tableName(),
            'id',
            'CASCADE',
            'CASCADE'
        );

        $this->addForeignKey(
            'FK_PLAN_TIME_ID_TIME_ID',
            self::TABLE_NAME,
            'time_id',
            Time::tableName(),
            'id',
            'CASCADE',
            'CASCADE'
        );
    }
}
