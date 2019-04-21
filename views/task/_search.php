<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\Url;
use app\models\service\Statuses;

/* @var $this yii\web\View */
/* @var $model app\models\entities\TaskSearch */
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
        <div class="col-lg-2"><?= $form->field($model, 'status')->dropDownList(
                Statuses::getStatusNames(),
                ['prompt' => 'Выберите статус']
            ) ?>
        </div>
        <div class="col-lg-2"><?= $form->field($model, 'branch') ?></div>
        <div class="col-lg-3"><?= $form->field($model, 'content') ?></div>
    </div>

    <div class="row">
        <div class="col-lg-12">
            <div class="form-group">
                <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
                <?= Html::a(
                    'Reset',
                    Url::to(['task/index', 'project_id' => Yii::$app->request->get('project_id')]),
                    ['class' => 'btn btn-default',]) ?>
            </div>
        </div>
    </div>
    <?php ActiveForm::end(); ?>
</div>
