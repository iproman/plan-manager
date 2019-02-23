<?php

namespace app\models;

use Yii;
use yii\helpers\ArrayHelper;
use DateTime;
use yii\db\Query;
use yii\db\Expression;

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
    const STATUS_REJECTED = 4;

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
            self::STATUS_REJECTED,
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
            self::STATUS_REJECTED => 'Отклонено',
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
            self::STATUS_WARNING => 'warning',
            self::STATUS_REJECTED => 'rejected',
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
            self::STATUS_REJECTED => 'danger',
        ];
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
        if (null !== $status && null === $project) {
            return Task::find()->where(['=', 'status', $status])->count();
        } elseif (null !== $status && null !== $project) {
            return Task::find()
                ->where(['=', 'status', $status])
                ->andWhere(['=', 'project_id', $project])
                ->count();
        } else {
            return Task::find()->count();
        }
    }

    /**
     * Returns query of all tasks
     * divided into statuses and 7 days
     *
     * todo add dynamic selection name
     *
     * @return Query
     */
    private static function getHighChartsQuery()
    {
        // data for highCharts
        $startDate = date('d.m.Y', time() - 3600 * 24 * 7);
        $endDate = date('d.m.Y', time());
        $startTimestamp = (DateTime::createFromFormat('d.m.Y H:i:s', $startDate . ' 00:00:00'))
            ->getTimestamp();
        $endTimestamp = (DateTime::createFromFormat('d.m.Y H:i:s', $endDate . ' 23:59:59'))
            ->getTimestamp();

        return (new Query())
            ->select([
                'done' => new Expression(
                    'SUM(CASE WHEN status = :done THEN 1 ELSE 0 END)',
                    [':done' => Task::STATUS_DONE]
                ),
                'new' => new Expression(
                    'SUM(CASE WHEN status = :new THEN 1 ELSE 0 END)',
                    [':new' => Task::STATUS_NEW]
                ),
                'in_work' => new Expression(
                    'SUM(CASE WHEN status = :in_work THEN 1 ELSE 0 END)',
                    [':in_work' => Task::STATUS_IN_WORK]
                ),
                'warning' => new Expression(
                    'SUM(CASE WHEN status = :warning THEN 1 ELSE 0 END)',
                    [':warning' => Task::STATUS_WARNING]
                ),
                'week_day' => new Expression(
                    'DATE(FROM_UNIXTIME(updated_at))'
                ),
            ])
            ->from(Task::tableName())
            ->where(
                'updated_at >= :start AND updated_at <= :end',
                [
                    ':start' => $startTimestamp,
                    ':end' => $endTimestamp,
                ]
            )
            ->groupBy([
                'week_day',
            ]);
    }

    /**
     * If label exist count selected element from query
     * Else returns week days
     *
     * todo every time new 4 unnecessary queries
     * todo change names
     *
     * @param null $label
     * @return array
     */
    final public static function getCountedHighChartsResults($label = null)
    {
        $query = self::getHighChartsQuery();
        if (!empty($label)) {
            return array_map(
                'intval',
                ArrayHelper::getColumn(
                    $query->all(),
                    $label
                )
            );
        } else {
            return array_map(
                function ($v) {
                    return date('D', strtotime($v));
                },
                ArrayHelper::getColumn(
                    $query->all(),
                    'week_day'
                ));
        }
    }
}
