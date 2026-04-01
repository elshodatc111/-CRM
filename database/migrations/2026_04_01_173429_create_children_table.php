<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration{

    public function up(): void{
        Schema::create('children', function (Blueprint $table) {
            $table->id(); 
            $table->string('name'); // F.I.O
            $table->string('phone')->index(); // Asosiy telefon
            $table->string('phone_two'); // Ikkinchi raqam (majburiy emas)
            $table->string('ota_ona'); // Ota-onasining ismi
            $table->string('address')->nullable();
            $table->string('guvohnoma')->unique()->nullable(); 
            $table->date('tkun'); // Tug'ilgan sana
            $table->decimal('balans', 15, 2)->default(0);
            $table->timestamp('month_pay')->nullable(); // Oxirgi oylik to'lov sanasi
            $table->enum('jinsi', ['male', 'female']);
            $table->text('description')->nullable();
            $table->foreignId('created_by')->constrained('users')->onDelete('cascade');
            $table->boolean('is_active')->default(true);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('children');
    }
};
