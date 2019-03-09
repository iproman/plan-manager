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
use lavrentiev\widgets\toastr\NotificationFlash;

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
    <title><?= Html::encode(Yii::$app->params['project']['name']) ?></title>
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>

<?= NotificationFlash::widget() ?>

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
                'dropDownOptions' => [
                    'class' => 'dropdown-messages',
                ],
                'items' => [
                    ['label' => Html::a(
                        Html::tag(
                            'div',
                            '<p><strong>Task 1</strong>
                                <span class="pull-right text-muted">40% Complete</span></p>'
                            . Html::tag(
                                'div',
                                Html::tag(
                                    'div',
                                    '<span class="sr-only">40% Complete (success)</span>',
                                    [
                                        'class' => 'progress-bar progress-bar-success',
                                        'role' => 'progressbar',
                                        'aria-valuenow' => '40',
                                        'aria-valuemin' => '0',
                                        'aria-valuemax' => '100',
                                        'style' => 'width:40%',
                                    ]
                                ),
                                ['class' => 'progress progress-striped active']
                            )
                        ),
                        Url::to(['/project'])), 'url' => false,
                    ],
                    ['label' => '', 'options' => ['class' => 'divider'], 'url' => false],
                    ['label' => Html::a(
                        Html::tag(
                            'div',
                            '<p><strong>Task 2</strong>
                                <span class="pull-right text-muted">20% Complete</span></p>'
                            . Html::tag(
                                'div',
                                Html::tag(
                                    'div',
                                    '<span class="sr-only">20% Complete (success)</span>',
                                    [
                                        'class' => 'progress-bar progress-bar-info',
                                        'role' => 'progressbar',
                                        'aria-valuenow' => '20',
                                        'aria-valuemin' => '0',
                                        'aria-valuemax' => '100',
                                        'style' => 'width:20%',
                                    ]
                                ),
                                ['class' => 'progress progress-striped active']
                            )
                        ),
                        Url::to(['/project'])), 'url' => false,
                    ],
                    ['label' => '', 'options' => ['class' => 'divider'], 'url' => false],
                    ['label' => Html::a(
                        Html::tag(
                            'div',
                            '<p><strong>Task 3</strong>
                                <span class="pull-right text-muted">60% Complete</span></p>'
                            . Html::tag(
                                'div',
                                Html::tag(
                                    'div',
                                    '<span class="sr-only">60% Complete (success)</span>',
                                    [
                                        'class' => 'progress-bar progress-bar-warning',
                                        'role' => 'progressbar',
                                        'aria-valuenow' => '60',
                                        'aria-valuemin' => '0',
                                        'aria-valuemax' => '100',
                                        'style' => 'width:20%',
                                    ]
                                ),
                                ['class' => 'progress progress-striped active']
                            )
                        ),
                        Url::to(['/project'])), 'url' => false,
                    ],
                    ['label' => '', 'options' => ['class' => 'divider'], 'url' => false],
                    ['label' => Html::a(
                        Html::tag(
                            'div',
                            '<p><strong>Task 4</strong>
                                <span class="pull-right text-muted">80% Complete</span></p>'
                            . Html::tag(
                                'div',
                                Html::tag(
                                    'div',
                                    '<span class="sr-only">80% Complete (success)</span>',
                                    [
                                        'class' => 'progress-bar progress-bar-danger',
                                        'role' => 'progressbar',
                                        'aria-valuenow' => '80',
                                        'aria-valuemin' => '0',
                                        'aria-valuemax' => '100',
                                        'style' => 'width:80%',
                                    ]
                                ),
                                ['class' => 'progress progress-striped active']
                            )
                        ),
                        Url::to(['/project'])), 'url' => false,
                    ],
                    ['label' => '', 'options' => ['class' => 'divider'], 'url' => false],
                    ['label' => Html::a(
                        Html::tag(
                            'strong',
                            'See All Tasks'
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
                'label' => FAS::i(FAS::_BELL),
                'dropDownOptions' => [
                    'class' => 'dropdown-messages',
                ],
                'items' => [
                    ['label' => Html::a(
                        Html::tag(
                            'div',
                            '<i class="fa fa-comment fa-fw"></i> New Comment
                            <span class="pull-right text-muted small">4 minutes ago</span>'
                        ),
                        Url::to(['/project'])), 'url' => false,
                    ],
                    ['label' => '', 'options' => ['class' => 'divider'], 'url' => false],
                    ['label' => Html::a(
                        Html::tag(
                            'div',
                            '<i class="fa fa-twitter fa-fw"></i> 3 New Followers
                            <span class="pull-right text-muted small">12 minutes ago</span>'
                        ),
                        Url::to(['/project'])), 'url' => false,
                    ],
                    ['label' => '', 'options' => ['class' => 'divider'], 'url' => false],
                    ['label' => Html::a(
                        Html::tag(
                            'div',
                            '<i class="fa fa-envelope fa-fw"></i> Message Sent
                            <span class="pull-right text-muted small">4 minutes ago</span>'
                        ),
                        Url::to(['/project'])), 'url' => false,
                    ],
                    ['label' => '', 'options' => ['class' => 'divider'], 'url' => false],
                    ['label' => Html::a(
                        Html::tag(
                            'div',
                            '<i class="fa fa-tasks fa-fw"></i> New Task
                            <span class="pull-right text-muted small">4 minutes ago</span>'
                        ),
                        Url::to(['/project'])), 'url' => false,
                    ],
                    ['label' => '', 'options' => ['class' => 'divider'], 'url' => false],
                    ['label' => Html::a(
                        Html::tag(
                            'div',
                            '<i class="fa fa-upload fa-fw"></i> Server Rebooted
                            <span class="pull-right text-muted small">4 minutes ago</span>'
                        ),
                        Url::to(['/project'])), 'url' => false,
                    ],
                    ['label' => '', 'options' => ['class' => 'divider'], 'url' => false],
                    ['label' => Html::a(
                        Html::tag(
                            'strong',
                            'See All Tasks'
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
                'label' => FAS::i(FAS::_USER),
                'dropDownOptions' => [
                    'class' => 'dropdown-user in',
                ],
                'items' => [
                    ['label' => Html::a(
                        Html::tag(
                            'div',
                            '<i class="fa fa-user fa-fw"></i> User Profile'
                        ),
                        Url::to(['/project'])), 'url' => false,
                    ],
                    ['label' => Html::a(
                        Html::tag(
                            'div',
                            'Settings'
                        ),
                        Url::to(['/project'])), 'url' => false,
                    ],
                    ['label' => '', 'options' => ['class' => 'divider'], 'url' => false],
                    ['label' => Html::a(
                        '<i class="fa fa-sign-out fa-fw"></i> Logout',
                        Url::to(['/project'])
                    ),
                        'url' => false,
                    ],
                ],
            ]
        ]
    ]);
    NavBar::end();
    ?>


    <?= $this->render('_left-nav.php') ?>

    <div id="page-wrapper">
        <?= Breadcrumbs::widget([
            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
        ]) ?>
        <?= Alert::widget() ?>
        <?= $content ?>
    </div>
</div>

<footer class="footer">
    <div class="container">
        <p class="pull-left">&copy; <?= Yii::$app->params['project']['name']?> <?= date('Y') ?></p>

        <p class="pull-right"><?= Yii::powered() ?></p>
    </div>
</footer>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
