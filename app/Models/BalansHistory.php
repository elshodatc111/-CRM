<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class BalansHistory extends Model{

    use HasFactory;

    protected $fillable = [
        'type',
        'status',
        'amount',
        'amount_type',
        'description',
        'admin_id',
    ];

    protected $casts = [
        'amount'     => 'decimal:2',
    ];

    public function admin(): BelongsTo{
        return $this->belongsTo(User::class, 'admin_id');
    }
    
}
