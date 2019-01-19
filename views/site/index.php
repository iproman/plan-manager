<?php

use yii\helpers\Url;
use rmrevin\yii\fontawesome\FAS;
use app\models\Task;
use app\components\ViewDetails;

/* @var $this yii\web\View */
/* @var $taskNew \app\models\Task */
/* @var $taskDone \app\models\Task */
/* @var $taskInWork \app\models\Task */
/* @var $taskWarning \app\models\Task */

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
        <?= ViewDetails::widget(); ?>
        <?= ViewDetails::widget([
            'status' => Task::STATUS_DONE,
            'count' => $taskDone,
            'fa' => FAS::_CHECK,
            'text' => 'Completed tasks!',
            'link' => Url::to(['task/']),
        ]); ?>
        <?= ViewDetails::widget([
            'status' => Task::STATUS_IN_WORK,
            'count' => $taskInWork,
            'fa' => FAS::_CROSSHAIRS,
            'text' => 'Tasks in work!',
            'link' => Url::to(['task/']),
        ]); ?>
        <?= ViewDetails::widget([
            'status' => Task::STATUS_WARNING,
            'count' => $taskWarning,
            'fa' => FAS::_FIRE,
            'text' => 'Important tasks!',
            'link' => Url::to(['task/']),
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
                    <div id="morris-area-chart"></div>
                </div>
                <!-- /.panel-body -->
            </div>
            <!-- /.panel -->
        </div>
        <!-- /.col-lg-8 -->
        <div class="col-lg-4">
        </div>
        <!-- /.col-lg-4 -->
    </div>
    <!-- /.row -->
</div>
