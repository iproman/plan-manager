<?php


namespace api\modules\v1\controllers;


use api\modules\v1\controllers\base\BaseController;

class TaskController extends BaseController
{
    /**
     * @var string $modelClass
     */
    public $modelClass = 'api\modules\v1\models\Task';
}