<?php

namespace app\app\modules\admin;

use yii\filters\AccessControl;
use yii\web\ErrorHandler;

/**
 * admin module definition class
 */
class Module extends \yii\base\Module
{
    /**
     * {@inheritdoc}
     */
    public $controllerNamespace = 'app\app\modules\admin\controllers';

    /**
     * {@inheritdoc}
     */
    public function init()
    {
        parent::init();

        $this->modules = [
            'db-manager' => [
                'class' => 'bs\dbManager\Module',
                // path to directory for the dumps
                'path' => '@runtime/backups',
                // list of registerd db-components
                'dbList' => ['db'],
//            'as access' => [
//                'class' => 'yii\filters\AccessControl',
//                'rules' => [
//                    [
//                        'allow' => true,
//                        'roles' => ['@'],
//                    ],
//                ],
//            ],
            ],
        ];

        \Yii::configure($this, [
            'components' => [
                'errorHandler' => [
                    'class' => ErrorHandler::className(),
                ]
            ],
        ]);

        /** @var ErrorHandler $handler */
        $handler = $this->get('errorHandler');
        \Yii::$app->set('errorHandler', $handler);
        $handler->register();
    }

    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::class,
                'rules' => [
                    [
                        'allow' => true,
                        'roles' => ['@']
                    ]
                ]
            ],
        ];
    }
}
