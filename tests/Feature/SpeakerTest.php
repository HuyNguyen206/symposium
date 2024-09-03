<?php

test('can fetch all speakers', function () {
    $user = \App\Models\User::factory()->create();

    $this->getJson('api/speakers')
        ->assertJson(fn (\Illuminate\Testing\Fluent\AssertableJson $json) =>
        $json->has('data', 1)
            ->has('data.0', fn (\Illuminate\Testing\Fluent\AssertableJson $json) =>
            $json->where('id', $user->id)
                ->where('name', $user->name)
                ->where('email', $user->email)
                ->etc()
        )->etc());
});
