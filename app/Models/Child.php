<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Casts\Attribute;

class Child extends Model{

    use HasFactory, SoftDeletes;
    
    protected $fillable = [
        'name',
        'phone',
        'phone_two',
        'ota_ona',
        'address',
        'guvohnoma',
        'tkun',
        'balans',
        'month_pay',
        'jinsi',
        'description',
        'created_by',
        'is_active',
    ];
    
    protected $casts = [
        'tkun' => 'date',
        'month_pay' => 'datetime',
        'balans' => 'decimal:2',
        'is_active' => 'boolean',
    ];
    
    public function creator(): BelongsTo{
        return $this->belongsTo(User::class, 'created_by');
    }
    
    protected function formattedBalans(): Attribute{
        return Attribute::make(
            get: fn () => number_format($this->balans, 0, '.', ' ') . ' UZS',
        );
    }
    
    protected function name(): Attribute{
        return Attribute::make(
            set: fn ($value) => mb_convert_case($value, MB_CASE_TITLE, "UTF-8"),
        );
    }
    
    protected function lastPayMonth(): Attribute{
        return Attribute::make(
            get: fn () => $this->month_pay ? $this->month_pay->format('Y-m') : 'Toʻlov qilinmagan',
        );
    }
    
    public function scopeActive($query){
        return $query->where('is_active', true);
    }
    
}
