<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable{

    use HasApiTokens, HasFactory, Notifiable, SoftDeletes;
    
    protected $fillable = [
        'role',
        'status',
        'name',
        'phone',
        'phone_two',
        'addres',
        'salary',
        'tkun',
        'pasport',
        'about',
        'password',
    ];
    
    protected $hidden = [
        'password',
        'remember_token',
    ];
    
    protected $casts = [
        'password' => 'hashed', // Parolni avtomatik hash qilish (Laravel 10+)
        'tkun' => 'date',       // Tug'ilgan kunni Carbon obyektiga o'tkazish
        'salary' => 'decimal:2',
        'deleted_at' => 'datetime',
    ];
    
    public function username(){
        return 'phone';
    }
    
    public function isActive(): bool{
        return $this->status === 'true';
    }
    
    public function isAdmin(): bool{
        return in_array($this->role, ['superadmin', 'admin', 'direktor']);
    }
    
    public function getAgeAttribute(){
        return $this->tkun ? $this->tkun->age : null;
    }
    
}