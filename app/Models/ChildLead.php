<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Casts\Attribute;

class ChildLead extends Model{

    use HasFactory, SoftDeletes;
    protected $fillable = [
        'name',
        'phone',
        'phone_two',
        'ota_ona',
        'address',
        'tkun',
        'jinsi',
        'description',
        'created_by',
        'status',
        'child_id',
    ];

    protected $casts = [
        'tkun' => 'date',
        'status' => 'string',
        'created_at' => 'datetime',
    ];

    public function creator(): BelongsTo{
        return $this->belongsTo(User::class, 'created_by');
    }
    
    public function child(): BelongsTo{
        return $this->belongsTo(Child::class, 'child_id');
    }
    
    protected function statusColor(): Attribute{
        return Attribute::make(
            get: fn () => match($this->status) {
                'new'     => 'bg-primary',
                'pending' => 'bg-warning text-dark',
                'success' => 'bg-success',
                'cancel'  => 'bg-danger',
                default   => 'bg-secondary',
            },
        );
    }
    
    protected function name(): Attribute{
        return Attribute::make(
            set: fn ($value) => mb_convert_case($value, MB_CASE_TITLE, "UTF-8"),
        );
    }
    
    public function scopeNew($query){
        return $query->where('status', 'new');
    }
    
    public function scopePending($query){
        return $query->where('status', 'pending');
    }
}
