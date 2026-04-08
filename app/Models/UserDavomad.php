<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class UserDavomad extends Model{ 

    use HasFactory;

    protected $table = 'user_davomads';

    protected $fillable = [
        'user_id',
        'status',
        'data',
        'description',
        'is_active',
        'admin_id',
    ];

    protected $casts = [
        'data'      => 'date',  
        'is_active' => 'boolean',
        'status'    => 'string',
    ];

    public function user(): BelongsTo{
        return $this->belongsTo(User::class, 'user_id');
    }

    public function admin(): BelongsTo{
        return $this->belongsTo(User::class, 'admin_id');
    }

}
