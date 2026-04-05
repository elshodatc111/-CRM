<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class GroupHisobot extends Model{
    use HasFactory;

    protected $table = 'group_hisobots';
    
    protected $fillable = [
        'group_id',
        'title',
        'type',
        'data',
        'is_active',
        'admin_id',
    ];

    protected $casts = [
        'data'      => 'date',     
        'is_active' => 'boolean',  
        'type'      => 'string',
    ];

    public function group(): BelongsTo{
        return $this->belongsTo(Group::class, 'group_id');
    }

    public function admin(): BelongsTo{
        return $this->belongsTo(User::class, 'admin_id');
    }

}
