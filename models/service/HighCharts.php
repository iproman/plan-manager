<?php
/**
 * Created by PhpStorm.
 * User: iproman
 * Date: 20.04.2019
 * Time: 13:58
 */

namespace app\models\service;

use DateTime;
use yii\db\Query;
use yii\db\Expression;
use app\models\entities\Task;
use yii\helpers\ArrayHelper;
use Yii;

/**
 * Class HighCharts
 * @package app\models\service
 */
abstract class HighCharts
{
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

        return Yii::$app->cache->getOrSet(
            'high-charts-query',
            function () use ($startTimestamp, $endTimestamp) {
                return (new Query())
                    ->select([
                        'done' => new Expression(
                            'SUM(CASE WHEN status = :done THEN 1 ELSE 0 END)',
                            [':done' => Statuses::STATUS_DONE]
                        ),
                        'new' => new Expression(
                            'SUM(CASE WHEN status = :new THEN 1 ELSE 0 END)',
                            [':new' => Statuses::STATUS_NEW]
                        ),
                        'in_work' => new Expression(
                            'SUM(CASE WHEN status = :in_work THEN 1 ELSE 0 END)',
                            [':in_work' => Statuses::STATUS_IN_WORK]
                        ),
                        'warning' => new Expression(
                            'SUM(CASE WHEN status = :warning THEN 1 ELSE 0 END)',
                            [':warning' => Statuses::STATUS_WARNING]
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
            },
            Yii::$app->params['cache']['day']
        );
    }

    /**
     * If label exist count selected element from query
     * Else returns week days
     *
     *
     * @param null $label
     * @return array
     */
    final public static function getCountedHighChartsResults($label = null)
    {
        $query = self::getHighChartsQuery();
        if (!empty($label)) {
            return Yii::$app->cache->getOrSet(
                'counted-high-charts-results-' . $label,
                function () use ($query, $label) {
                    return array_map(
                        'intval',
                        ArrayHelper::getColumn(
                            $query->all(),
                            $label
                        )
                    );
                },
                Yii::$app->params['cache']['day']
            );
        } else {
            return Yii::$app->cache->getOrSet(
                'counted-high-charts-results',
                function () use ($query) {
                    return array_map(
                        function ($v) {
                            return date('D', strtotime($v));
                        },
                        ArrayHelper::getColumn(
                            $query->all(),
                            'week_day'
                        ));
                },
                Yii::$app->params['cache']['day']
            );
        }
    }
}