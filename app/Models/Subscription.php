<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;

class Subscription extends Model
{
    use HasUuids;
    protected $keyType = 'string';
    public $incrementing = false;
    protected $fillable = [
        'user_id',
        'package_id',
        'type',
        'status',
        'price',
        'class_limit',
        'student_limit',
        'started_at',
        'expires_at',
    ];

    protected function casts(): array
    {
        return [
            'price' => 'decimal:2',
            'class_limit' => 'integer',
            'student_limit' => 'integer',
            'started_at' => 'datetime',
            'expires_at' => 'datetime',
        ];
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function package()
    {
        return $this->belongsTo(Package::class);
    }

    public function isActive(): bool
    {
        return $this->status === 'active'
            && (
                is_null($this->expires_at)
                || $this->expires_at->isFuture()
            );
    }

    public function isCustom(): bool
    {
        return $this->type === 'custom';
    }

    public function isPending(): bool
    {
        return $this->status === 'pending';
    }
}
