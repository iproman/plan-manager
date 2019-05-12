<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\helpers\Url;
use app\models\service\Statuses;

/* @var $this yii\web\View */
/* @var $model app\models\entities\Task */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Задачи', 'url' => ['index', 'project_id' => Yii::$app->request->get('project_id')]];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="task-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Обновить', Url::to([
                'update',
                'id' => $model->id,
                'project_id' => Yii::$app->request->get('project_id'),
            ]
        ), ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Удалить', Url::to([
                'delete',
                'id' => $model->id,
                'project_id' => Yii::$app->request->get('project_id'),
            ]
        ), [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => "Вы уверены, что хотите удалить задачу #{$model->id}?",
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'name',
            'content',
            [
                'attribute' => 'status',
                'format' => 'raw',
                'value' => function ($model) {
                    /** @var $model app\models\entities\Task */
                    return '<p class="label label-' . Statuses::getStatusCss()[$model->status] . '">
                    '
                        . Statuses::getStatusNames()[$model->status] .
                        '</p>';
                },
            ],
            [
                'attribute' => 'project_id',
                'format' => 'raw',
                'value' => function ($model) {
                    /** @var $model app\models\entities\Task */
                    return $model->project->name;
                },
            ],
            'branch',
            'created_at:datetime',
            'updated_at:datetime',
        ],
    ]) ?>

</div>
