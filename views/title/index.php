<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\StringHelper;
use app\models\Title;
use yii\helpers\Url;
use app\models\Project;
use rmrevin\yii\fontawesome\FAS;

/* @var $this yii\web\View */
/* @var $searchModel app\models\TitleSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Задачи ' . (!Yii::$app->request->get('project_id') ?
        'всех проектов' :
        Project::getProjectName(Yii::$app->request->get('project_id')));
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="title-index">

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
                /** @var \app\models\Title $model */
                return Title::printStatus($model->status);
            },
        ],
        'branch',
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
                                'title/view',
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
                                'title/update',
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
                                'title/delete',
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
