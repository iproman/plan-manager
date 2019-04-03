<?php

use app\models\entities\Task;
use yii\helpers\Html;

/** @var $status string */
/** @var $icon \rmrevin\yii\fontawesome\FAS */
/** @var $count integer */
/** @var $text string */
/** @var $link \yii\helpers\Url */
?>

<?= Html::tag(
    'div',
    Html::tag(
        'div',
        Html::tag(
            'div',
            Html::tag(
                'div',
                '<div class="col-xs-3"><span class="glyphicon ' . $icon . ' gi-5x" aria-hidden="true"></span></div>' .
                Html::tag(
                    'div',
                    Html::tag('div', $count, ['class' => 'huge']) . Html::tag('div', $text),
                    ['class' => 'col-xs-9 text-right']
                ),
                ['class' => 'row']
            ),
            ['class' => 'panel-heading']
        ) . Html::a(
            Html::tag(
                'div',
                Html::tag('span', 'View Details', ['class' => 'pull-left']) .
                '<span class="glyphicon glyphicon-arrow-right pull-right" aria-hidden="true"></span>' .
                Html::tag('div', '', ['class' => 'clearfix']),
                ['class' => 'panel-footer']
            ),
            $link),
        ['class' => 'panel panel-' . Task::getStatusCss()[$status]]
    ),
    ['class' => 'col-lg-3 col-md-6']
)
?>

