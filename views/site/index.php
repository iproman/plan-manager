<?php

use rmrevin\yii\fontawesome\FAS;
use yii\helpers\Html;
use app\models\Task;

/* @var $this yii\web\View */
/* @var $taskNew \app\models\Task */
/* @var $taskDone \app\models\Task */
/* @var $taskInWork \app\models\Task */
/* @var $taskWarning \app\models\Task */

$this->title = 'My Yii Application';

/**
 * @param $status
 * @param $count
 * @param null $fa
 * @param null $text
 * @return string
 * @throws \yii\base\InvalidConfigException
 */
function viewDetails($status, $count, $fa = null, $text = null)
{
    // todo change mix
    if (!is_null($text)) {
        return '<div class="col-lg-3 col-md-6">
            <div class="panel panel-' . Task::getStatusCss()[$status] . '">
                <div class="panel-heading">
                    <div class="row">
                        <div class="col-xs-3">
                            ' . FAS::i($fa)->addCssClass('fa-5x') . '
                        </div>
                        <div class="col-xs-9 text-right">
                            <div class="huge">' . $count . '</div>
                            <div>New tasks!</div>
                        </div>
                    </div>
                </div>'
            . Html::a(
                Html::tag(
                    'div',
                    Html::tag('span', $text, ['class' => 'pull-left']) .
                    Html::tag('span', FAS::i(FAS::_ARROW_ALT_CIRCLE_RIGHT), ['class' => 'pull-right']) .
                    Html::tag('div', '', ['class' => 'clearfix']),
                    ['class' => 'panel-footer']
                )
            ) . '
            </div>
        </div>';
    }
}

?>
<div class="site-index">
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Сегодня <?= date('d') ?></h1>
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <!-- /.row -->
    <div class="row">
        <?= viewDetails(Task::STATUS_NEW, $taskNew, FAS::_CART_PLUS, 'View Details1') ?>
        <?= viewDetails(Task::STATUS_DONE, $taskDone, FAS::_CART_PLUS, 'View Details2') ?>
        <?= viewDetails(Task::STATUS_IN_WORK, $taskInWork, FAS::_CART_PLUS, 'View Details3') ?>
        <?= viewDetails(Task::STATUS_WARNING, $taskWarning, FAS::_CART_PLUS, 'View Details4') ?>
    </div>
    <!-- /.row -->
</div>
