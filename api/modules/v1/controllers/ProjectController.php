<?php


namespace api\modules\v1\controllers;


use api\modules\v1\controllers\base\BaseController;
use api\modules\v1\models\Project;

/**
 * Class ProjectController
 * @package api\modules\v1\controllers
 */
class ProjectController extends BaseController
{
    /**
     * @var string $modelClass
     */
    public $modelClass = Project::class;
}