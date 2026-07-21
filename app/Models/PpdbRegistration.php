<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Attributes\Table;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

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
        'lolos_berkas' => 'Lolos Berkas',
        'tidak_lolos_berkas' => 'Tidak Lolos Berkas',
        'tes_akademik' => 'Tes Akademik',
        'wawancara' => 'Wawancara',
        'diterima' => 'Diterima',
        'ditolak' => 'Ditolak',
    ];
    public const STATUS_ORDER = [
        'baru' => 1,
        'dihubungi' => 2,
        'observasi' => 3,
        'lolos_berkas' => 4,
        'tidak_lolos_berkas' => 4,
        'tes_akademik' => 5,
        'wawancara' => 6,
        'diterima' => 7,
        'ditolak' => 7,
    ];

    public const FINAL_STATUSES = [
        'tidak_lolos_berkas',
        'diterima',
        'ditolak',
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

        static::created(function (PpdbRegistration $registration) {
            $registration->recordStatusHistory($registration->status, $registration->created_at);
        });
    }

    public function statusHistories(): HasMany
    {
        return $this->hasMany(PpdbRegistrationStatusHistory::class)->oldest('changed_at')->oldest('id');
    }

    public function recordStatusHistory(string $status, mixed $changedAt = null): void
    {
        $this->statusHistories()->create([
            'status' => $status,
            'changed_at' => $changedAt ?? now(),
        ]);
    }

    public function getStatusLabelAttribute(): string
    {
        return self::STATUSES[$this->status] ?? ucfirst((string) $this->status);
    }
}
