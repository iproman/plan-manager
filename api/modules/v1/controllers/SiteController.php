<?php


namespace api\modules\v1\controllers;


use api\modules\v1\controllers\base\BehaviourTrait;
use yii\rest\Controller;

/**
 * Class SiteController
 * @package api\modules\v1\controllers
 */
class SiteController extends Controller
{

    use BehaviourTrait;

    /**
     * @return string
     */
    public function actionIndex()
    {
        return 'api';
    }
}