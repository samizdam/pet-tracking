<?php

namespace api\v1\tracks;

use ApiTester;

class CollectionCest
{
    public function _before(ApiTester $I)
    {
    }

    // tests
    public function checkAutorizedHeaderTest(ApiTester $I)
    {
    	$I->haveHttpHeader('Authorization','foo');
    	$trackData = [
            'timestamp' => time() + 10,
            'deviceState' => 1,
            'lon' => 41.12,
            'lat' => 36.6,
            'height' => 11,
            'accuracy' => 10
        ];
    	$I->sendPost('/tracks/', $trackData);
    	$I->seeResponseCodeIs(201);

		$I->deleteHeader('Authorization');
		$I->sendPOST('/tracks/', $trackData);
		$I->seeResponseCodeIs(401);
    }


}
