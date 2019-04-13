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
class Event extends Base
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
            [
                ['event_id'],
                'required'
            ],
            [
                [
                    'created_at',
                    'updated_at'
                ],
                'safe'
            ],
            [
                ['event_id'],
                'integer'
            ],
            [
                [
                    'title',
                    'event_name'
                ],
                'string',
                'max' => 255
            ],
            [
                ['icon_name'],
                'string',
                'max' => 50
            ],
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
            'created_at' => 'Created at',
            'updated_at' => 'Updated at',
        ];
    }

    /**
     * Recent events
     *
     * todo cache
     *
     * @param int $count
     * @return mixed
     */
    final public static function getRecentEvents($count = 9)
    {
        return static::find()
            ->orderBy([
                'created_at' => SORT_DESC,
            ])
            ->limit($count)
            ->all();
    }
}
