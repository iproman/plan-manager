<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\LogSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="log-search">
    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
        'options' => [
            'data-pjax' => 1
        ],
    ]); ?>

    <div class="row">
        <div class="col-md-2"><?= $form->field($model, 'id') ?></div>
        <div class="col-md-2"><?= $form->field($model, 'level') ?></div>
        <div class="col-md-3"><?= $form->field($model, 'category') ?></div>
        <div class="col-md-3"><?= $form->field($model, 'prefix') ?></div>
        <div class="col-md-2"><?= $form->field($model, 'log_time') ?></div>
    </div>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>
</div>
