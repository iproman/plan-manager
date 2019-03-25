<?php
/**
 * Created by PhpStorm.
 * User: iproman
 * Date: 04.12.2018
 * Time: 20:23
 */

namespace app\models\entities;

use yii\db\ActiveRecord;
use yii\helpers\ArrayHelper;

class Base extends ActiveRecord
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return ArrayHelper::merge(
            parent::behaviors(),
            [
                'timestamp' => [
                    'class' => 'yii\behaviors\TimestampBehavior',
                    'attributes' => [
                        ActiveRecord::EVENT_BEFORE_INSERT => ['created_at', 'updated_at'],
                        ActiveRecord::EVENT_BEFORE_UPDATE => ['updated_at'],
                    ],
                ],
            ]
        );
    }
}