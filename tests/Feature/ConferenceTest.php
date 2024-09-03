<?php

test('user can favorite conference', function () {
    $conference = \App\Models\Conference::factory()->create();

    $response = $this->actingAs($user = \App\Models\User::factory()->create())->patch(route('favorites', $conference));

    \Pest\Laravel\assertDatabaseHas('favorites', ['user_id' => $user->id, 'conference_id' => $conference->id]);
});

test('user can unfavorite conference', function () {
    $conference = \App\Models\Conference::factory()->create();

    $this->actingAs($user = \App\Models\User::factory()->create())->patch(route('favorites', $conference));
    $this->actingAs($user)->patch(route('favorites', $conference));

    \Pest\Laravel\assertDatabaseMissing('favorites', ['user_id' => $user->id, 'conference_id' => $conference->id]);
});
