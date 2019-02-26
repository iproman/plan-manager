<?php

use yii\helpers\Html;
use kartik\grid\GridView;
use yii\helpers\StringHelper;
use app\models\Task;
use yii\helpers\Url;
use kartik\editable\Editable;
use kartik\export\ExportMenu;
use yii\bootstrap\Html as HB;

/* @var $this yii\web\View */
/* @var $projectName app\models\Project */
/* @var $searchModel app\models\TaskSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Задачи ' . (!$projectName ? 'всех проектов' : $projectName);
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
                    'label' => 'Скачать задачи',
                    'class' => 'btn btn-default',
                    'itemsBefore' => [
                        '<li class="dropdown-header">Выберите формат</li>',
                    ],
                ],
            ]); ?>
        </div>
        <div class="col-lg-2 flex-right vertical-align">
            <?= Html::a('Создать задачу', [
                'create',
                'project_id' => Yii::$app->request->get('project_id')
            ], ['class' => 'btn btn-success']) ?>
        </div>
    </div>

    <hr>

    <?= $this->render('_search', ['model' => $searchModel]); ?>

    <hr>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'condensed' => true,
        'responsive' => true,
        'hover' => true,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'name',
            [
                'attribute' => 'content',
                'value' => function ($model) {
                    return StringHelper::truncateWords(strip_tags($model->content), 5, '...');
                },
                'format' => 'raw',
            ],
            [
                'attribute' => 'status',
                'format' => 'raw',
                'value' => function ($model) {
                    /** @var \app\models\Task $model */
                    return Html::tag(
                        'span',
                        Task::getStatusLabels()[$model->status],
                        [
                            'class' => 'label label-' . Task::getStatusCss()[$model->status],
                            'data-toggle' => 'tooltip',
                            'title' => Task::getStatuses()[$model->status],
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
                                'task/change',
                                'id' => $model->id,
                            ])
                        ],
                        'pluginEvents' => [
                          'editableSuccess' => 'function(event, val, form, data){
                            toastr.success(data.msg);
                          }'
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
                        return Html::a(
                            HB::icon('glyphicon glyphicon-trash'),
                            Url::to([
                                    'task/delete',
                                    'id' => $model->id,
                                    'project_id' => Yii::$app->request->get('project_id'),
                                    'page' => Yii::$app->request->get('page'),
                                ]
                            ),
                            [
                                'class' => 'btn btn-default btn-hover-danger',
                                'onclick' => 'return confirm("Вы уверены, что хотите удалить задачу #' . $model->id . ' ?");',
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
