<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\entities\EventSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Events';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="event-index">

    <div class="row">
        <div class="col-lg-6">
            <h1><?= Html::encode($this->title) ?></h1>
        </div>
        <div class="col-lg-6 text-right">
            <span>
            <?= Html::a('Create Event', ['create'], ['class' => 'btn btn-success']) ?>
        </span>

            <span>
            <?= Html::a(
                '<span class="glyphicon glyphicon-trash" aria-hidden="true"></span>' . ' Delete all',
                ['purge-events'],
                [
                    'class' => 'btn btn-danger',
                    'onclick' => 'return confirm("Are you sure, you want to delete all events?");',
                ]
            ) ?>
        </span>
        </div>
    </div>

    <hr>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'title',
            'icon_name',
            'event_id',
            'event_name',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
