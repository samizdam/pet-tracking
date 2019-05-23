<?php namespace api\v1\activity;


use ApiTester;

class CollectionCest
{
    public function _before(ApiTester $I)
    {
    }

    // tests
    public function postDublicateTest(ApiTester $I)
    {
        $I->haveHttpHeader('Authorization', 'foo');
        $requestData = [
            'deviceState' => 1,
            'timestamp' => time(),
            'activityType' => 1,
            'numberOfSteps' => 5,
        ];
        $I->sendPOST('/activity/', $requestData);
        $I->seeResponseCodeIs(201);

        $I->sendPOST('/activity/', $requestData);
        $I->seeResponseCodeIs(409);
    }
}
