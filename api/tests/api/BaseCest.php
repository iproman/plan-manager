<?php


namespace api\tests\api;


use api\tests\ApiTester;
use api\tests\fixtures\ProjectFixture;
use api\tests\fixtures\TaskFixture;

class BaseCest
{
    public function _before(ApiTester $I)
    {
        $I->haveFixtures([
            'task' => [
                'class' => TaskFixture::class,
                'dataFile' => codecept_data_dir() . 'task.php'
            ],
            'project' => [
                'class' => ProjectFixture::class,
                'dataFile' => codecept_data_dir() . 'project.php'
            ]
        ]);
    }
}