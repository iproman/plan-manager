<?php

use app\models\Task;
use rmrevin\yii\fontawesome\FAS;
use yii\helpers\Html;

/** @var $status string */
/** @var $fa \rmrevin\yii\fontawesome\FAS */
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
                Html::tag('div', FAS::i($fa)->addCssClass('fa-5x'), ['class' => 'col-xs-3']) .
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
                Html::tag('span', FAS::i(FAS::_ARROW_ALT_CIRCLE_RIGHT), ['class' => 'pull-right']) .
                Html::tag('div', '', ['class' => 'clearfix']),
                ['class' => 'panel-footer']
            ),
            $link),
        ['class' => 'panel panel-' . Task::getStatusCss()[$status]]
    ),
    ['class' => 'col-lg-3 col-md-6']
)
?>



