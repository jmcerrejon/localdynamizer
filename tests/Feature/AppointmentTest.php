<?php

uses(Illuminate\Foundation\Testing\RefreshDatabase::class);

test('C - User can add a new appointment', function () {
    $user = App\Models\User::factory()->create();

    $appointment = App\Models\Appointment::factory()->create()->toArray();
    $appointment['_token'] = csrf_token();
    $appointment['start_time'] = Illuminate\Support\Carbon::parse($appointment['start_time'])->format('Y-m-d\TH:i');
    $appointment['finish_time'] = Illuminate\Support\Carbon::parse($appointment['finish_time'])->format('Y-m-d\TH:i');

    $response = $this->actingAs($user)
        ->post(route('appointment.store'), $appointment)
        ->assertRedirect(route('appointment.index'));
});

test('R - User can view calendar page', function () {
    $user = App\Models\User::factory()->create();

    $this->actingAs($user)
        ->get(route('appointment.index'))
        ->assertSee('Calendario');
});

test('U - User can edit an appointment', function () {
    $this->seed(UsersTableSeeder::class);

    $appointment = App\Models\Appointment::factory()->create();
    $user = App\Models\User::whereId($appointment->user_id)->first();

    $appointment->title = 'Title changed!';
    $appointment['start_time'] = Illuminate\Support\Carbon::parse($appointment['start_time'])->format('Y-m-d\TH:i');
    $appointment['finish_time'] = Illuminate\Support\Carbon::parse($appointment['finish_time'])->format('Y-m-d\TH:i');

    $this->actingAs($user)
        ->put(route('appointment.update', [ 'appointment' => $appointment->id ]), $appointment->toArray())
        ->assertRedirect(route('appointment.index'));
});

test('D - User can delete an appointment', function () {
    $this->seed(UsersTableSeeder::class);

    $appointment = App\Models\Appointment::factory()->create();
    $user = App\Models\User::whereId($appointment->user_id)->first();

    $this->actingAs($user)
        ->delete(route('appointment.update', [ 'appointment' => $appointment->id ]))
        ->assertRedirect(route('appointment.index'));
});

