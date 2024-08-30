<?php

test('it lists talks', function () {

    $user = \App\Models\User::factory()->create();
    $talks = \App\Models\Talk::factory()->create(['user_id' => $user]);
    $otherTalk = \App\Models\Talk::factory()->create();

    $response = $this
        ->actingAs($user)
        ->get(route('talks.index'));
    $response->assertSee($talks->first()->title)
        ->assertDontSee($otherTalk->title);
});

test('it show detail talk page', function () {
    $talk = \App\Models\Talk::factory()->create();

    $response = $this
        ->actingAs($talk->user)
        ->get(route('talks.show', $talk));
    $response->assertSee($talk->title)
        ->assertSee($talk->length);
});

test('user can not view show detail of other\'stalk page', function () {
    $talk = \App\Models\Talk::factory()->create();

    $response = $this
        ->actingAs($user = \App\Models\User::factory()->create())
        ->get(route('talks.show', $talk));
    $response->assertForbidden()->assertDontSee($talk->title);
});

test('user can create a talk', function () {
    $user = \App\Models\User::factory()->create();

    $response = $this
        ->actingAs($user)
        ->from(route('talks.create'))
        ->post(route('talks.store'), $data = [
            'title' => 'This is test',
            'length' => 22,
            'type' => \App\Enums\TalkType::cases()[0]->value,
            'abstract' => 'test',
            'organizer_notes' => 'test',
        ]);

    \Pest\Laravel\assertDatabaseHas('talks', $data + ['user_id' => $user->id]);
    $response
        ->assertSessionHasNoErrors()
        ->assertRedirect(route('talks.index'));
});

test('user can  update a talk', function () {
    $talk = \App\Models\Talk::factory()->create();
    $response = $this
        ->actingAs($talk->user)
        ->from(route('talks.create'))
        ->patch(route('talks.update', $talk), $data = [
            'title' => 'This is test',
            'length' => 22,
            'type' => \App\Enums\TalkType::cases()[0]->value,
            'abstract' => 'test',
            'organizer_notes' => 'test',
        ]);

    \Pest\Laravel\assertDatabaseHas('talks', $data + ['user_id' => $talk->user->id]);
    $response
        ->assertSessionHasNoErrors()
        ->assertRedirect(route('talks.index'));
});

test('user can not update a other users\'talk', function () {
    $user = \App\Models\User::factory()->create();
    $talk = \App\Models\Talk::factory()->create();
    $response = $this
        ->actingAs($user)
        ->from(route('talks.create'))
        ->patch(route('talks.update', $talk), $data = [
            'title' => 'This is test',
            'length' => 22,
            'type' => \App\Enums\TalkType::cases()[0]->value,
            'abstract' => 'test',
            'organizer_notes' => 'test',
        ]);

    \Pest\Laravel\assertDatabaseMissing('talks', $data + ['user_id' => $user->id]);
    $response
        ->assertSessionHasNoErrors()
        ->assertForbidden();
});
