<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class KassaHistory extends Model{
    use HasFactory;

    protected $fillable = [
        'type',
        'amount',
        'amount_type',
        'status',
        'start_data',
        'start_admin',
        'start_comment',
        'end_data',
        'end_admin',
        'child_payment_id',
    ];

    protected $casts = [
        'amount'     => 'decimal:2',
        'start_data' => 'date',
        'end_data'   => 'date',
    ];

    public function startAdmin(): BelongsTo{
        return $this->belongsTo(User::class, 'start_admin');
    }

    public function endAdmin(): BelongsTo{
        return $this->belongsTo(User::class, 'end_admin');
    }

    public function childPayment(): BelongsTo{
        return $this->belongsTo(ChildPayment::class, 'child_payment_id');
    }
}
