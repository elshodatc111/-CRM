<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration{
    
    public function up(): void{
        Schema::create('user_davomads', function (Blueprint $table) {
            $table->id();
            $table->foreignId('group_id')->constrained('groups')->onDelete('cascade');
            $table->enum('status',['keldi','keldi_formasiz','kechikdi_formasiz','kechikdi_sababli','kechikdi_sababsiz','kelmadi','kelmadi_sababli'])->default('kelmadi');
            $table->date('data');
            $table->string('description')->nullable();
            $table->boolean('is_active')->default(true);
            $table->foreignId('admin_id')->nullable()->constrained('users')->onDelete('cascade');
            $table->timestamps();
        });
    }
    
    public function down(): void{
        Schema::dropIfExists('user_davomads');
    }

};
