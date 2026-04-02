<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration{

    public function up(): void{
        Schema::create('kassa_histories', function (Blueprint $table) {
            $table->id();
            $table->enum('type',['out','cost','payment']);
            $table->decimal('amount', 10,2);
            $table->enum('amount_type',['cash','card','bank']);
            $table->enum('status',['pending','success'])->default('pending');
            $table->date('start_data');
            $table->foreignId('start_admin')->constrained('users')->onDelete('cascade');
            $table->string('start_comment');
            $table->date('end_data')->nullable();
            $table->foreignId('end_admin')->constrained('users')->onDelete('cascade');
            $table->foreignId('child_payment_id')->nullable()->constrained('child_payments')->onDelete('cascade');
            $table->timestamps();
        });
    }
    
    public function down(): void{
        Schema::dropIfExists('kassa_histories');
    }
};
