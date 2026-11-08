<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('categorias', function (Blueprint $table) {
            $table->id('id_categoria');
            $table->string('nome', 100);
            $table->string('emoji', 20)->nullable();
            $table->string('cor', 20)->nullable();
            $table->boolean('sistema')->default(false);
            $table->unsignedBigInteger('usuario_id')->nullable();
            $table->timestamps();
            $table->foreign('usuario_id')->references('id_usuario')->on('usuarios')->onDelete('cascade');
        });
    }
    public function down(): void { Schema::dropIfExists('categorias'); }
};