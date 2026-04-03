<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration{

    public function up(): void{
        Schema::create('balans', function (Blueprint $table) {
            $table->id();
            $table->decimal('cash',12,2)->default(0);
            $table->decimal('card',12,2)->default(0);
            $table->decimal('bank',12,2)->default(0);
            $table->decimal('sub',12,2)->default(0);
            $table->timestamps();
        });
    }
    
    public function down(): void{
        Schema::dropIfExists('balans');
    }
};
