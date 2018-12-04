<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "time".
 *
 * @property int $id ID
 * @property string $name Название
 * @property int $number Кол-во
 * @property int $created_at Создано
 * @property int $updated_at Обновлено
 *
 * @property Plan[] $plans
 */
class Time extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'time';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'number', 'created_at', 'updated_at'], 'required'],
            [['number', 'created_at', 'updated_at'], 'integer'],
            [['name'], 'string', 'max' => 64],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'number' => 'Number',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPlans()
    {
        return $this->hasMany(Plan::className(), ['time_id' => 'id']);
    }
}
