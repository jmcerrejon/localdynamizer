<?php

it('see button "Acceso dinamizadores"')
    ->get('/')
    ->assertStatus(200)
    ->assertSee('Acceso dinamizadores');

