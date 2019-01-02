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

function viewDetails($text = null)
{
    if (!is_null($text)) {
        return Html::a(
            Html::tag(
                'div',
                Html::tag('span', $text, ['class' => 'pull-left']) .
                Html::tag('span', FAS::i(FAS::_ARROW_ALT_CIRCLE_RIGHT), ['class' => 'pull-right']) .
                Html::tag('div', ['class' => 'clearfix']),
                ['class' => 'panel-footer']
            )
        );
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
        <div class="col-lg-3 col-md-6">
            <div class="panel panel-<?= Task::getStatusCss()[Task::STATUS_NEW] ?>">
                <div class="panel-heading">
                    <div class="row">
                        <div class="col-xs-3">
                            <?= FAS::i(FAS::_CART_PLUS)->addCssClass('fa-5x') ?>
                        </div>
                        <div class="col-xs-9 text-right">
                            <div class="huge"><?= $taskNew ?></div>
                            <div>New tasks!</div>
                        </div>
                    </div>
                </div>
                <?= viewDetails('View Details1') ?>
            </div>
        </div>
        <div class="col-lg-3 col-md-6">
            <div class="panel panel-<?= Task::getStatusCss()[Task::STATUS_DONE] ?>">
                <div class="panel-heading">
                    <div class="row">
                        <div class="col-xs-3">
                            <?= FAS::i(FAS::_TASKS)->addCssClass('fa-5x') ?>
                        </div>
                        <div class="col-xs-9 text-right">
                            <div class="huge"><?= $taskDone ?></div>
                            <div>Finished Tasks!</div>
                        </div>
                    </div>
                </div>
                <?= viewDetails('View Details1') ?>
            </div>
        </div>
        <div class="col-lg-3 col-md-6">
            <div class="panel panel-<?= Task::getStatusCss()[Task::STATUS_IN_WORK] ?>">
                <div class="panel-heading">
                    <div class="row">
                        <div class="col-xs-3">
                            <?= FAS::i(FAS::_CART_PLUS)->addCssClass('fa-5x') ?>
                        </div>
                        <div class="col-xs-9 text-right">
                            <div class="huge"><?= $taskInWork ?></div>
                            <div>In work tasks!</div>
                        </div>
                    </div>
                </div>
                <?= viewDetails('View Details1') ?>
            </div>
        </div>
        <div class="col-lg-3 col-md-6">
            <div class="panel panel-<?= Task::getStatusCss()[Task::STATUS_WARNING] ?>">
                <div class="panel-heading">
                    <div class="row">
                        <div class="col-xs-3">
                            <?= FAS::i(FAS::_CART_PLUS)->addCssClass('fa-5x') ?>
                        </div>
                        <div class="col-xs-9 text-right">
                            <div class="huge"><?= $taskWarning ?></div>
                            <div>Warning tasks!</div>
                        </div>
                    </div>
                </div>
                <?= viewDetails('View Details1') ?>
            </div>
        </div>
    </div>
    <!-- /.row -->
</div>
