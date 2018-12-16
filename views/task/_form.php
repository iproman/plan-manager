<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Task */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="task-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'content')->textarea(['maxlength' => true, 'rows' => 10]) ?>

    <div class="row">
        <div class="col-lg-3">
            <?= $form->field($model, 'status')->textInput(['maxlength' => true]) ?>
        </div>
        <div class="col-lg-3">
            <?= $form->field($model, 'branch')->textInput(['maxlength' => true]) ?>
        </div>
        <div class="col-lg-3">
            <?php if (!Yii::$app->request->get('project_id')): ?>
                <?= $form->field($model, 'project_id')->textInput(['maxlength' => true]) ?>
            <?php endif; ?>
        </div>
    </div>

    <div class="form-group">
        <?= Html::submitButton('Сохранить', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
