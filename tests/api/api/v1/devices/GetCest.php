<?php

namespace api\v1\tracks;

use ApiTester;

class GetCest
{
    public function _before(ApiTester $I)
    {
    }

    // tests
    public function getLastCoordinatesTest(ApiTester $I)
    {
    	$I->haveHttpHeader('Authorization','foo');
        $requestData = [
            'deviceState' => 1,
            'timestamp' => time(),
            'lat' => 1,
            'lon' => 5,
            'height' => 10,
            'accuracy' => 1,
        ];
        $I->sendPOST('/tracks/', $requestData);
        $requestData = [
            'deviceState' => 1,
            'timestamp' => time() + 1,
            'lat' => 2,
            'lon' => 6,
            'height' => 10,
            'accuracy' => 1,
        ];
        $I->sendPOST('/tracks/', $requestData);

        $I->sendGET('/devices/foo');
        $I->seeResponseContainsJson([
            'latest' => [
                'lat' => 2,
                'lon' => 6,
            ],
        ]);
    }


}
