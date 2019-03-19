<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
use rmrevin\yii\fontawesome\FAS;

/* @var $this yii\web\View */
/* @var $searchModel app\models\LogSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Logs';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="log-index">

    <div class="row">
        <div class="col-md-6">
            <h1><?= Html::encode($this->title) ?></h1>
        </div>
        <div class="col-md-6 text-right">
            <p>
                <?= Html::a('Create Log', ['create'], ['class' => 'btn btn-success']) ?>
            </p>
        </div>
    </div>
    <?= Html::a(
        FAS::i(FAS::_TRASH) . ' Delete all',
        ['purge-logs'],
        [
            'class' => 'btn btn-danger',
            'onclick' => 'return confirm("Are you sure, you want to delete all system log?");',
        ]
    ) ?>
    <hr>

    <?php Pjax::begin(); ?>

    <?= $this->render('_search', ['model' => $searchModel]); ?>

    <hr>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'level',
            'category',
            'log_time:datetime',
            'prefix:ntext',
            //'message:ntext',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
    <?php Pjax::end(); ?>
</div>
