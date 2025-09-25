<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('podatki_crm', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('ck_sif')->index();
            $table->integer('ck_podr')->index()->default(1);
            $table->string('ck_uspr')->nullable();
            $table->dateTime('ck_dspr')->nullable();
            $table->string('ck_zaup13')->nullable();
            $table->string('ck_priimek')->nullable();
            $table->string('ck_ime')->nullable();
            $table->string('ck_ulic')->nullable();
            $table->string('ck_post')->nullable();
            $table->string('ck_kraj')->nullable();
            $table->string('ck_tel1')->nullable();
            $table->string('ck_email')->nullable();
            $table->string('ck_intrs')->nullable();
            $table->timestamps();
            $table->unique(['ck_sif','ck_podr']);
        });
    }
    public function down(): void { Schema::dropIfExists('podatki_crm'); }
};
