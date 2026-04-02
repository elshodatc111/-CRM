<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Kassa extends Model{
    
    protected $table = 'kassas';
    protected $fillable = [
        'cash',
        'pending_card',
        'pending_bank',
        'out_cash_pending',
        'cost_cash_pending',
    ];
    
    public static function getInstance(){
        return self::firstOrCreate(
            ['id' => 1],
            [
                'cash' => 0,
                'pending_card' => 0,
                'pending_bank' => 0,
                'out_cash_pending' => 0,
                'cost_cash_pending' => 0,
            ]
        );
    }
}
