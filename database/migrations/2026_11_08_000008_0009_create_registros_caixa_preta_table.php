<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('registros_caixa_preta', function (Blueprint $table) {
            $table->id('id_registro_caixa_preta');
            $table->unsignedBigInteger('usuario_id');
            $table->text('titulo_cifrado');
            $table->text('valor_cifrado');
            $table->text('conta_cifrada');
            $table->date('data');
            $table->boolean('bloqueado')->default(false);
            $table->timestamps();
            $table->foreign('usuario_id')->references('id_usuario')->on('usuarios')->onDelete('cascade');
        });
    }
    public function down(): void { Schema::dropIfExists('registros_caixa_preta'); }
};