<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\StringHelper;
use app\models\Task;
use yii\helpers\Url;
use app\models\Project;
use rmrevin\yii\fontawesome\FAS;
use kartik\editable\Editable;
use kartik\export\ExportMenu;

/* @var $this yii\web\View */
/* @var $searchModel app\models\TaskSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Задачи ' . (!Yii::$app->request->get('project_id') ?
        'всех проектов' :
        Project::getProjectName(Yii::$app->request->get('project_id')));
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="task-index">

    <div class="row">
        <div class="col-lg-6">
            <h1><?= Html::encode($this->title) ?></h1>
        </div>
        <div class="col-lg-6 text-right">
            <?= Html::a('Создать задачу', [
                'create',
                'project_id' => Yii::$app->request->get('project_id')
            ], ['class' => 'btn btn-success']) ?>
        </div>
    </div>
    <div class="row text-right">
        <div class="col-lg-12">
            <?= $fullExportMenu = ExportMenu::widget([
                'dataProvider' => $dataProvider,
                'columns' => [
                    'id',
                    'name',
                    'content',
                    'status',
                    'branch',
                    'project_id',
                    'created_at',
                    'updated_at',
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
    </div>


    <?php
    $columns = [];

    if (!Yii::$app->request->get('project_id')) {
        $columns[] = 'project_id';
    }

    $columns = array_merge($columns, [
        ['class' => 'yii\grid\SerialColumn'],
        'id',
        'name',
        [
            'attribute' => 'content',
            'value' => function ($model) {
                return StringHelper::truncateWords($model->content, 5, '...');
            }
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
                    'name' => 'branch',
                    'formOptions' => [
                        'method' => 'post',
                        'action' => Url::to([
                            'task/change',
                            'id' => $model->id,
                        ])
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
                        FAS::i(FAS::_EYE),
                        Url::to([
                                'task/view',
                                'id' => $model->id,
                                'project_id' => Yii::$app->request->get('project_id')
                            ]
                        )
                    );
                },
                'update' => function ($url, $model, $key) {
                    return Html::a(
                        FAS::i(FAS::_PEN),
                        Url::to([
                                'task/update',
                                'id' => $model->id,
                                'project_id' => Yii::$app->request->get('project_id')
                            ]
                        )
                    );
                },
                'delete' => function ($url, $model, $key) {
                    return Html::a(
                        FAS::i(FAS::_TRASH_ALT),
                        Url::to([
                                'task/delete',
                                'id' => $model->id
                            ]
                        )
                    );
                },
            ]
        ]
    ])
    ?>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => $columns,
    ]); ?>
</div>
