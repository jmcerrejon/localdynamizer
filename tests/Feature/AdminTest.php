<?php

it('has admin login page', function () {
    $response = $this->get('/admon/login');

    $response->assertStatus(200);
});

it('admin@dinamizadorsocial.com exists', function () {
    $this->seed(AdminsTableSeeder::class)
        ->assertDatabaseHas('admins', [
            'email' => 'admin@dinamizadorsocial.com',
        ]);
});

it('admin can sign in', function () {
    $this->get('/admon/login')
    ->assertSee('Panel administrador');

    $credentials = [
        'email' => 'admin@dinamizadorsocial.com',
        'password' => config('auth.test_password')
    ];

    $this->post(route('admin.login'), $credentials)
        ->assertRedirect(route('admin.home'));
    $this->assertCredentials($credentials, 'admin');
});
