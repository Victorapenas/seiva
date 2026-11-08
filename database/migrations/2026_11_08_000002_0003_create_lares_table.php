<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('lares', function (Blueprint $table) {
            $table->id('id_lar');
            $table->string('nome');
            $table->string('emoji', 50)->default('🏠');
            $table->unsignedBigInteger('criado_por');
            $table->timestamps();
            $table->foreign('criado_por')->references('id_usuario')->on('usuarios');
        });
    }
    public function down(): void { Schema::dropIfExists('lares'); }
};