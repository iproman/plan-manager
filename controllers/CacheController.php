<?php

namespace app\controllers;

use Yii;

/**
 * Class CacheController
 * @package app\controllers
 */
class CacheController extends BaseController
{

    /**
     * @param null $returnUrl
     * @return mixed
     */
    public function actionFlush($returnUrl = null)
    {

        if (Yii::$app->getCache()->flush()) {
            Yii::$app->getSession()->setFlash(
                'success',
                'Cache successfully flushed.'
            );
        }

        return $this->redirect($returnUrl !== null ? $returnUrl : ['index']);
    }
}