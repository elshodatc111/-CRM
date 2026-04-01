<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class UserLead extends Model{
    use HasFactory;

    protected $fillable = [
        'name',
        'phone',
        'phone_two',
        'address',
        'expected_salary',
        'birth_date',
        'passport_seria',
        'role',
        'education',
        'institution_name',
        'last_workplace',
        'manba',
        'maqsadi',
        'about',
        'status',
        'user_id',
        'admin_id',
    ];
    
    protected $casts = [
        'birth_date' => 'date',
        'expected_salary' => 'decimal:2',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    public function user(): BelongsTo{
        return $this->belongsTo(User::class, 'user_id');
    }
    
    public function admin(): BelongsTo{
        return $this->belongsTo(User::class, 'admin_id');
    }
}
