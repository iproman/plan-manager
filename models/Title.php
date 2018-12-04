<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "title".
 *
 * @property int $id ID
 * @property string $name Название
 * @property int $created_at Создано
 * @property int $updated_at Обновлено
 *
 * @property Plan[] $plans
 */
class Title extends Base
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'title';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            ['name', 'required'],
            [['created_at', 'updated_at'], 'safe'],
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
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPlans()
    {
        return $this->hasMany(Plan::className(), ['title_id' => 'id']);
    }
}
