<?php

use yii\helpers\Url;
use app\widgets\ViewDetails;
use miloschuman\highcharts\Highcharts;
use app\models\service\Statuses;
use app\models\entities\{
    Task,
    Event
};

/* @var $this yii\web\View */
/* @var $taskNew , $taskDone Task */
/* @var $taskDone Task */
/* @var $taskInWork Task */
/* @var $taskWarning Task */
/* @var $taskNew Task */
/* @var $taskRejected Task */
/* @var $done Task */
/* @var $in_work Task */
/* @var $warning Task */
/* @var $new Task */
/* @var $dayLabels Task */
/* @var $totalTasks Task */
/* @var $recentEvents Event */
/** @var $event Event */
/** @var $countedTasks Task */

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
                            <a href="<?=
                            !empty($event->event_name)
                                ? Url::to([$event->event_name . '/view', 'id' => $event->event_id])
                                : false;
                            ?>"
                               class="list-group-item">
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
    <div class="row">
        <div class="col-lg-8">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <i class="fa fa-bars fa-fw"></i> Project completion
                </div>
                <!-- /.panel-heading -->
                <div class="panel-body">
                    <ul>
                        <li><a tabindex="-1"></a><a href="/project">
                                <div><p><strong>Task 1</strong>
                                        <span class="pull-right text-muted">40% Complete</span></p>
                                    <div class="progress progress-striped active">
                                        <div class="progress-bar progress-bar-success" role="progressbar"
                                             aria-valuenow="40" aria-valuemin="0" aria-valuemax="100" style="width:40%">
                                            <span class="sr-only">40% Complete (success)</span></div>
                                    </div>
                                </div>
                            </a></li>
                        <hr>
                        <li><a tabindex="-1"></a><a href="/project">
                                <div><p><strong>Task 2</strong>
                                        <span class="pull-right text-muted">20% Complete</span></p>
                                    <div class="progress progress-striped active">
                                        <div class="progress-bar progress-bar-info" role="progressbar"
                                             aria-valuenow="20" aria-valuemin="0" aria-valuemax="100" style="width:20%">
                                            <span class="sr-only">20% Complete (success)</span></div>
                                    </div>
                                </div>
                            </a></li>
                        <hr>
                        <li><a tabindex="-1"></a><a href="/project">
                                <div><p><strong>Task 3</strong>
                                        <span class="pull-right text-muted">60% Complete</span></p>
                                    <div class="progress progress-striped active">
                                        <div class="progress-bar progress-bar-warning" role="progressbar"
                                             aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width:20%">
                                            <span class="sr-only">60% Complete (success)</span></div>
                                    </div>
                                </div>
                            </a></li>
                        <hr>
                        <li><a tabindex="-1"></a><a href="/project">
                                <div><p><strong>Task 4</strong>
                                        <span class="pull-right text-muted">80% Complete</span></p>
                                    <div class="progress progress-striped active">
                                        <div class="progress-bar progress-bar-danger" role="progressbar"
                                             aria-valuenow="80" aria-valuemin="0" aria-valuemax="100" style="width:80%">
                                            <span class="sr-only">80% Complete (success)</span></div>
                                    </div>
                                </div>
                            </a></li>
                        <hr>
                        <li><a tabindex="-1"></a><a class="text-center" href="<?= Url::to('/project/index') ?>"><strong>See
                                    All Tasks</strong>
                                <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span></a></li>
                    </ul>
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
                            <a href="<?=
                            !empty($event->event_name)
                                ? Url::to([$event->event_name . '/view', 'id' => $event->event_id])
                                : false;
                            ?>"
                               class="list-group-item">
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
