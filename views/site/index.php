<?php

use yii\helpers\Url;
use app\models\entities\Task;
use app\components\widgets\ViewDetails;
use miloschuman\highcharts\Highcharts;

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
            'link' => Url::to(['task/index', 'TaskSearch[status]' => Task::STATUS_NEW]),
        ]); ?>
        <?= ViewDetails::widget([
            'status' => Task::STATUS_DONE,
            'count' => $taskDone,
            'icon' => 'glyphicon-check',
            'text' => 'Completed tasks!',
            'link' => Url::to(['task/index', 'TaskSearch[status]' => Task::STATUS_DONE]),
        ]); ?>
        <?= ViewDetails::widget([
            'status' => Task::STATUS_IN_WORK,
            'count' => $taskInWork,
            'icon' => 'glyphicon-wrench',
            'text' => 'Tasks in work!',
            'link' => Url::to(['task/', 'TaskSearch[status]' => Task::STATUS_IN_WORK]),
        ]); ?>
        <?= ViewDetails::widget([
            'status' => Task::STATUS_WARNING,
            'count' => $taskWarning,
            'icon' => 'glyphicon-fire',
            'text' => 'Important tasks!',
            'link' => Url::to(['task/', 'TaskSearch[status]' => Task::STATUS_WARNING]),
        ]); ?>
    </div>
    <!-- /.row -->
    <div class="row">
        <div class="col-lg-8">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <i class="fa fa-bar-chart-o fa-fw"></i> Area Chart Example
                    <div class="pull-right">
                        <div class="btn-group">
                            <button type="button" class="btn btn-default btn-xs dropdown-toggle" data-toggle="dropdown">
                                Actions
                                <span class="caret"></span>
                            </button>
                            <ul class="dropdown-menu pull-right" role="menu">
                                <li><a href="#">Action</a>
                                </li>
                                <li><a href="#">Another action</a>
                                </li>
                                <li><a href="#">Something else here</a>
                                </li>
                                <li class="divider"></li>
                                <li><a href="#">Separated link</a>
                                </li>
                            </ul>
                        </div>
                    </div>
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
                    <?php foreach ($recentEvents as $event): ?>
                        <div class="list-group">
                            <a href="<?= Url::to(['task/view', 'id' => $event->event_id]) ?>" class="list-group-item">
                                <i class="fa fa-<?= $event->icon_name ?> fa-fw"></i> <?= $event->title ?>
                                <span class="pull-right text-muted small">
                                    <em><?= Yii::$app->formatter->asTime($event->created_at) ?></em>
                                </span>
                            </a>
                        </div>
                        <?php // todo Need time word endings ?>
                    <?php endforeach; ?>
                    <a href="<?= Url::to('/event/') ?>" class="btn btn-default btn-block">View All Alerts</a>
                </div>
            </div>
        </div>
        <div class="col-lg-4">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <i class="fa fa-bell fa-fw"></i> Notifications Panel
                </div>
                <!-- /.panel-heading -->
                <div class="panel-body">
                    <div class="list-group">
                        <a href="#" class="list-group-item">
                            <i class="fa fa-comment fa-fw"></i> New Comment
                            <span class="pull-right text-muted small"><em>4 minutes ago</em>
                                    </span>
                        </a>
                        <a href="#" class="list-group-item">
                            <i class="fa fa-twitter fa-fw"></i> 3 New Followers
                            <span class="pull-right text-muted small"><em>12 minutes ago</em>
                                    </span>
                        </a>
                        <a href="#" class="list-group-item">
                            <i class="fa fa-envelope fa-fw"></i> Message Sent
                            <span class="pull-right text-muted small"><em>27 minutes ago</em>
                                    </span>
                        </a>
                        <a href="#" class="list-group-item">
                            <i class="fa fa-tasks fa-fw"></i> New Task
                            <span class="pull-right text-muted small"><em>43 minutes ago</em>
                                    </span>
                        </a>
                        <a href="#" class="list-group-item">
                            <i class="fa fa-upload fa-fw"></i> Server Rebooted
                            <span class="pull-right text-muted small"><em>11:32 AM</em>
                                    </span>
                        </a>
                        <a href="#" class="list-group-item">
                            <i class="fa fa-bolt fa-fw"></i> Server Crashed!
                            <span class="pull-right text-muted small"><em>11:13 AM</em>
                                    </span>
                        </a>
                        <a href="#" class="list-group-item">
                            <i class="fa fa-warning fa-fw"></i> Server Not Responding
                            <span class="pull-right text-muted small"><em>10:57 AM</em>
                                    </span>
                        </a>
                        <a href="#" class="list-group-item">
                            <i class="fa fa-shopping-cart fa-fw"></i> New Order Placed
                            <span class="pull-right text-muted small"><em>9:49 AM</em>
                                    </span>
                        </a>
                        <a href="#" class="list-group-item">
                            <i class="fa fa-money fa-fw"></i> Payment Received
                            <span class="pull-right text-muted small"><em>Yesterday</em>
                                    </span>
                        </a>
                    </div>
                    <!-- /.list-group -->
                    <a href="#" class="btn btn-default btn-block">View All Alerts</a>
                </div>
                <!-- /.panel-body -->
            </div>
        </div>
        <!-- /.col-lg-4 -->
    </div>
    <!-- /.row -->
</div>
