<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\models\entities\Project;
use yii\helpers\ArrayHelper;
use dosamigos\ckeditor\CKEditor;
use app\models\service\Statuses;
use kartik\time\TimePicker;

/* @var $this yii\web\View */
/* @var $model app\models\entities\Task */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="task-form">

    <?php $form = ActiveForm::begin(); ?>
    <div class="row">
        <div class="col-lg-6">
            <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>
        </div>
        <div class="col-lg-6">
            <?php echo $form->field($model, 'event_time')->widget(TimePicker::class, [
                    'pluginOptions' => [
                            'showMeridian' => false,
                            'defaultTime' => '00:00'
                    ],
            ]); ?>
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
        <div class="col-lg-4">
            <?= $form->field($model, 'branch')->textInput(['maxlength' => true]) ?>
        </div>
        <div class="col-lg-4">
            <?= $form->field($model, 'project_id')->dropDownList(
                ArrayHelper::map(Project::getProjects(), 'id', 'name'),
                [
                    'prompt' => 'Выберите проект',
                    'value' => Yii::$app->request->get('project_id'),
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
