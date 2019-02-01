<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\TaskSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="task-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <div class="row">
        <div class="col-lg-2"><?= $form->field($model, 'id') ?></div>
        <div class="col-lg-3"> <?= $form->field($model, 'name') ?></div>
        <div class="col-lg-2"><?= $form->field($model, 'status') ?></div>
        <div class="col-lg-2"><?= $form->field($model, 'branch') ?></div>
        <div class="col-lg-3"><?= $form->field($model, 'content') ?></div>
        <?= $form->field($model, 'project_id')->hiddenInput([
            'value' => Yii::$app->request->get('project_id'),
        ])->label(false) ?>
    </div>

    <div class="row">
        <div class="col-lg-12">
            <div class="form-group">
                <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
                <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
            </div>
        </div>
    </div>
    <?php ActiveForm::end(); ?>
</div>
