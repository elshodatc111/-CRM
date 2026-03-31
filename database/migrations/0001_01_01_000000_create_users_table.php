<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->enum('role', [
                'superadmin', 'direktor', 'admin', 'teacher', 
                'oshpaz', 'farrosh', 'tarbiyachi', 'yordamchi', 'xodim'
            ])->default('xodim');
            $table->enum('status', ['true', 'false', 'delete'])->default('true');            
            $table->string('name');
            $table->string('phone')->unique(); 
            $table->string('phone_two')->nullable();
            $table->string('addres')->nullable();
            $table->decimal('salary', 12, 2)->default(0);
            $table->date('tkun'); // Tug'ilgan kun
            $table->string('pasport')->nullable();
            $table->text('about')->nullable();
            $table->string('password'); // Login uchun parol
            $table->rememberToken();
            $table->softDeletes();
            $table->timestamps();
        });
        
        Schema::create('password_reset_tokens', function (Blueprint $table) {
            $table->string('phone')->primary(); // email o'rniga phone
            $table->string('token');
            $table->timestamp('created_at')->nullable();
        });

        // 3. Sessiyalar jadvali
        Schema::create('sessions', function (Blueprint $table) {
            $table->string('id')->primary();
            $table->foreignId('user_id')->nullable()->index()->constrained('users')->onDelete('cascade');
            $table->string('ip_address', 45)->nullable();
            $table->text('user_agent')->nullable();
            $table->longText('payload');
            $table->integer('last_activity')->index();
        });
    }

    public function down(): void {
        Schema::dropIfExists('sessions');
        Schema::dropIfExists('password_reset_tokens');
        Schema::dropIfExists('users');
    }
};