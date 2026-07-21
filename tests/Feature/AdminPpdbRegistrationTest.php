<?php

use App\Models\PpdbRegistration;
use App\Models\User;

function createPpdbRegistration(array $overrides = []): PpdbRegistration
{
    return PpdbRegistration::create(array_merge([
        'registration_number' => 'PPDB-2026-' . fake()->unique()->numerify('####'),
        'student_name' => fake()->name(),
        'birth_place' => 'Bandung',
        'birth_date' => '2018-01-20',
        'gender' => 'Perempuan',
        'desired_grade' => 'SD Kelas 1',
        'previous_school' => 'TK Ceria',
        'parent_name' => fake()->name(),
        'phone' => '08123456789',
        'email' => fake()->safeEmail(),
        'address' => 'Jl. Pendidikan No. 1',
        'notes' => null,
        'status' => 'baru',
    ], $overrides));
}

test('admin can filter ppdb registrations', function () {
    $user = User::factory()->create();

    createPpdbRegistration([
        'registration_number' => 'PPDB-2026-9001',
        'student_name' => 'Ana Putri',
        'desired_grade' => 'SD Kelas 1',
        'status' => 'baru',
    ]);

    createPpdbRegistration([
        'registration_number' => 'PPDB-2026-9002',
        'student_name' => 'Budi Santoso',
        'desired_grade' => 'SD Kelas 2',
        'status' => 'diterima',
    ]);

    $this->actingAs($user)
        ->get(route('admin.ppdb-registrations.index', [
            'search' => 'Ana',
            'status' => 'baru',
            'grade' => 'SD Kelas 1',
        ]))
        ->assertOk()
        ->assertSee('Ana Putri')
        ->assertDontSee('Budi Santoso');
});

test('admin can export filtered ppdb registrations to pdf', function () {
    $user = User::factory()->create();

    createPpdbRegistration([
        'student_name' => 'Ana Putri',
        'desired_grade' => 'SD Kelas 1',
        'status' => 'baru',
    ]);

    $response = $this->actingAs($user)
        ->get(route('admin.ppdb-registrations.pdf', [
            'search' => 'Ana',
            'status' => 'baru',
            'grade' => 'SD Kelas 1',
        ]));

    $response
        ->assertOk()
        ->assertHeader('content-type', 'application/pdf');

    expect($response->headers->get('content-disposition'))->toContain('data-ppdb-');
});

test('admin status updates are stored as registration history', function () {
    $user = User::factory()->create();
    $registration = createPpdbRegistration([
        'status' => 'baru',
    ]);

    $this->actingAs($user)
        ->put(route('admin.ppdb-registrations.update', $registration), [
            'status' => 'observasi',
        ])
        ->assertRedirect(route('admin.ppdb-registrations.index'));

    expect($registration->fresh()->status)->toBe('observasi');
    expect($registration->fresh()->statusHistories()->pluck('status')->all())->toBe([
        'baru',
        'observasi',
    ]);
});
