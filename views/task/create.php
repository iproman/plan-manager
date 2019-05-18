<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\entities\Task */

$this->title = 'Create task';
$this->params['breadcrumbs'][] = ['label' => 'Tasks', 'url' => ['index', 'project_id' => Yii::$app->request->get('project_id')]];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="task-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
