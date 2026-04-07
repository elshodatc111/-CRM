<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class GroupPayment extends Model{

    use HasFactory;

    protected $fillable = [
        'child_id',
        'group_id',
        'month_pay',
        'desctiption',
        'balans_start',
        'payment',
        'balans_end',
    ];

    protected $casts = [
        'month_pay' => 'datetime',
        'balans_start' => 'decimal:2',
        'payment' => 'decimal:2',
        'balans_end' => 'decimal:2',
    ];
    
    public function child(): BelongsTo{
        return $this->belongsTo(Child::class);
    }

    public function group(): BelongsTo{
        return $this->belongsTo(Group::class);
    }
    
}
