<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration{

    public function up(): void{
        Schema::create('group_payments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('child_id')->constrained('children')->onDelete('cascade');
            $table->foreignId('group_id')->constrained('groups')->onDelete('cascade');
            $table->timestamp('month_pay');
            $table->string('desctiption');
            $table->decimal('balans_start',10,2);
            $table->decimal('payment',10,2);
            $table->decimal('balans_end',10,2);
            $table->timestamps();
        });
    }
    
    public function down(): void{
        Schema::dropIfExists('group_payments');
    }
};
