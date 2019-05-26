<?php

use yii\db\Migration;

/**
 * Handles adding color to table `{{%project}}`.
 */
class m190526_021826_add_color_column_to_project_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('{{%project}}', 'color', $this->string(7));
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('{{%project}}', 'color');
    }
}
