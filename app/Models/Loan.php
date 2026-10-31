<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Loan extends Model
{
    protected $fillable = [
        'book_id',
        'user_id',
        'status',
        'loan_date',
        'due_date',
        'return_date',
        'notes',
    ];

    protected function casts(): array
    {
        return [
            'loan_date' => 'date',
            'due_date' => 'date',
            'return_date' => 'date',
        ];
    }

    public function book(): BelongsTo
    {
        return $this->belongsTo(Book::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function isOverdue(): bool
    {
        return $this->status === 'active'
            && $this->due_date !== null
            && $this->due_date->lt(today());
    }

    public function statusLabel(): string
    {
        if ($this->isOverdue()) {
            return 'Vencido';
        }

        return match ($this->status) {
            'pending' => 'Pendiente',
            'active' => 'Activo',
            'returned' => 'Devuelto',
            'rejected' => 'Rechazado',
            default => 'Vencido',
        };
    }

    public function statusColor(): string
    {
        if ($this->isOverdue()) {
            return 'danger';
        }

        return match ($this->status) {
            'pending' => 'warning',
            'active' => 'success',
            'returned' => 'secondary',
            'rejected' => 'dark',
            default => 'danger',
        };
    }
}
