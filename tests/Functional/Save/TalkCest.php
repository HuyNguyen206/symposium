<?php


namespace Tests\Functional\Save;

use App\Enums\TalkType;
use App\Models\Talk;
use App\Models\User;
use Tests\Support\FunctionalTester;

class TalkCest
{
    public function _before(FunctionalTester $I)
    {
    }

    // tests
    public function saveTalk(FunctionalTester $I)
    {
        $I->amActingAs(User::factory()->create());
        $data = $I->getRequest()->_request('POST', route('talks.store'),
            $postData = [
                'title' => 'this is huy',
                'length' => 20,
                'type' => TalkType::LIGHTING->value
            ]
        );

        $I->seeRecord('talks', $postData);
    }
}
