<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration{
    public function up(): void{
        Schema::create('child_leads', function (Blueprint $table) {
            $table->id(); 
            $table->string('name');
            $table->string('phone')->index();
            $table->string('phone_two');
            $table->string('ota_ona');
            $table->string('address')->nullable();
            $table->date('tkun');
            $table->enum('jinsi', ['male', 'female']);
            $table->text('description')->nullable();
            $table->foreignId('created_by')->constrained('users')->onDelete('cascade');
            $table->enum('status',['new','pending','success','cancel'])->default('new');
            $table->foreignId('child_id')->nullable()->constrained('children')->onDelete('cascade');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('child_leads');
    }
};
