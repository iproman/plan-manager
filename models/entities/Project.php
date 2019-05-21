<?php

namespace app\models\entities;

use Yii;
use app\models\service\Statuses;

/**
 * This is the model class for table "project".
 *
 * @property int $id ID
 * @property int $created_at Created at
 * @property int $updated_at Updated at
 * @property string $name Name
 * @property string $branch Branch
 * @property integer $status Status
 * @property int $sort Sort
 *
 * @property Task $task
 */
class Project extends Base
{

    public $tasksCount;

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
            [
                'branch',
                'string',
                'max' => 10
            ],
            [
                'branch',
                'default',
                'value' => 'none',
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
                'sort',
                'integer',
            ],
            [
                'sort',
                'default',
                'value' => 0,
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
            'name' => 'Project name',
            'branch' => 'Branch prefix',
            'status' => 'Status',
            'sort' => 'Sort',
            'created_at' => 'Created at',
            'updated_at' => 'Updated at',
        ];
    }

    /**
     * Returns project name
     *
     * @param $projectId
     * @return mixed
     * @throws \yii\db\Exception
     */
    public static function getProjectName($projectId)
    {
        $project = Yii::$app->db->createCommand('SELECT * FROM project WHERE id=:project_id')
            ->bindValue(':project_id', $projectId)
            ->queryOne();

        return $project['name'];
    }

    /**
     * Returns all projects
     *
     * @return array|\yii\db\ActiveRecord[]
     */
    final public static function getProjects()
    {
        return Project::find()
            ->asArray()
            ->all();
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTasks()
    {
        return $this->hasMany(
            Task::class,
            ['project_id' => 'id']
        );
    }

}
