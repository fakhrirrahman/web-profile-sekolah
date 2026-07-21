<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Attributes\Table;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

#[Fillable([
    'ppdb_registration_id',
    'status',
    'changed_at',
])]
#[Table('ppdb_registration_status_histories')]
class PpdbRegistrationStatusHistory extends Model
{
    protected $casts = [
        'changed_at' => 'datetime',
    ];

    public function registration(): BelongsTo
    {
        return $this->belongsTo(PpdbRegistration::class, 'ppdb_registration_id');
    }

    public function getStatusLabelAttribute(): string
    {
        return PpdbRegistration::STATUSES[$this->status] ?? ucfirst((string) $this->status);
    }
}
