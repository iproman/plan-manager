<?php

use yii\helpers\Html;
use app\models\entities\Task;
use yii\helpers\Url;
use yii\bootstrap\Html as HB;
use app\models\service\Statuses;
use yii\bootstrap\Collapse;
use yii\widgets\Pjax;
use kartik\{
    grid\GridView,
    editable\Editable,
    export\ExportMenu,
    switchinput\SwitchInput
};

/* @var $this yii\web\View */
/* @var $projectName app\models\entities\Project */
/* @var $searchModel app\models\entities\TaskSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Tasks of ' . (!$projectName ? 'all projects' : $projectName);
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="task-index">

    <div class="row">
        <div class="col-lg-6">
            <h1 class="page-header"><?= Html::encode($this->title) ?></h1>
        </div>
        <div class="col-lg-4 flex-right vertical-align">
            <?= $fullExportMenu = ExportMenu::widget([
                'dataProvider' => $dataProvider,
                'columns' => [
                    'id',
                    'name',
                    'status',
                    'branch',
                    'project_id',
                    'created_at',
                    'updated_at',
                    'content',
                ],
                'target' => ExportMenu::TARGET_BLANK,
                'stream' => false, // this will automatically save file to a folder on web server
                'folder' => '@webroot/tmp/export',
                'linkPath' => '/tmp/export',
                'filename' => date('d.m.Y_H.i.s', time()),
                //'deleteAfterSave' => true,
                'fontAwesome' => true,
                'pjaxContainerId' => 'kv-pjax-container',
                'dropdownOptions' => [
                    'label' => 'Download tasks',
                    'class' => 'btn btn-default',
                    'itemsBefore' => [
                        '<li class="dropdown-header">Choose format</li>',
                    ],
                ],
            ]); ?>
        </div>
        <div class="col-lg-2 flex-right vertical-align">
            <?= Html::a('Create task', [
                'create',
                'project_id' => Yii::$app->request->get('project_id')
            ], ['class' => 'btn btn-success']) ?>
        </div>
    </div>

    <hr>

    <?= Collapse::widget([
        'items' => [
            [
                'label' => 'Search',
                'content' => $this->render('_search', ['model' => $searchModel]),
            ],
        ]
    ]);
    ?>

    <hr>
    <?php Pjax::begin(); ?>
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
                    return Editable::widget([
                        'name' => 'value',
                        'formOptions' => [
                            'method' => 'post',
                            'action' => Url::to([
                                'attribute/change',
                                'id' => $model->id,
                                'att' => 'name',
                                'class' => Task::class
                            ]),
                        ],
                        'pluginEvents' => [
                            'editableSuccess' => 'function(event, val, form, data){ toastr.success(data.msg); }',
                            "editableError" => "function(event, val, form, data) { toastr.error(data.message) }",
                        ],
                        'asPopover' => true,
                        'value' => $model->name,
                        'header' => 'name',
                        'size' => 'sm',
                        'showAjaxErrors' => true,
                    ]);
                },
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
                            'title' => Statuses::getStatuses()[$model->status],
                        ]
                    );
                },
                'contentOptions' => [
                    'style' => 'text-align:center',
                ]
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
                                'class' => Task::class
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
            ],
            'created_at:date',
            'updated_at:date',
            [
                'class' => 'yii\grid\ActionColumn',
                'template' => '{view} {update} {delete}',
                'buttons' => [
                    'view' => function ($url, $model, $key) {
                        return Html::a(
                            HB::icon('glyphicon glyphicon-eye-open'),
                            Url::to([
                                    'task/view',
                                    'id' => $model->id,
                                    'project_id' => Yii::$app->request->get('project_id')
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
                                    'task/update',
                                    'id' => $model->id,
                                    'project_id' => Yii::$app->request->get('project_id'),
                                    'page' => Yii::$app->request->get('page'),
                                ]
                            ),
                            [
                                'class' => 'btn btn-default btn-hover-info',
                            ]
                        );
                    },
                    'delete' => function ($url, $model, $key) {
                        /** @var $model Task */
                        return Html::a(
                            HB::icon('glyphicon glyphicon-trash'),
                            Url::to([
                                'delete',
                                'id' => $model->id,
                                'project_id' => $model->project_id,
                            ]),
                            [
                                'class' => 'btn btn-danger',
                                'title' => 'delete task',
                                'onclick' => 'confirmDeletion("' . Url::to([
                                        'delete',
                                        'id' => $model->id,
                                        'project_id' => $model->project_id,
                                    ]) . '");return false;',
                                'data-pjax' => '0',
                            ]
                        );
                    },
                ]
            ],
            [
                'attribute' => 'done?',
                'format' => 'raw',
                'value' => function ($model) {
                    /** @var \app\models\entities\Task $model */
                    return SwitchInput::widget([
                        'name' => 'status_12',
                        'pluginOptions' => [
                            'size' => 'mini',
                            'onText' => 'Y',
                            'offText' => 'N',
                            'state' => $model->status == 2 ? 1 : 0
                        ],
                        'pluginEvents' => [
                            'switchChange.bootstrapSwitch' => 'function(event, state) {
                                // Not default, because status `done` is 2
                                function stateValue(state){
                                    if(state >= 1) return 2;
                                    else return state;
                                }
                            
                                $.ajax({
                                        url: "' . Yii::$app->urlManager->createUrl([
                                    'attribute/change',
                                    'id' => $model->id,
                                    'hasEditable' => 1,
                                    'att' => 'status',
                                    'class' => Task::class
                                ]) . '",
                                        type: "post",
                                        data: {"value": stateValue(+state), "hasEditable": 1},
                                        cache: false,
                                        success: function(event, val, form, data){toastr.success(data); },
                                        error: function(event, val, form, data) { toastr.error(data) }
                                });
                            }'
                        ],
                    ]);
                }
            ],
        ],
    ]); ?>
    <?php Pjax::end(); ?>
</div>
