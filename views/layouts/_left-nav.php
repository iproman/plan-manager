<?php

use yii\widgets\Menu;
use rmrevin\yii\fontawesome\FAS;
use yii\helpers\Html;

echo Html::tag(
    'div',
    Html::tag(
        'div',
        Menu::widget([
            'items' => [
                [
                    'label' => FAS::i(FAS::_HOME) . ' ' . 'Главная',
                    'url' => ['/'],
                ],
                [
                    'label' => FAS::i(FAS::_PROJECT_DIAGRAM) . ' ' . 'Проекты',
                    'url' => ['project/']
                ],
                [
                    'label' => FAS::i(FAS::_TASKS) . ' ' . 'Задачи',
                    'url' => ['task/']
                ],
            ],
            'options' => [
                'class' => 'nav',
                'id' => 'side-menu'
            ],
            'encodeLabels' => false,
        ]),
        [
            'class' => 'sidebar-nav navbar-collapse'
        ]
    ),
    [
        'class' => 'navbar-default sidebar',
        'role' => 'navigagion',
    ]
);