<?php


namespace api\tests\api;


use api\tests\ApiTester;


class ProjectCest extends BaseCest
{
    public function index(ApiTester $I)
    {
        $I->sendGET('/v1/projects');
        $I->seeResponseCodeIs(200);
        $I->seeResponseContainsJson([
            ['name' => 'First Project'],
            ['name' => 'Second Project'],
            ['name' => 'Third Project'],
        ]);
        $I->seeHttpHeader('X-Pagination-Total-Count', 3);
    }

    public function view(ApiTester $I)
    {
        $I->sendGET('v1/projects/1');
        $I->seeResponseCodeIs(200);
        $I->seeResponseContainsJson([
            'name' => 'First Project',
        ]);
    }

    public function viewNotFound(ApiTester $I)
    {
        $I->sendGET('v1/projects/15');
        $I->seeResponseCodeIs(404);
    }

    public function create(ApiTester $I)
    {
//        $I->amBearerAuthenticated('token-correct');
        $I->sendPOST('v1/projects', [
            'name' => 'New Project',
        ]);
        $I->seeResponseCodeIs(201);
        $I->seeResponseContainsJson([
            'name' => 'New Project',
        ]);
    }

    public function update(ApiTester $I)
    {
//        $I->amBearerAuthenticated('token-correct');
        $I->sendPATCH('v1/projects/1', [
            'name' => 'New Project',
        ]);
        $I->seeResponseCodeIs(200);
        $I->seeResponseContainsJson([
            'id' => 1,
            'name' => 'New Project',
        ]);
    }

    public function delete(ApiTester $I)
    {
//        $I->amBearerAuthenticated('token-correct');
        $I->sendDELETE('v1/projects/1');
        $I->seeResponseCodeIs(204);
    }
}