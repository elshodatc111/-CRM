<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Balans extends Model{
    protected $table = 'balans';
    
    protected $fillable = [
        'cash',
        'card',
        'bank',
        'sub',
    ];
    
    public static function getInstance(){
        return self::firstOrCreate(
            ['id' => 1],
            [
                'cash' => 0,
                'card' => 0,
                'bank' => 0,
                'sub' => 0,
            ]
        );
    }
}
