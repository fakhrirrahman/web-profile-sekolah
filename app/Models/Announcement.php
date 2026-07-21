<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Attributes\Table;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

#[Fillable(['title', 'slug', 'date', 'copy', 'category', 'content_type', 'pdf_path', 'is_active'])]
#[Table('announcements')]
class Announcement extends Model
{
    use HasFactory;

    protected $casts = [
        'is_active' => 'boolean',
    ];

    protected static function boot()
    {
        parent::boot();

        static::saving(function ($announcement) {
            if (empty($announcement->slug)) {
                $announcement->slug = Str::slug($announcement->title);
            }
        });
    }

    public function getIsPdfAttribute(): bool
    {
        return $this->content_type === 'pdf' && filled($this->pdf_path);
    }

    public function getPdfUrlAttribute(): ?string
    {
        if (! $this->pdf_path) {
            return null;
        }

        return Storage::disk('public')->url($this->pdf_path);
    }
}
