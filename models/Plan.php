<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "plan".
 *
 * @property int $id ID
 * @property int $title_id Title
 * @property int $time_id Time
 * @property int $status Состояние
 * @property int $created_at Создано
 * @property int $updated_at Обновлено
 *
 * @property Time $time
 * @property Title $title
 */
class Plan extends Base
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'plan';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['title_id', 'time_id'], 'required'],
            [['title_id', 'time_id', 'status'], 'integer'],
            [['created_at', 'updated_at'], 'safe'],
            [['time_id'], 'exist', 'skipOnError' => true, 'targetClass' => Time::className(), 'targetAttribute' => ['time_id' => 'id']],
            [['title_id'], 'exist', 'skipOnError' => true, 'targetClass' => Title::className(), 'targetAttribute' => ['title_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'title_id' => 'Title ID',
            'time_id' => 'Time ID',
            'status' => 'Status',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTime()
    {
        return $this->hasOne(Time::className(), ['id' => 'time_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTitle()
    {
        return $this->hasOne(Title::className(), ['id' => 'title_id']);
    }
}
