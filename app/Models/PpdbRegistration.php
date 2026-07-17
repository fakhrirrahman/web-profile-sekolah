<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Attributes\Table;
use Illuminate\Database\Eloquent\Model;

#[Fillable([
    'registration_number',
    'student_name',
    'birth_place',
    'birth_date',
    'gender',
    'desired_grade',
    'previous_school',
    'parent_name',
    'phone',
    'email',
    'address',
    'notes',
    'status',
])]
#[Table('ppdb_registrations')]
class PpdbRegistration extends Model
{
    public const STATUSES = [
        'baru' => 'Baru',
        'dihubungi' => 'Dihubungi',
        'observasi' => 'Observasi',
        'diterima' => 'Diterima',
        'ditolak' => 'Ditolak',
    ];

    protected $casts = [
        'birth_date' => 'date',
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function (PpdbRegistration $registration) {
            if (blank($registration->registration_number)) {
                $nextNumber = str_pad((string) ((self::query()->max('id') ?? 0) + 1), 4, '0', STR_PAD_LEFT);
                $registration->registration_number = 'PPDB-' . now()->format('Y') . '-' . $nextNumber;
            }

            if (blank($registration->status)) {
                $registration->status = 'baru';
            }
        });
    }

    public function getStatusLabelAttribute(): string
    {
        return self::STATUSES[$this->status] ?? ucfirst((string) $this->status);
    }
}
