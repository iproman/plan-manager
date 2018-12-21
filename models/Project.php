<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "project".
 *
 * @property int $id ID
 * @property int $created_at Создано
 * @property int $updated_at Обновлено
 *
 * @property Time $time
 * @property Task $task
 */
class Project extends Base
{

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%project}}';
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
                'name',
                'string'
            ],
            [
                [
                    'created_at',
                    'updated_at'
                ],
                'safe'
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
            'name' => 'Название проекта',
            'created_at' => 'Создано',
            'updated_at' => 'Обновлено',
        ];
    }

    /**
     * Return project name
     *
     * @param $projectId
     * @return mixed
     */
    public static function getProjectName($projectId)
    {
        $project = Project::find()
            ->where(['=', 'id', $projectId])
            ->asArray()
            ->one();

        return $project['name'];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTask()
    {
        return $this->hasMany(
            Task::class,
            ['project_id' => 'id']
        );
    }

}
