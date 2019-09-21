<?php


namespace api\modules\v1\controllers\base;


use yii\rest\ActiveController;

abstract class BaseController extends ActiveController
{

    use BehaviourTrait;

    /**
     * @param \yii\base\Action $action
     * @return bool
     * @throws \yii\web\BadRequestHttpException
     */
    public function beforeAction($action)
    {
        $this->enableCsrfValidation = false;

        return parent::beforeAction($action);
    }
}