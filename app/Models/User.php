<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    public const PRIVACY_POLICY_VERSION = '1.0';

    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
        'documento',
        'telefono',
        'privacy_accepted_at',
        'privacy_policy_version',
        'anonymized_at',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'privacy_accepted_at' => 'datetime',
            'anonymized_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function isAdmin(): bool
    {
        return $this->role === 'admin';
    }

    public function loans(): HasMany
    {
        return $this->hasMany(Loan::class);
    }
}
