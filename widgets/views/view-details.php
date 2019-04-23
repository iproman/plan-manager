<?php

use app\models\service\Statuses;

/** @var $status string */
/** @var $count integer */
/** @var $text string */
/** @var $icon string */
/** @var $link \yii\helpers\Url */
?>

<div class="col-lg-3 col-md-6">
    <div class="panel panel-<?= Statuses::getStatusCss()[$status] ?>">
        <div class="panel-heading">
            <div class="row">
                <div class="col-xs-3">
                    <span class="glyphicon <?= $icon ?> gi-5x" aria-hidden="true">
                    </span>
                </div>
                <div class="col-xs-9 text-right">
                    <div class="huge">
                        <?= $count ?>
                    </div>
                    <div>
                        <?= $text ?>
                    </div>
                </div>
            </div>
        </div>

        <a href="<?= $link ?>">
            <div class="panel-footer">
                <span class="pull-left">
                    View Details
                </span>
                <span class="glyphicon glyphicon-arrow-right pull-right" aria-hidden="true"></span>
                <div class="clearfix"></div>
            </div>
        </a>
    </div>
</div>

