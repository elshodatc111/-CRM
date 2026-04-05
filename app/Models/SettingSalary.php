<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class SettingSalary extends Model{

    use HasFactory;

    protected $table = 'setting_salaries';

    protected $fillable = [
        'role',
        'child_pay',
        'hisobot',
        'shikoyat',
        'bayramlar',
        'item5', 'item10', 'item15', 'item20', 'item25', 'item30', 
        'item35', 'item40', 'item45', 'item50', 'item55', 'item60', 
        'item65', 'item70', 'item75', 'item80', 'item85', 'item90', 
        'item95', 'item100', 'item105', 'item110', 'item115', 'item120'
    ];

    protected $casts = [
        'child_pay' => 'float',
        'hisobot'   => 'float',
        'shikoyat'  => 'float',
        'bayramlar' => 'float',
        'item5' => 'float',
        'item10' => 'float',
        'item15' => 'float',
        'item20' => 'float',
        'item25' => 'float',
        'item30' => 'float',
        'item35' => 'float',
        'item40' => 'float',
        'item45' => 'float',
        'item50' => 'float',
        'item55' => 'float',
        'item60' => 'float',
        'item65' => 'float',
        'item70' => 'float',
        'item75' => 'float',
        'item80' => 'float',
        'item85' => 'float',
        'item90' => 'float',
        'item95' => 'float',
        'item100' => 'float',
        'item105' => 'float',
        'item110' => 'float',
        'item115' => 'float',
        'item120' => 'float',
    ];
}
