<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('podatki_spletna_trgovina', function (Blueprint $table) {
            $table->bigInteger('id')->primary();
            $table->string('firstname')->nullable();
            $table->string('lastname')->nullable();
            $table->string('street')->nullable();
            $table->string('zipcode')->nullable();
            $table->string('city')->nullable();
            $table->string('email')->nullable();
            $table->string('phone')->nullable();
            $table->date('birthdate')->nullable();
            $table->string('interest')->nullable();
            $table->string('gender')->nullable();
            $table->string('sizes')->nullable();
            $table->tinyInteger('status')->default(0);
            $table->tinyInteger('mailing')->default(0);
            $table->tinyInteger('sms')->default(0);
            $table->dateTime('date')->nullable();
            $table->timestamps();
        });
    }
    public function down(): void { Schema::dropIfExists('podatki_spletna_trgovina'); }
};
