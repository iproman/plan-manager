<?php

use yii\helpers\Url;
use rmrevin\yii\fontawesome\FAS;
use app\models\Task;
use app\components\ViewDetails;
use dosamigos\chartjs\ChartJs;

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
        <?= ViewDetails::widget([
            'link' => Url::to(['task/index', 'TaskSearch[status]' => Task::STATUS_NEW]),
        ]); ?>
        <?= ViewDetails::widget([
            'status' => Task::STATUS_DONE,
            'count' => $taskDone,
            'fa' => FAS::_CHECK,
            'text' => 'Completed tasks!',
            'link' => Url::to(['task/index', 'TaskSearch[status]' => Task::STATUS_DONE]),
        ]); ?>
        <?= ViewDetails::widget([
            'status' => Task::STATUS_IN_WORK,
            'count' => $taskInWork,
            'fa' => FAS::_CROSSHAIRS,
            'text' => 'Tasks in work!',
            'link' => Url::to(['task/', 'TaskSearch[status]' => Task::STATUS_IN_WORK]),
        ]); ?>
        <?= ViewDetails::widget([
            'status' => Task::STATUS_WARNING,
            'count' => $taskWarning,
            'fa' => FAS::_FIRE,
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
                    <?= ChartJs::widget([
                        'type' => 'line',
                        'options' => [
//                            'height' => 200,
//                            'width' => 400,
                        ],
                        'data' => [
//                            'radius' =>  "90%",
                            'labels' => ["January", "February", "March", "April", "May", "June", "July"],
                            'datasets' => [
                                [
                                    'label' => "My First dataset",
                                    'backgroundColor' => "rgba(179,181,198,0.2)",
                                    'borderColor' => "rgba(179,181,198,1)",
                                    'pointBackgroundColor' => "rgba(179,181,198,1)",
                                    'pointBorderColor' => "#fff",
                                    'pointHoverBackgroundColor' => "#fff",
                                    'pointHoverBorderColor' => "rgba(179,181,198,1)",
                                    'data' => [65, 59, 90, 81, 56, 55, 40]
                                ],
                                [
                                    'label' => "My Second dataset",
                                    'backgroundColor' => "rgba(255,99,132,0.2)",
                                    'borderColor' => "rgba(255,99,132,1)",
                                    'pointBackgroundColor' => "rgba(255,99,132,1)",
                                    'pointBorderColor' => "#fff",
                                    'pointHoverBackgroundColor' => "#fff",
                                    'pointHoverBorderColor' => "rgba(255,99,132,1)",
                                    'data' => [28, 48, 40, 19, 96, 27, 100]
                                ],

                            ]
                        ],
                    ]);
                    ?>
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
