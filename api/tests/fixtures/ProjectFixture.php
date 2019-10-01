<?php


namespace api\tests\fixtures;


use api\modules\v1\models\Project;
use api\tests\fixtures\base\BaseFixture;

/**
 * Class ProjectFixture
 * @package api\tests\fixtures
 */
class ProjectFixture extends BaseFixture
{
    /**
     * @var string $modelClass
     */
    public $modelClass = Project::class;
}