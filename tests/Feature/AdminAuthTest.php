<?php

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;

uses(RefreshDatabase::class);

test('guest users are redirected from admin dashboard to login page', function () {
    $this->get('/admin')
        ->assertRedirect('/login');
});

test('users can log in to the admin dashboard and log out again', function () {
    $user = User::factory()->create([
        'email' => 'admin@goldensierra.test',
        'password' => Hash::make('secret-password'),
    ]);

    $this->post('/login', [
        'email' => $user->email,
        'password' => 'secret-password',
    ])->assertRedirect(route('admin.dashboard'));

    $this->assertAuthenticatedAs($user);

    $this->get('/admin')
        ->assertOk()
        ->assertSee('Dashboard')
        ->assertSee($user->name);

    $this->get('/login')
        ->assertRedirect('/dashboard');

    $this->post('/logout')
        ->assertRedirect(route('login'));

    $this->assertGuest();
});
