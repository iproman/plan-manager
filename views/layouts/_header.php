<?php
    use yii\bootstrap\NavBar;
    use yii\bootstrap\Nav;
    use yii\helpers\Html;
    use yii\helpers\Url;
?>
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
            'label' => '<span class="glyphicon glyphicon-envelope" aria-hidden="true"></span>',
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
                    ) . ' ' . '<span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>',
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
            'label' => '<span class="glyphicon glyphicon-calendar" aria-hidden="true"></span>',
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
                    ) . ' ' . '<span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>',
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
            'label' => '<span class="glyphicon glyphicon-bell" aria-hidden="true"></span>',
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
                    ) . ' ' . '<span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>',
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
            'label' => '<span class="glyphicon glyphicon-user" aria-hidden="true"></span>',
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