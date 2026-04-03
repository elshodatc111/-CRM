<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class GroupDavomad extends Model{
    use HasFactory;

    protected $fillable = [
        'group_id',
        'child_id',
        'status',
        'date',
    ];

    protected $casts = [
        'date' => 'date',
        'status' => 'string',
    ];
    
    public function group(): BelongsTo{
        return $this->belongsTo(Group::class);
    }

    public function child(): BelongsTo{
        return $this->belongsTo(Child::class);
    }

}
