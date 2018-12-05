<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\models\Plan;
use app\models\Time;
use app\models\Title;

/* @var $this yii\web\View */
/* @var $model app\models\Plan */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="plan-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'title_id')->dropDownList(Title::getTitleNames()) ?>

    <?= $form->field($model, 'time_id')->dropDownList(Time::getTimeNumbers()) ?>

    <?= $form->field($model, 'status')->dropDownList(Plan::getStatuses()) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
