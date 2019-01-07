<?php

/* @var $this \yii\web\View */

/* @var $content string */

use app\widgets\Alert;
use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use app\assets\themes\SBAdmin2Asset;
use rmrevin\yii\fontawesome\FAS;
use yii\widgets\Menu;
use yii\helpers\Url;

$appAsset = SBAdmin2Asset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="apple-touch-icon" sizes="57x57" href="<?=$appAsset->baseUrl?>/img/favicon/apple-icon-57x57.png">
    <link rel="apple-touch-icon" sizes="60x60" href="<?=$appAsset->baseUrl?>/img/favicon/apple-icon-60x60.png">
    <link rel="apple-touch-icon" sizes="72x72" href="<?=$appAsset->baseUrl?>/img/favicon/apple-icon-72x72.png">
    <link rel="apple-touch-icon" sizes="76x76" href="<?=$appAsset->baseUrl?>/img/favicon/apple-icon-76x76.png">
    <link rel="apple-touch-icon" sizes="114x114" href="<?=$appAsset->baseUrl?>/img/favicon/apple-icon-114x114.png">
    <link rel="apple-touch-icon" sizes="120x120" href="<?=$appAsset->baseUrl?>/img/favicon/apple-icon-120x120.png">
    <link rel="apple-touch-icon" sizes="144x144" href="<?=$appAsset->baseUrl?>/img/favicon/apple-icon-144x144.png">
    <link rel="apple-touch-icon" sizes="152x152" href="<?=$appAsset->baseUrl?>/img/favicon/apple-icon-152x152.png">
    <link rel="apple-touch-icon" sizes="180x180" href="<?=$appAsset->baseUrl?>/img/favicon/apple-icon-180x180.png">
    <link rel="icon" type="image/png" sizes="192x192"  href="<?=$appAsset->baseUrl?>/img/favicon/android-icon-192x192.png">
    <link rel="icon" type="image/png" sizes="32x32" href="<?=$appAsset->baseUrl?>/img/favicon/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="96x96" href="<?=$appAsset->baseUrl?>/img/favicon/favicon-96x96.png">
    <link rel="icon" type="image/png" sizes="16x16" href="<?=$appAsset->baseUrl?>/img/favicon/favicon-16x16.png">
    <link rel="manifest" href="<?=$appAsset->baseUrl?>/img/favicon/manifest.json">
    <meta name="msapplication-TileColor" content="#ffffff">
    <meta name="msapplication-TileImage" content="/ms-icon-144x144.png">
    <meta name="theme-color" content="#ffffff">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>

<div id="wrapper">
    <?php NavBar::begin([
        'brandLabel' => Yii::$app->params['project']['name'] . ' ' . Yii::$app->params['project']['version'],
        'brandUrl' => Yii::$app->homeUrl,
        'brandOptions' => [
            'class' => '',
        ],
        'options' => [
            'class' => 'navbar navbar-default navbar-static-top',
            'style' => 'margin:0;',
            'role' => 'navigation',
        ],
        'containerOptions' => [
            'class' => '',
        ],
        'innerContainerOptions' => [
            'class' => '',
        ]
    ]);
    echo Nav::widget([
        'options' => [
            'class' => 'nav navbar-top-links navbar-right',
        ],
        'encodeLabels' => false,
        'items' => [
            [
                'label' => FAS::i(FAS::_ENVELOPE),
                'dropDownOptions' => [
                    'class' => 'dropdown-messages',
                ],
                'items' => [
                    ['label' => Html::a(
                        Html::tag(
                            'div',
                            '<strong>John Smith</strong><span class="pull-right text-muted">
                                            <em>Yesterday</em>
                                        </span>'
                        ) . Html::tag(
                            'div',
                            'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Pellentesque eleifend...'
                        ),
                        Url::to(['/project'])), 'url' => false,
                    ],
                    ['label' => '', 'options' => ['class' => 'divider'], 'url' => false],
                    ['label' => Html::a(
                        Html::tag(
                            'div',
                            '<strong>John Smith</strong><span class="pull-right text-muted">
                                            <em>Yesterday</em>
                                        </span>'
                        ) . Html::tag(
                            'div',
                            'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Pellentesque eleifend...'
                        ),
                        Url::to(['/project'])
                    ),
                        'url' => false,
                    ],
                    ['label' => '', 'options' => ['class' => 'divider'], 'url' => false],
                    ['label' => Html::a(
                        Html::tag(
                            'strong',
                            'Read All Messages'
                        ) . ' ' . FAS::i(FAS::_ANGLE_RIGHT),
                        Url::to(['/project']),
                        [
                            'class' => 'text-center',
                        ]
                    ),
                        'url' => false,
                    ],
                ],
            ],
            [
                'label' => FAS::i(FAS::_TASKS),
                'options' => [
                    'class' => 'dropdown',
                ],
                'items' => [
                    ['label' => FAS::i(FAS::_ENVELOPE), 'url' => ['project/']],
                ],
            ],
            [
                'label' => FAS::i(FAS::_BELL),
                'options' => [
                    'class' => 'dropdown',
                ],
                'items' => [
                    ['label' => FAS::i(FAS::_ENVELOPE), 'url' => ['project/']],
                ],
            ],
            [
                'label' => FAS::i(FAS::_USER),
                'options' => [
                    'class' => 'dropdown',
                ],
                'items' => [
                    [
                        'label' => '<a href="#">
                                <div>
                                    <strong>John Smith</strong>
                                    <span class="pull-right text-muted">
                                            <em>Yesterday</em>
                                        </span>
                                </div>
                                <div>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Pellentesque eleifend...</div>
                            </a>',
                        'url' => ['project/'],
                        'content' => '123'
                    ],
                ],
            ]
        ]
    ]);
    NavBar::end();
    ?>

    <div class="container">
        <?= Breadcrumbs::widget([
            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
        ]) ?>
        <?= Alert::widget() ?>
        <?= $content ?>
    </div>
</div>

<footer class="footer">
    <div class="container">
        <p class="pull-left">&copy; My Company <?= date('Y') ?></p>

        <p class="pull-right"><?= Yii::powered() ?></p>
    </div>
</footer>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
