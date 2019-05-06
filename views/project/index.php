<?php

use yii\helpers\Html;
use kartik\grid\GridView;
use yii\bootstrap\Html as HB;
use yii\helpers\Url;
use app\models\entities\Task;
use app\models\service\Statuses;
use yii\bootstrap\Collapse;
use kartik\editable\Editable;
use app\models\entities\Project;

/* @var $this yii\web\View */
/* @var $searchModel app\models\entities\ProjectSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */
/* @var $model app\models\entities\Project[] */

$this->title = 'Projects';
$this->params['breadcrumbs'][] = $this->title;
$this->registerCss('
    .td-none, .td-none:hover, .td-none:active {
        text-decoration: none;
    }
    .ml-10{
        margin-left: 10px;
    }
    .m-0{
        margin: 0;
    }
');
?>
<div class="plan-index">

    <div class="row">
        <div class="col-lg-6">
            <h1 class="page-header"><?= Html::encode($this->title) ?></h1>
        </div>
        <div class="col-lg-6 flex-right vertical-align">
            <p>
                <?= Html::a('Create project', ['create'], ['class' => 'btn btn-success']) ?>
            </p>
        </div>
    </div>

    <?= Collapse::widget([
        'items' => [
            [
                'label' => 'Search',
                'content' => $this->render('_search', ['model' => $searchModel]),
            ],
        ]
    ]);
    ?>

    <div class="row">
        <?= GridView::widget([
            'dataProvider' => $dataProvider,
            'condensed' => true,
            'responsive' => true,
            'hover' => true,
            'columns' => [
                ['class' => 'yii\grid\SerialColumn'],
                [
                    'attribute' => 'name',
                    'format' => 'raw',
                    'value' => function ($model) {
                        /** @var \app\models\entities\Task $model */
                        return $model->name . ' ' . Html::a(HB::icon('glyphicon glyphicon-plus'), ['/task/create', 'project_id' => $model->id],
                                [
                                    'class' => 'btn-sm btn-success pull-right td-none ml-10',
                                    'title' => 'Create task',
                                ]
                            )
                            .
                            Html::a(HB::icon('glyphicon glyphicon-tasks'), ['/task/index', 'project_id' => $model->id],
                                [
                                    'class' => 'btn-sm btn-primary pull-right td-none',
                                    'title' => 'All tasks',
                                ]
                            );
                    },
                ],
                [
                    'attribute' => 'Number of tasks',
                    'format' => 'raw',
                    'value' => function ($model) {
                        return 'Total: ' . Task::getCountedTasks(null, $model->id) . '<br><hr class="m-0">' .
                            Html::tag(
                                'p',
                                ' (New: ' . Task::getCountedTasks(Statuses::STATUS_NEW, $model->id) . ','
                                . ' In work: ' . Task::getCountedTasks(Statuses::STATUS_IN_WORK, $model->id) . ','
                                . ' Warning: ' . Task::getCountedTasks(Statuses::STATUS_WARNING, $model->id) . ','
                                . ' Rejected: ' . Task::getCountedTasks(Statuses::STATUS_REJECTED, $model->id) . ','
                                . ' Done: ' . Task::getCountedTasks(Statuses::STATUS_DONE, $model->id) . ')'
                                ,
                                ['class' => 'text-muted small text-right m-0']
                            );
                    }
                ],
                [
                    'attribute' => 'status',
                    'format' => 'raw',
                    'value' => function ($model) {
                        /** @var \app\models\entities\Task $model */
                        return Html::tag(
                            'span',
                            Statuses::getStatusLabels()[$model->status],
                            [
                                'class' => 'label label-' . Statuses::getStatusCss()[$model->status],
                                'data-toggle' => 'tooltip',
                                'title' => Statuses::getStatusLabels()[$model->status],
                            ]
                        );
                    },
                    'contentOptions' => [
                        'class' => 'text-center',
                    ],
                ],
                [
                    'attribute' => 'branch',
                    'format' => 'raw',
                    'value' => function ($model) {
                        return Editable::widget([
                            'name' => 'value',
                            'formOptions' => [
                                'method' => 'post',
                                'action' => Url::to([
                                    'attribute/change',
                                    'id' => $model->id,
                                    'att' => 'branch',
                                    'class' => Project::class
                                ]),
                            ],
                            'pluginEvents' => [
                                'editableSuccess' => 'function(event, val, form, data){ toastr.success(data.msg); }',
                                "editableError" => "function(event, val, form, data) { toastr.error(data.message) }",
                            ],
                            'asPopover' => true,
                            'value' => $model->branch,
                            'header' => 'branch',
                            'size' => 'sm',
                            'showAjaxErrors' => true,
                        ]);
                    },
                    'contentOptions' => [
                        'class' => 'text-center',
                    ],
                ],
                'created_at:date',
                [
                    'class' => 'yii\grid\ActionColumn',
                    'template' => '{view} {update} {delete}',
                    'buttons' => [
                        'view' => function ($url, $model, $key) {
                            return Html::a(
                                HB::icon('glyphicon glyphicon-eye-open'),
                                Url::to([
                                        'view',
                                        'id' => $model->id,
                                    ]
                                ),
                                [
                                    'class' => 'btn btn-default btn-hover-success',
                                ]
                            );
                        },
                        'update' => function ($url, $model, $key) {
                            return Html::a(
                                HB::icon('glyphicon glyphicon-pencil'),
                                Url::to([
                                        'update',
                                        'id' => $model->id,
                                    ]
                                ),
                                [
                                    'class' => 'btn btn-default btn-hover-info',
                                ]
                            );
                        },
                        'delete' => function ($url, $model, $key) {
                            return Html::a(
                                HB::icon('glyphicon glyphicon-trash'),
                                Url::to([
                                        'delete',
                                        'id' => $model->id,
                                    ]
                                ),
                                [
                                    'class' => 'btn btn-default btn-hover-danger',
                                    'onclick' => 'return confirm("Are you sure, you want to delete task #' . $model->id . ' ?");',
                                    'pjax' => '0',
                                    'data-method' => 'POST',
                                ]
                            );
                        },
                    ]
                ]
            ],
        ]); ?>
    </div>
</div>