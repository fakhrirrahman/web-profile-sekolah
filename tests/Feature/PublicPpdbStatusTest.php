<?php

use App\Models\PpdbRegistration;

test('public ppdb status lookup does not expose private registration data', function () {
    $registration = PpdbRegistration::create([
        'registration_number' => 'PPDB-2026-7777',
        'student_name' => 'Nadia Putri',
        'birth_place' => 'Bandung',
        'birth_date' => '2018-01-20',
        'gender' => 'Perempuan',
        'desired_grade' => 'SD Kelas 1',
        'previous_school' => 'TK Ceria',
        'parent_name' => 'Sari Putri',
        'phone' => '08123456789',
        'email' => 'sari@example.test',
        'address' => 'Komplek Privat Anggrek 77',
        'notes' => 'Butuh jadwal pagi',
        'status' => 'baru',
    ]);

    $this->get(route('ppdb.status', [
        'registration_number' => $registration->registration_number,
    ]))
        ->assertOk()
        ->assertSee('Nadia Putri')
        ->assertSee('SD Kelas 1')
        ->assertSee('Baru')
        ->assertDontSee('Sari Putri')
        ->assertDontSee('08123456789')
        ->assertDontSee('sari@example.test')
        ->assertDontSee('Komplek Privat Anggrek 77')
        ->assertDontSee('Bandung')
        ->assertDontSee('TK Ceria')
        ->assertDontSee('Butuh jadwal pagi')
        ->assertDontSee('Data pendaftaran');
});

test('public ppdb status dropdown only shows non-private lookup data', function () {
    PpdbRegistration::create([
        'registration_number' => 'PPDB-2026-8888',
        'student_name' => 'Raka Mahendra',
        'birth_place' => 'Jakarta',
        'birth_date' => '2017-05-10',
        'gender' => 'Laki-laki',
        'desired_grade' => 'SD Kelas 2',
        'previous_school' => 'TK Mentari',
        'parent_name' => 'Dimas Mahendra',
        'phone' => '087700001111',
        'email' => 'dimas@example.test',
        'address' => 'Jl. Sekolah No. 2',
        'notes' => null,
        'status' => 'dihubungi',
    ]);

    $this->get(route('ppdb.status'))
        ->assertOk()
        ->assertSee('PPDB-2026-8888')
        ->assertSee('Raka Mahendra')
        ->assertSee('SD Kelas 2')
        ->assertDontSee('087700001111')
        ->assertDontSee('Dimas Mahendra')
        ->assertDontSee('dimas@example.test')
        ->assertDontSee('Jl. Sekolah No. 2');
});
