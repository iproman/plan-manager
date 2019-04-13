<?php

use yii\widgets\Menu;
use yii\helpers\Html;
use yii\bootstrap\Html as HB;

echo Html::tag(
    'div',
    Html::tag(
        'div',
        Menu::widget([
            'items' => [
                [
                    'label' => HB::icon('glyphicon glyphicon-home') . ' ' . 'Home',
                    'url' => ['/'],
                ],
                [
                    'label' => HB::icon('glyphicon glyphicon-blackboard') . ' ' . 'Projects',
                    'url' => ['/project/']
                ],
                [
                    'label' => HB::icon('glyphicon glyphicon-tasks') . ' ' . 'Tasks',
                    'url' => ['/task/']
                ],
                [
                    'label' => HB::icon('glyphicon glyphicon-time') . ' ' . 'Events',
                    'url' => ['/event/']
                ],
                [
                    'label' => HB::icon('glyphicon glyphicon-repeat') . ' ' . 'Backup',
                    'url' => ['/db-manager/']
                ],
                [
                    'label' => HB::icon('glyphicon glyphicon-screenshot') . ' ' . 'Log',
                    'url' => ['/log/']
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