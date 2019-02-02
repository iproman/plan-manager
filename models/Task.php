<?php

namespace app\models;

use Yii;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "task".
 *
 * @property int $id ID
 * @property string $name Название
 * @property string $content Содержание
 * @property int $status Статус
 * @property string $branch Ветка
 * @property int $project_id Название проекта
 * @property int $created_at Создано
 * @property int $updated_at Обновлено
 *
 * @property Project[] $projects
 */
class Task extends Base
{

    /**
     * Constants
     */
    const STATUS_NEW = 0;
    const STATUS_IN_WORK = 1;
    const STATUS_DONE = 2;
    const STATUS_WARNING = 3;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%task}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [
                'name',
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
                'name',
                'string',
                'max' => 64
            ],
            [
                'branch',
                'string',
                'max' => 10
            ],
            [
                [
                    'content',
                    'branch',
                ],
                'default',
                'value' => null,
            ],
            [
                'content',
                'string',
                'max' => 1000
            ],
            [
                'status',
                'in',
                'range' => array_keys(self::getStatuses()),
            ],
            [
                'status',
                'default',
                'value' => 0,
            ],
            [
                'project_id',
                'required'
            ],
            [
                'project_id',
                'integer'
            ],
            [

                'project_id',
                'exist',
                'skipOnError' => true,
                'targetClass' => Project::class,
                'targetAttribute' => [
                    'project_id' => 'id'
                ]
            ],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Имя',
            'content' => 'Содержание',
            'status' => 'Статус',
            'branch' => 'Ветка',
            'project_id' => 'Проект',
            'created_at' => 'Создано',
            'updated_at' => 'Обновлено',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProject()
    {
        return $this->hasOne(Project::class, ['id' => 'project_id']);
    }

    /**
     * @return array
     */
    public static function getTaskNames()
    {
        $taskList = Task::find()->asArray()->all();

        return ArrayHelper::map($taskList, 'id', 'name');
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
            self::STATUS_WARNING,
        ];
    }

    /**
     * Returns statuses names
     *
     * @return array
     */
    public static function getStatusNames()
    {
        return [
            self::STATUS_NEW => 'Новая задача',
            self::STATUS_IN_WORK => 'В работе',
            self::STATUS_DONE => 'Завершена',
            self::STATUS_WARNING => 'Срочная',
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
            self::STATUS_WARNING => 'warning'
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
            self::STATUS_WARNING => 'warning',
        ];
    }

    /**
     * Return counted tasks
     *
     * @param null $e
     * @return int|string
     */
    public static function getCountedTasks($e = null)
    {
        if (null !== $e) {
            return Task::find()->where(['=', 'status', $e])->count();
        } else {
            return Task::find()->count();
        }
    }
}
