<?php

use yii\helpers\Url;
use app\widgets\ViewDetails;
use miloschuman\highcharts\Highcharts;
use app\models\service\Statuses;

/* @var $this yii\web\View */
/* @var $taskNew \app\models\entities\Task */
/* @var $taskDone \app\models\entities\Task */
/* @var $taskInWork \app\models\entities\Task */
/* @var $taskWarning \app\models\entities\Task */
/* @var $done \app\models\entities\Task */
/* @var $in_work \app\models\entities\Task */
/* @var $warning \app\models\entities\Task */
/* @var $new \app\models\entities\Task */
/* @var $dayLabels \app\models\entities\Task */
/* @var $recentEvents \app\models\entities\Event */

$this->title = 'My Yii Application';

?>
<div class="site-index">
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Сегодня <?= date('d-m-Y') ?></h1>
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <!-- /.row -->
    <div class="row">
        <?= ViewDetails::widget([
            'link' => Url::to(['task/index', 'TaskSearch[status]' => Statuses::STATUS_NEW]),
        ]); ?>
        <?= ViewDetails::widget([
            'status' => Statuses::STATUS_DONE,
            'count' => $taskDone,
            'icon' => 'glyphicon-check',
            'text' => 'Completed tasks!',
            'link' => Url::to(['task/index', 'TaskSearch[status]' => Statuses::STATUS_DONE]),
        ]); ?>
        <?= ViewDetails::widget([
            'status' => Statuses::STATUS_IN_WORK,
            'count' => $taskInWork,
            'icon' => 'glyphicon-wrench',
            'text' => 'Tasks in work!',
            'link' => Url::to(['task/', 'TaskSearch[status]' => Statuses::STATUS_IN_WORK]),
        ]); ?>
        <?= ViewDetails::widget([
            'status' => Statuses::STATUS_WARNING,
            'count' => $taskWarning,
            'icon' => 'glyphicon-fire',
            'text' => 'Important tasks!',
            'link' => Url::to(['task/', 'TaskSearch[status]' => Statuses::STATUS_WARNING]),
        ]); ?>
    </div>
    <!-- /.row -->
    <div class="row">
        <div class="col-lg-8">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <i class="fa fa-bar-chart-o fa-fw"></i> Area Chart
                </div>
                <!-- /.panel-heading -->
                <div class="panel-body">
                    <?= Highcharts::widget([
                        'options' => [
                            'title' => ['text' => 'All tasks'],
                            'xAxis' => [
                                'categories' => $dayLabels
                            ],
                            'yAxis' => [
                                'title' => ['text' => 'Quantity']
                            ],
                            'series' => [
                                // todo change into 1 array and names from task labels
                                ['name' => 'In work', 'data' => $in_work],
                                ['name' => 'Completed', 'data' => $done],
                                ['name' => 'New', 'data' => $new],
                                ['name' => 'Important', 'data' => $warning],
                            ],
                            'credits' => ['enabled' => false],
                        ]
                    ]);
                    ?>
                </div>
                <!-- /.panel-body -->
            </div>
            <!-- /.panel -->
        </div>
        <!-- /.col-lg-8 -->
        <div class="col-lg-4">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <i class="fa fa-bell fa-fw"></i> Notifications Panel
                </div>
                <div class="panel-body">
                    <div class="list-group">
                        <?php foreach ($recentEvents as $event): ?>
                            <a href="<?= Url::to(['task/view', 'id' => $event->event_id]) ?>" class="list-group-item">
                                <i class="fa fa-<?= $event->icon_name ?> fa-fw"></i> <?= $event->title ?>
                                <span class="pull-right text-muted small">
                                    <em><?= Yii::$app->formatter->asTime($event->created_at) ?></em>
                                </span>
                            </a>
                        <?php endforeach; ?>
                        <?php // todo Need time word endings ?>
                    </div>
                    <a href="<?= Url::to('/event/') ?>" class="btn btn-default btn-block">View All Alerts</a>
                </div>
            </div>
        </div>
    </div>
    <!-- /.row -->
</div>
