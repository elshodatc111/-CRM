<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ChildPayment extends Model{
    use HasFactory;
    protected $fillable = [
        'child_id',
        'type',
        'amount',
        'amount_type',
        'description',
        'status',
        'admin_id',
    ];
    protected $casts = [
        'amount' => 'decimal:2',
        'created_at' => 'datetime',
    ];
    public function child(): BelongsTo{
        return $this->belongsTo(Child::class, 'child_id');
    }
    public function admin(): BelongsTo{
        return $this->belongsTo(User::class, 'admin_id');
    }
}
