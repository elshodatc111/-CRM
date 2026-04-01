<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class GroupUser extends Model{
    use HasFactory;
    protected $table = 'group_users';
    protected $fillable = [
        'user_id',
        'group_id',
        'start_id',
        'start_data',
        'end_id',
        'end_data',
        'is_active',
    ];
    protected $casts = [
        'start_data' => 'date',
        'end_data'   => 'date',
        'is_active'  => 'boolean',
    ];
    public function user(): BelongsTo{
        return $this->belongsTo(User::class, 'user_id');
    }
    public function group(): BelongsTo{
        return $this->belongsTo(Group::class, 'group_id');
    }
    public function assignedBy(): BelongsTo{
        return $this->belongsTo(User::class, 'start_id');
    }
    public function removedBy(): BelongsTo{
        return $this->belongsTo(User::class, 'end_id');
    }
}
