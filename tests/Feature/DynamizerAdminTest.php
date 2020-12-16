<?php

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);
beforeEach(fn () => User::factory()->create());

uses()->group('dynamizer');

test('C - Admin can add a new dynamizer', function () {
    $this->withoutMiddleware();

    $this->post(route('dynamizers.store'), [
        'name' => 'Jonnhy Mnemonic',
        'email' => 'jonnhy@example.net',
        'phone1' => '555-6527685',
        'password' => 'secret',
    ]);

    // First one created on beforeEach
    $this->assertCount(2, User::all());
});

test('R - Admin can read/edit a dynamizer', function () {
    $this->seed(AdminsTableSeeder::class);
    $this->seed(UsersTableSeeder::class);

    $admin = App\Models\Admin::first();
    $user = User::first();

    // $response = $this->get(route('dynamizers.edit', $user->id))->dump();
    $this->actingAs($admin, 'admin')
        ->get(url('admon/dynamizers').'/'.$user->id.'/edit')
        ->assertStatus(200)
        ->assertSee($user->name);
});

test('U - Admin can update a dynamizer', function () {
    $this->withoutMiddleware();
    $user = User::first();
    $user->name = 'Neo';

    $this->assertCount(1, User::all());
    $this->patch(route('dynamizers.update', $user->id), $user->toArray());
    $this->assertEquals('Neo', User::findOrFail($user->id)->name);
});

test('D - Admin can delete a dynamizer', function () {
    $this->withoutMiddleware();
    $user = User::first();

    $this->assertCount(1, User::all());

    $this->delete(route('dynamizers.destroy', $user->id));
    $this->assertCount(0, User::all());
});
