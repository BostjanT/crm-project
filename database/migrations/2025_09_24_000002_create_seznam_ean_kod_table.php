<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('seznam_ean_kod', function (Blueprint $table) {
            $table->id();
            $table->string('ean')->unique();
            $table->enum('status',['vnesen','porabljen'])->default('vnesen');
            $table->date('dzs')->nullable();
            $table->timestamps();
        });
    }
    public function down(): void { Schema::dropIfExists('seznam_ean_kod'); }
};
