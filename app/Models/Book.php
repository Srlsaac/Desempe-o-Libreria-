<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Facades\Storage;

class Book extends Model
{
    protected $fillable = [
        'category_id',
        'author_id',
        'title',
        'isbn',
        'description',
        'year',
        'copies_total',
        'copies_available',
        'cover_image',
        'active',
    ];

    protected function casts(): array
    {
        return [
            'active' => 'boolean',
        ];
    }

    protected function coverUrl(): Attribute
    {
        return Attribute::get(function () {
            if (! $this->cover_image) {
                return null;
            }

            $disk = Storage::disk();

            return $disk->providesTemporaryUrls()
                ? $disk->temporaryUrl($this->cover_image, now()->addHours(6))
                : $disk->url($this->cover_image);
        });
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function author(): BelongsTo
    {
        return $this->belongsTo(Author::class);
    }

    public function loans(): HasMany
    {
        return $this->hasMany(Loan::class);
    }
}
