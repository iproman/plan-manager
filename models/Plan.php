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
     * Constants
     */
    const STATUS_NEW = 1;
    const STATUS_IN_WORK = 2;
    const STATUS_DONE = 3;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%plan}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [
                [
                    'title_id',
                    'time_id'
                ],
                'required'
            ],
            [
                [
                    'title_id',
                    'time_id',
                ],
                'integer'
            ],
            [
                [
                    'created_at',
                    'updated_at'
                ],
                'safe'
            ],
            [

                'time_id',
                'exist',
                'skipOnError' => true,
                'targetClass' => Time::className(),
                'targetAttribute' => [
                    'time_id' => 'id'
                ]
            ],
            [

                'title_id',
                'exist',
                'skipOnError' => true,
                'targetClass' => Title::className(),
                'targetAttribute' =>
                    [
                        'title_id' => 'id'
                    ]
            ],
            [
                'status',
                'in',
                'range' => array_keys(self::getStatuses()),
            ]
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

    /**
     * Returns statuses
     *
     * @return array
     */
    public static function getStatuses()
    {
        return [
            self::STATUS_NEW,
            self::STATUS_IN_WORK,
            self::STATUS_DONE,
        ];
    }

    /**
     * Returns status labels
     *
     * @return array
     */
    public static function getStatusLabels()
    {
        return [
            self::STATUS_NEW => 'new',
            self::STATUS_IN_WORK => 'in work',
            self::STATUS_DONE => 'done',
        ];
    }

    /**
     * Returns status for css
     *
     * @return array
     */
    public static function getStatusCss()
    {
        return [
            self::STATUS_NEW => 'success',
            self::STATUS_IN_WORK => 'info',
            self::STATUS_DONE => 'default',
        ];
    }
}
