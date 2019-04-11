<?php

namespace app\models\entities;

use Yii;

/**
 * This is the model class for table "event".
 *
 * @property int $id ID
 * @property string $title Title
 * @property string $icon_name Icon name
 * @property int $event_id Event ID
 * @property string $event_name Event name
 */
class Event extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'event';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['event_id'], 'required'],
            [['event_id'], 'integer'],
            [['title', 'event_name'], 'string', 'max' => 255],
            [['icon_name'], 'string', 'max' => 50],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'title' => 'Title',
            'icon_name' => 'Icon Name',
            'event_id' => 'Event ID',
            'event_name' => 'Event Name',
        ];
    }
}
