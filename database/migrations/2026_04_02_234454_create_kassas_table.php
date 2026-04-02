<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration{
    public function up(): void{
        Schema::create('kassas', function (Blueprint $table) {
            $table->id();
            $table->decimal('cash',12,2)->default(0);
            $table->decimal('pending_card',12,2)->default(0); // Tasdiqlanmagan karta to'lov
            $table->decimal('pending_bank',12,2)->default(0); // Tasdiqlanmagan bank orqali to'lov
            $table->decimal('out_cash_pending',12,2)->default(0); // Kassadan naqt chiqim tasdiqlanmagan
            $table->decimal('cost_cash_pending',12,2)->default(0); // Kassadan tasdiqlanmagan xarajat
            $table->timestamps();
        });
    }
    
    public function down(): void{
        Schema::dropIfExists('kassas');
    }
};
