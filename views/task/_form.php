<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\models\Task;
use app\models\Project;
use yii\helpers\ArrayHelper;
use dosamigos\ckeditor\CKEditor;

/* @var $this yii\web\View */
/* @var $model app\models\Task */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="task-form">

    <?php $form = ActiveForm::begin(); ?>
    <div class="row">
        <div class="col-lg-12">
            <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <?= $form->field($model, 'content')->widget(CKEditor::class, [
                'options' => ['rows' => 5],
                'preset' => 'standart',
            ]) ?>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-3">
            <?= $form->field($model, 'status')->radioList(
                Task::getStatusLabels(),
                [
                    'class' => 'btn-group',
                    'data-toggle' => 'buttons',
                    'unselect' => null,
                    'item' => function ($index, $label, $name, $checked, $value) {
                        return Html::tag(
                            'label',
                            Html::radio($name, $checked, ['value' => $value]) . $label,
                            [
                                'class' => 'btn btn-' . Task::getStatusCss()[$value] . ($checked ? ' active' : ''),
                            ]
                        );
                    },
                ]
            ) ?>
        </div>
        <div class="col-lg-3">
            <?= $form->field($model, 'branch')->textInput(['maxlength' => true]) ?>
        </div>
        <div class="col-lg-3">
            <?= $form->field($model, 'project_id')->dropDownList(
                ArrayHelper::map(
                    Project::getProjects(),
                    'id',
                    'name'
                ),
                [
                    'prompt' => 'Choose project name',
                ]
            ) ?>
        </div>
    </div>
    <hr>
    <div class="form-group">
        <?= Html::submitButton('Сохранить', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
