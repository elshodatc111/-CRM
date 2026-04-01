<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration{
    
    public function up(): void{
        Schema::create('user_leads', function (Blueprint $table) {
            $table->id();
            $table->string('name'); 
            $table->string('phone')->index(); 
            $table->string('phone_two')->nullable();
            $table->text('address')->nullable();
            $table->decimal('expected_salary', 15, 2)->default(0);
            $table->date('birth_date');
            $table->string('passport_seria')->nullable();
            $table->string('role'); 
            $table->string('education')->nullable(); 
            $table->string('institution_name')->nullable(); 
            $table->string('last_workplace')->nullable();
            $table->string('manba')->nullable(); // E'lon manbasi
            $table->text('maqsadi')->nullable(); 
            $table->text('about')->nullable(); 
            $table->enum('status',['new','pending','success','cancel'])->default('new'); 
            $table->foreignId('user_id')->nullable()->constrained('users');
            $table->foreignId('admin_id')->nullable()->constrained('users')->onDelete('set null');
            $table->timestamps();
        });
    }

    public function down(): void{
        Schema::dropIfExists('user_leads');
    }
};
