<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\models\service\Statuses;

/* @var $this yii\web\View */
/* @var $model app\models\entities\Project */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="plan-form">

    <?php $form = ActiveForm::begin(); ?>
    <div class="row">
        <div class="col-lg-6 col-sm-12">
            <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-4">
            <?= $form->field($model, 'branch')->textInput([
                'maxlength' => true,
                'value' => 'iss',
            ]) ?>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-4">
            <?= $form->field($model, 'status', ['labelOptions' => ['style' => 'display: block']])->radioList(
                Statuses::getStatusLabels(),
                [
                    'class' => 'btn-group',
                    'data-toggle' => 'buttons',
                    'unselect' => null,
                    'item' => function ($index, $label, $name, $checked, $value) {
                        return Html::tag(
                            'label',
                            Html::radio($name, $checked, ['value' => $value]) . $label,
                            [
                                'class' => 'btn btn-' . Statuses::getStatusCss()[$value] . ($checked ? ' active' : ''),
                            ]
                        );
                    },
                ]
            ) ?>
        </div>
    </div>

    <hr>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>
</div>

