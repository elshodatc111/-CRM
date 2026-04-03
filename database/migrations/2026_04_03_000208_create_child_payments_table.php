<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration{

    public function up(): void{
        Schema::create('child_payments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('child_id')->constrained('children')->onDelete('cascade');
            $table->enum('type',['payment','return','discount']);
            $table->decimal('amount', 10,2);
            $table->enum('amount_type',['cash','card','bank']);
            $table->string('description');
            $table->enum('status',['pending','success','cancel'])->default('pending');
            $table->foreignId('admin_id')->constrained('users')->onDelete('cascade');
            $table->timestamps();
        });
    }
    
    public function down(): void{
        Schema::dropIfExists('child_payments');
    }
};
