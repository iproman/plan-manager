<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\ProjectSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */
/* @var $model app\models\Project[] */

$this->title = 'Проекты';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="plan-index">

    <div class="row">
        <div class="col-lg-6">
            <h1><?= Html::encode($this->title) ?></h1>
        </div>
        <div class="col-lg-6 text-right">
            <p>
                <?= Html::a('Создать проект', ['create'], ['class' => 'btn btn-success']) ?>
            </p>
        </div>
    </div>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            [
                'attribute' => 'name',
                'format' => 'raw',
                'value' => function ($model) {
                    /** @var \app\models\Task $model */
                    return $model->name . ' ' . Html::a('Задачи', ['/task/index', 'project_id' => $model->id],
                            [
                                'class' => 'btn-sm btn-primary pull-right',
                            ]
                        );
                },
            ],
            [
                'attribute' => 'Количество статей',
                'format' => 'raw',
                'value' => function ($model) {
                    return count($model->task);
                }
            ],
            'created_at:date',
            //'updated_at',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
