<?php

namespace api\tests\api;

use api\modules\v1\fixtures\TaskFixture;
use \api\tests\ApiTester;

/**
 * Class TaskCest
 * @package api\tests\api
 */
class TaskCest
{
    public function _before(ApiTester $I)
    {
        $I->haveFixtures([
            'task' => [
                'class' => TaskFixture::class,
                'dataFile' => codecept_data_dir() . 'task.php'
            ],
        ]);
    }

    public function index(ApiTester $I)
    {
        $I->sendGET('/v1/tasks');
        $I->seeResponseCodeIs(200);
        $I->seeResponseContainsJson([
            ['name' => 'First Task'],
            ['name' => 'Second Task'],
            ['name' => 'Third Task'],
        ]);
        $I->seeHttpHeader('X-Pagination-Total-Count', 3);
    }

    public function view(ApiTester $I)
    {
        $I->sendGET('v1/tasks/1');
        $I->seeResponseCodeIs(200);
        $I->seeResponseContainsJson([
            'name' => 'First Task',
        ]);
    }

    public function viewNotFound(ApiTester $I)
    {
        $I->sendGET('v1/tasks/15');
        $I->seeResponseCodeIs(404);
    }

    public function create(ApiTester $I)
    {
//        $I->amBearerAuthenticated('token-correct');
        $I->sendPOST('v1/tasks', [
            'name' => 'New Task',
            'project_id' => 1,
        ]);
        $I->seeResponseCodeIs(201);
        $I->seeResponseContainsJson([
            'name' => 'New Task',
            'project_id' => 1,
        ]);
    }

    public function update(ApiTester $I)
    {
//        $I->amBearerAuthenticated('token-correct');
        $I->sendPATCH('v1/tasks/1', [
            'name' => 'New Task',
            'project_id' => 1,
        ]);
        $I->seeResponseCodeIs(200);
        $I->seeResponseContainsJson([
            'id' => 1,
            'name' => 'New Task',
            'project_id' => 1,
        ]);
    }

    public function delete(ApiTester $I)
    {
//        $I->amBearerAuthenticated('token-correct');
        $I->sendDELETE('v1/tasks/1');
        $I->seeResponseCodeIs(204);
    }

}