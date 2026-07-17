<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Attributes\Table;
use Illuminate\Database\Eloquent\Model;

#[Fillable(['name', 'phone', 'topic', 'message', 'status'])]
#[Table('contact_messages')]
class ContactMessage extends Model
{
    public const STATUSES = [
        'baru' => 'Baru',
        'dibaca' => 'Dibaca',
        'dibalas' => 'Dibalas',
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function (ContactMessage $message) {
            if (blank($message->status)) {
                $message->status = 'baru';
            }
        });
    }

    public function getStatusLabelAttribute(): string
    {
        return self::STATUSES[$this->status] ?? ucfirst((string) $this->status);
    }
}
