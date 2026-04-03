<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration{

    public function up(): void{
        Schema::create('balans_histories', function (Blueprint $table) {
            $table->id();
            $table->enum('type',['kassaToBalans','kassaCost','balansToKassa','balansOut','balansCost','return','salary','balansToSub','subToBalans']);
            $table->enum('status',['pending','success']);
            $table->decimal('amount', 10,2);
            $table->enum('amount_type',['cash','card','bank','sub']);
            $table->string('description')->nullable();
            $table->foreignId('admin_id')->constrained('users')->onDelete('cascade');
            $table->timestamps();
        });
    }

    public function down(): void{
        Schema::dropIfExists('balans_histories');
    }
};
