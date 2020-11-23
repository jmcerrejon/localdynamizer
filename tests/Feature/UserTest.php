<?php

uses(Illuminate\Foundation\Testing\RefreshDatabase::class);

beforeEach(fn () => App\Models\User::factory()->create());

it('has users', function () {
    $response = $this->assertDatabaseHas('users', [
        'id' => 1,
    ]);
});
