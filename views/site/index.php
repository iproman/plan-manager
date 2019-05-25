<?php

use yii\helpers\Url;
use app\widgets\ViewDetails;
use miloschuman\highcharts\Highcharts;
use app\models\service\Statuses;
use app\models\entities\{
    Task,
    Event,
    Project
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
/** @var $projects Project */
$this->title = 'My Yii Application';

?>
<div class="site-index">
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Today is <?= date('d-m-Y') ?></h1>
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
                    <i class="fa fa-table fa-fw"></i> Projects Panel
                </div>
                <div class="panel-body">
                    <div class="list-group">
                        <?php foreach ($projects as $project): ?>
                            <?php /** @var $project Project */ ?>
                            <a href="<?= Url::to(['/task/index', 'project_id' => $project->id]) ?>"
                               class="list-group-item">
                                <i class="fa fa-diamond fa-fw"></i> <?= $project->name ?>
                                <span class="pull-right text-muted small">
                                    <em><?= $project->tasksCount ?></em>
                                </span>
                            </a>
                        <?php endforeach; ?>
                    </div>
                    <a href="<?= Url::to('/project/') ?>" class="btn btn-default btn-block">View All Projects</a>
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
                        <?php foreach (Statuses::getStatuses() as $name): ?>
                            <?php $percent = $countedTasks[$name] * 100 / $totalTasks ^ 0 ?>
                            <li><a tabindex="-1"></a><a href="<?= Url::to(['task/', 'TaskSearch[status]' => $name]) ?>">
                                    <div><p><strong><?= Statuses::getStatusNames()[$name] ?></strong>
                                            <span class="pull-right text-muted"><?= $percent ?>% Complete</span></p>
                                        <div class="progress progress-striped active">
                                            <div class="progress-bar progress-bar-<?= Statuses::getStatusCss()[$name] ?>"
                                                 role="progressbar"
                                                 aria-valuenow="<?= $percent ?>" aria-valuemin="0" aria-valuemax="100"
                                                 style="width: <?= $percent ?>%">
                                                <span class="sr-only"><?= $percent ?>% Complete (success)</span></div>
                                        </div>
                                    </div>
                                </a></li>
                            <hr>
                        <?php endforeach; ?>
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
        <!-- /.col-lg-4 -->
    </div>
    <!-- /.row -->
</div>
