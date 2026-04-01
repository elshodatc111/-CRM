<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Note extends Model{

    use HasFactory;

    protected $table = 'notes';

    protected $fillable = [
        'type',
        'user_id',
        'content',
        'admin_id',
    ];
    public function admin(): BelongsTo{
        return $this->belongsTo(User::class, 'admin_id');
    }
}
