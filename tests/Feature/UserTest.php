<?php

test('User exists', function () {
    $this->seed(UsersTableSeeder::class)
        ->assertDatabaseHas('users', [
            'email' => 'ulysess@gmail.com',
        ]);
});

test('Users can sign in', function() {
    $this->get('/login')
        ->assertSee('Autenticarse para iniciar sesión');

    $credentials = [
        'email' => 'ulysess@gmail.com',
        'password' => config('auth.test_password')
    ];

    $this->post('/login', $credentials)
        ->assertRedirect('/home');
    $this->assertCredentials($credentials);
});

test('Users can see home', function() {
    $user = App\Models\User::first();

    $this->actingAs($user)
        ->get(route('home.index'))
        ->assertSee('¡Bienvenid@!');
});
