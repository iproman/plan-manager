<?php

namespace app\models\entities;

use yii\helpers\ArrayHelper;
use app\models\service\Statuses;

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
                'content',
                'default',
                'value' => null,
            ],
            [
                'branch',
                'default',
                'value' => 'none',
            ],
            [
                'content',
                'string',
                'max' => 2000
            ],
            [
                'status',
                'in',
                'range' => Statuses::getStatuses(),
            ],
            [
                'status',
                'default',
                'value' => Statuses::STATUS_NEW,
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
     * todo Bad experience, too much query and dirty code
     *
     * Return counted tasks
     *
     * @param null $status
     * @param null $project
     * @return int|string
     */
    public static function getCountedTasks($status = null, $project = null)
    {
        $task = Task::find();

        if (null !== $status && null === $project) {
            return (clone $task)
                ->where(['=', 'status', $status])
                ->count();
        } elseif (null !== $status && null !== $project) {
            return (clone $task)
                ->where(['=', 'status', $status])
                ->andWhere(['=', 'project_id', $project])
                ->count();
        } else {
            return (clone $task)
                ->count();
        }
    }
}
