<?php

test('it import or update a conference', function () {
    $command = new \App\Console\Commands\ImportConferencesCommand(new \App\Services\CallingAllPaper);

    $data = [
        'name' => 'This is the name from api',
        '_rel' => ['cfp_uri' => 'v1/cfp/osaf123sad'],
    ];

    $command->updateOrCreateConferences($data);
    \Pest\Laravel\assertDatabaseHas(\App\Models\Conference::class, ['title' => $data['name']]);
    $updatedData = [
        'name' => 'This is the name from api update',
        '_rel' => ['cfp_uri' => 'v1/cfp/osaf123sad'],
    ];

    $command->updateOrCreateConferences($updatedData);

    \Pest\Laravel\assertDatabaseMissing(\App\Models\Conference::class, ['title' => $data['name']]);
    \Pest\Laravel\assertDatabaseHas(\App\Models\Conference::class, ['title' => $updatedData['name']]);
    \Pest\Laravel\assertDatabaseCount(\App\Models\Conference::class, 1);
});

test('it mock the callingAllPaper service', function () {
    $this->instance(
        \App\Services\CallingAllPaper::class,
        Mockery::mock(\App\Services\CallingAllPaper::class, function (\Mockery\MockInterface $mock) {
            $mock->shouldReceive('conferences')->once()->andReturn([
                'cfps' => [
                    [
                        'name' => 'GopherCon Singapore 20245',
                        'uri' => 'https://papercall.io/cfps/6021/submissions/new',
                        'dateCfpStart' => '2024-08-31T05:03:30+00:00',
                        'dateCfpEnd' => '2024-09-02T16:00:00+00:00',
                        'location' => 'Singapore',
                        'latitude' => 0,
                        'longitude' => 0,
                        'description' => '',
                        'dateEventStart' => '2024-11-01T00:00:00+00:00',
                        'dateEventEnd' => '2024-11-01T00:00:00+00:00',
                        'iconUri' => 'https://papercallio-production.s3.amazonaws.com/uploads/event/logo/6715/mid_300_Mergopher_2023_Cutout_Papercall_2.png',
                        'eventUri' => 'https://2024.gophercon.sg',
                        'timezone' => 'UTC',
                        'lastChange' => '2024-08-31T05:03:30+00:00',
                        '_rel' => ['cfp_uri' => 'v1/cfp/osaf123sad'],
                    ],
                ],
                'meta' => [
                    'count' => 1,
                ]]);
        })
    );

    $command = new \App\Console\Commands\ImportConferencesCommand(app(\App\Services\CallingAllPaper::class));
    $command->handle();
    \Pest\Laravel\assertDatabaseHas(\App\Models\Conference::class, ['title' => 'GopherCon Singapore 20245']);

});
