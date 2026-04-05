<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration{
    
    public function up(): void{
        Schema::create('setting_salaries', function (Blueprint $table) {
            $table->id();
            $table->enum('role',['tarbiyachi','kichik_tarbiyachi','yordamchi','kichik_yordamchi','oshpaz','admin']);
            $table->decimal('new_child',10,2)->default(0);
            $table->decimal('new_lead',10,2)->default(0);
            $table->decimal('child_pay',10,2)->default(0);
            $table->decimal('hisobot',10,2)->default(0);
            $table->decimal('shikoyat',10,2)->default(0);
            $table->decimal('bayramlar',10,2)->default(0); 
            $table->decimal('item5',10,2)->default(0);
            $table->decimal('item10',10,2)->default(0);
            $table->decimal('item15',10,2)->default(0);
            $table->decimal('item20',10,2)->default(0);
            $table->decimal('item25',10,2)->default(0);
            $table->decimal('item30',10,2)->default(0);
            $table->decimal('item35',10,2)->default(0);
            $table->decimal('item40',10,2)->default(0);
            $table->decimal('item45',10,2)->default(0);
            $table->decimal('item50',10,2)->default(0);
            $table->decimal('item55',10,2)->default(0);
            $table->decimal('item60',10,2)->default(0);
            $table->decimal('item65',10,2)->default(0);
            $table->decimal('item70',10,2)->default(0);
            $table->decimal('item75',10,2)->default(0);
            $table->decimal('item80',10,2)->default(0);
            $table->decimal('item85',10,2)->default(0);
            $table->decimal('item90',10,2)->default(0);
            $table->decimal('item95',10,2)->default(0);
            $table->decimal('item100',10,2)->default(0);
            $table->decimal('item105',10,2)->default(0);
            $table->decimal('item110',10,2)->default(0);
            $table->decimal('item115',10,2)->default(0);
            $table->decimal('item120',10,2)->default(0);
            $table->timestamps();
        });
    }
    
    public function down(): void{
        Schema::dropIfExists('setting_salaries');
    }
};
